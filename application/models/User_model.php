<?php
class User_model extends CI_Model
{
    public function getUserByLogin($login)
    {
        $this->db->where('username', $login);
        $this->db->or_where('email', $login);
        return $this->db->get('user')->row_array();
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

    public function get_all_users_except($excluded_id)
    {
        $this->db->where('id !=', $excluded_id);
        return $this->db->get('user')->result();
    }

    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete('user', ['id' => $id]);
    }

    public function toggle_user($id)
    {
        $user = $this->get_user_by_id($id);
        if ($user) {
            $new_status = $user->is_active == 1 ? 0 : 1;
            return $this->update_user($id, ['is_active' => $new_status]);
        }
        return false;
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row();
    }
}
