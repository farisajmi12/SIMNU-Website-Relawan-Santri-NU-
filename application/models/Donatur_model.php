<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur_model extends CI_Model
{
    private $table = 'donatur';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update($this->table, $data);
        } else {
            return $this->db->insert($this->table, $data);
        }
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
