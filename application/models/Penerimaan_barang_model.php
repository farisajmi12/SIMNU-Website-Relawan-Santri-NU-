<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan_barang_model extends CI_Model
{
    protected $table = 'penerimaan_barang';

    public function get_all()
    {
        return $this->db->select('pu.*, pu.lampiran, d.nama as donatur_nama, d.nik_kode, jd.nama as jenis_donasi')
            ->from($this->table . ' pu')
            ->join('donatur d', 'pu.donatur_id = d.id', 'left')
            ->join('jenis_donasi jd', 'pu.jenis_donasi_id = jd.id', 'left')
            ->order_by('pu.tanggal', 'desc')
            ->get()
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function getById($id)
    {
        return $this->db->where('id', $id)
            ->get($this->table)
            ->row();
    }

    // Tambahkan method berikut
    public function get_filtered_paginated($start_date = null, $end_date = null, $donatur_id = null, $jenis_donasi_id = null, $limit = 5, $offset = 0)
    {
        $this->db->select('pb.*, d.nama as donatur_nama, d.nik_kode, jd.nama as jenis_donasi')
            ->from($this->table . ' pb')
            ->join('donatur d', 'pb.donatur_id = d.id', 'left')
            ->join('jenis_donasi jd', 'pb.jenis_donasi_id = jd.id', 'left');

        if (!empty($start_date)) {
            $this->db->where('pb.tanggal >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('pb.tanggal <=', $end_date);
        }
        if (!empty($donatur_id)) {
            $this->db->where('pb.donatur_id', $donatur_id);
        }
        if (!empty($jenis_donasi_id)) {
            $this->db->where('pb.jenis_donasi_id', $jenis_donasi_id);
        }

        return $this->db->order_by('pb.tanggal', 'desc')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    public function count_filtered($start_date = null, $end_date = null, $donatur_id = null, $jenis_donasi_id = null)
    {
        $this->db->from($this->table . ' pb');

        if (!empty($start_date)) {
            $this->db->where('pb.tanggal >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('pb.tanggal <=', $end_date);
        }
        if (!empty($donatur_id)) {
            $this->db->where('pb.donatur_id', $donatur_id);
        }
        if (!empty($jenis_donasi_id)) {
            $this->db->where('pb.jenis_donasi_id', $jenis_donasi_id);
        }

        return $this->db->count_all_results();
    }
}
