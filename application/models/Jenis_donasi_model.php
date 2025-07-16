<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_donasi_model extends CI_Model
{
    // Ambil semua data
    public function get_all()
    {
        return $this->db->get('jenis_donasi')->result();
    }

    // Simpan data baru
    public function save($data)
    {
        return $this->db->insert('jenis_donasi', $data);
    }

    // Update data berdasarkan ID
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('jenis_donasi', $data);
    }

    // Hapus data berdasarkan ID
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('jenis_donasi');
    }
}
