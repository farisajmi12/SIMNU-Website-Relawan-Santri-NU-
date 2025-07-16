<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima_model extends CI_Model
{
    protected $table = 'penerimamanfaat';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_nik($nik)
    {
        return $this->db->get_where($this->table, ['nik' => $nik])->row();
    }

    public function get_by_kategori($kategori)
    {
        return $this->db->get_where($this->table, ['kategori' => $kategori])->result();
    }

    public function save($data)
    {
        // Cek apakah NIK sudah ada (untuk update)
        $existing = $this->get_by_nik($data['nik']);

        if ($existing) {
            // Update data yang ada
            $this->db->where('nik', $data['nik']);
            return $this->db->update($this->table, $data);
        } else {
            // Insert data baru
            return $this->db->insert($this->table, $data);
        }
    }

    public function update($nik, $data)
    {
        $this->db->set($data); // Tambahkan baris ini
        $this->db->where('nik', $nik); // Sesuai permintaan, tetap pakai 'nik'
        return $this->db->update($this->table);
    }

    public function delete($nik)
    {
        $this->db->where('nik', $nik);
        return $this->db->delete($this->table);
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_paginated_by_kategori($kategori, $limit, $offset)
    {
        return $this->db->where('kategori', $kategori)
            ->limit($limit, $offset)
            ->get($this->table)
            ->result();
    }
}
