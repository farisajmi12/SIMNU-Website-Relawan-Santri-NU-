<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran_uang_model extends CI_Model
{
    protected $table = 'pengeluaran_uang';

    public function get_all()
    {
        return $this->db->select('pu.*, pu.lampiran, jd.nama as jenis_donasi')
            ->from($this->table . ' pu')
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

    public function get_filtered($start_date = null, $end_date = null, $jenis_donasi_id = null)
    {
        $this->db->select('pu.*, jd.nama as jenis_donasi')
            ->from($this->table . ' pu')
            ->join('jenis_donasi jd', 'pu.jenis_donasi_id = jd.id', 'left');

        if (!empty($start_date)) {
            $this->db->where('pu.tanggal >=', $start_date);
        }

        if (!empty($end_date)) {
            $this->db->where('pu.tanggal <=', $end_date);
        }

        if (!empty($jenis_donasi_id)) {
            $this->db->where('pu.jenis_donasi_id', $jenis_donasi_id);
        }

        return $this->db->order_by('pu.tanggal', 'desc')
            ->get()
            ->result();
    }

    public function count_filtered($start_date = null, $end_date = null, $jenis_donasi_id = null)
    {
        $this->db->from($this->table . ' pu');

        if (!empty($start_date)) {
            $this->db->where('pu.tanggal >=', $start_date);
        }

        if (!empty($end_date)) {
            $this->db->where('pu.tanggal <=', $end_date);
        }

        if (!empty($donatur_id)) {
            $this->db->where('pu.donatur_id', $donatur_id);
        }

        if (!empty($jenis_donasi_id)) {
            $this->db->where('pu.jenis_donasi_id', $jenis_donasi_id);
        }

        return $this->db->count_all_results();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_paginated($limit, $offset, $start_date = null, $end_date = null, $jenis_donasi_id = null)
    {
        $this->db->select('pu.*, jd.nama as jenis_donasi')
            ->from($this->table . ' pu')
            ->join('jenis_donasi jd', 'pu.jenis_donasi_id = jd.id', 'left');

        if (!empty($start_date)) {
            $this->db->where('pu.tanggal >=', $start_date);
        }

        if (!empty($end_date)) {
            $this->db->where('pu.tanggal <=', $end_date);
        }

        if (!empty($jenis_donasi_id)) {
            $this->db->where('pu.jenis_donasi_id', $jenis_donasi_id);
        }

        return $this->db->limit($limit, $offset)
            ->order_by('pu.tanggal', 'desc')
            ->get()
            ->result();
    }

    public function get_filtered_paginated($start_date = null, $end_date = null, $jenis_donasi_id = null, $limit = 5, $offset = 0)
    {
        $this->db->select('pu.*, jd.nama as jenis_donasi')
            ->from($this->table . ' pu')
            ->join('jenis_donasi jd', 'pu.jenis_donasi_id = jd.id', 'left');

        if (!empty($start_date)) {
            $this->db->where('pu.tanggal >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('pu.tanggal <=', $end_date);
        }
        if (!empty($donatur_id)) {
            $this->db->where('pu.donatur_id', $donatur_id);
        }
        if (!empty($jenis_donasi_id)) {
            $this->db->where('pu.jenis_donasi_id', $jenis_donasi_id);
        }

        return $this->db->order_by('pu.tanggal', 'desc')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    public function get_total_pengeluaran_before_date($tanggal, $jenis_donasi_id = null)
    {
        $this->db->select_sum('jumlah');
        $this->db->where('tanggal <', $tanggal); // bukan <=

        if ($jenis_donasi_id) {
            $this->db->where('jenis_donasi_id', $jenis_donasi_id);
        }

        $result = $this->db->get('pengeluaran_uang')->row();
        return $result->jumlah ?? 0;
    }
    
}
