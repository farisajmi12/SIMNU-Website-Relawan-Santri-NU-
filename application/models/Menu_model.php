<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`        
                ";

        return $this->db->query($query)->result_array();
    }


    public function getSubSubMenu()
    {
        $this->db->select('user_sub_submenu.*, user_sub_menu.title as sub_menu_title, user_menu.menu as menu_title, user_menu.id as menu_id');
        $this->db->from('user_sub_submenu');
        $this->db->join('user_sub_menu', 'user_sub_submenu.submenu_id = user_sub_menu.id');
        $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
        return $this->db->get()->result_array();
    }

    // public function getSubSubMenu()
    // {
    //     $this->db->select('user_sub_submenu.*, user_sub_menu.title as sub_menu_title, user_menu.menu as menu_title');
    //     $this->db->from('user_sub_submenu');
    //     $this->db->join('user_sub_menu', 'user_sub_submenu.submenu_id = user_sub_menu.id');
    //     $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
    //     return $this->db->get()->result_array();
    // }
}
