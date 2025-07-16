<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_DB_query_builder $db
 * @property CI_Upload $upload
 * @property User_model $User_model
 * @property Menu_model $menu
 */


class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); // pastikan fungsi ini ada di helper
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $menu_name = $this->input->post('menu');
            $urutan = $this->input->post('urutan');
            $this->db->insert('user_menu', ['menu' => $menu_name, 'urutan' => $urutan]);

            // Ambil id menu terakhir
            $menu_id = $this->db->insert();

            // Tambahkan akses menu ini ke role_id = 1 (admin)
            $this->db->insert('user_access_menu', [
                'role_id' => 1,
                'menu_id' => $menu_id
            ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru ditambahkan dan diberi akses!</div>');
            redirect('menu');
        }
    }

    public function save()
    {
        $id = $this->input->post('id', true);
        $menu = $this->input->post('menu', true);
        $urutan = $this->input->post('urutan', true);

        if (!$menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Menu name is required!</div>');
            redirect('menu');
        }

        if ($id) {
            // Update
            $this->db->update('user_menu', [
                'menu' => $menu,
                'urutan' => $urutan
            ], ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Menu updated!</div>');
        } else {
            // Insert
            $this->db->insert('user_menu', [
                'menu' => $menu,
                'urutan' => $urutan
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">New menu added!</div>');
        }

        redirect('menu');
    }

    public function delete($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Menu deleted!</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $email = $this->session->userdata('email'); // Ambil email dari session
        if (!$email) {
            redirect('auth'); // Jika belum login, kembalikan ke halaman login
        }

        // Ambil data user berdasarkan email
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data =  [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class = "alert
            alert-success" role="alert">New sub menu added</div>');
            redirect('menu/submenu');
        }
    }

    public function save_submenu()
    {
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil diperbarui!</div>');
        redirect('menu/submenu');
    }

    public function delete_submenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil dihapus!</div>');
        redirect('menu/submenu');
    }


    public function sub_submenu()
    {
        $data['title'] = 'Sub-Submenu Management';
        $email = $this->session->userdata('email');

        if (!$email) {
            redirect('auth');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['sub_submenu'] = $this->menu->getSubSubMenu();
        $data['submenu'] = $this->menu->getSubMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('parent_id', 'Submenu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/sub_submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'submenu_id' => $this->input->post('parent_id'),
                'is_active' => $this->input->post('is_active') ? 1 : 0,
                'role_id' => $this->session->userdata('role_id')
            ];

            $this->db->insert('user_sub_submenu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub-submenu berhasil ditambahkan!</div>');
            redirect('menu/sub_submenu');
        }
    }

    public function save_sub_submenu()
    {
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('title'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'submenu_id' => $this->input->post('submenu_id'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_submenu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Sub-submenu berhasil diupdate!</div>');
        redirect('menu/sub_submenu');
    }

    public function delete_sub_submenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_submenu');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Sub-submenu berhasil dihapus!</div>');
        redirect('menu/sub_submenu');
    }

    // public function sub_submenu()
    // {
    //     $data['title'] = 'Sub-Submenu Management';
    //     $email = $this->session->userdata('email');

    //     if (!$email) {
    //         redirect('auth');
    //     }

    //     $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

    //     $this->load->model('Menu_model', 'menu');

    //     // Ambil semua data sub-submenu (dengan join ke submenu & menu)
    //     $data['sub_submenu'] = $this->menu->getSubSubMenu();

    //     // Ambil semua submenu untuk dropdown
    //     $data['submenu'] = $this->menu->getSubMenu();

    //     // Validasi form
    //     $this->form_validation->set_rules('title', 'Title', 'required');
    //     $this->form_validation->set_rules('parent_id', 'Submenu', 'required');
    //     $this->form_validation->set_rules('url', 'URL', 'required');
    //     $this->form_validation->set_rules('icon', 'Icon', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('menu/sub_submenu', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $data = [
    //             'title' => $this->input->post('title'),
    //             'url' => $this->input->post('url'),
    //             'icon' => $this->input->post('icon'),
    //             'submenu_id' => $this->input->post('parent_id'),
    //             'is_active' => $this->input->post('is_active'),
    //             'role_id' => $this->session->userdata('role_id')
    //         ];

    //         $this->db->insert('user_sub_submenu', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub-submenu added!</div>');
    //         redirect('menu/sub_submenu');
    //     }
    // }

    // // Update Sub-Submenu
    // public function save_sub_submenu()
    // {
    //     $id = $this->input->post('id');
    //     $data = [
    //         'title' => $this->input->post('title'),
    //         'url' => $this->input->post('url'),
    //         'icon' => $this->input->post('icon'),
    //         'submenu_id' => $this->input->post('submenu_id'),
    //         'is_active' => $this->input->post('is_active') ? 1 : 0
    //     ];

    //     $this->db->where('id', $id);
    //     $this->db->update('user_sub_submenu', $data);

    //     $this->session->set_flashdata('message', '<div class="alert alert-success">Sub-submenu berhasil diupdate!</div>');
    //     redirect('menu/sub_submenu');
    // }

    // // Hapus Sub-Submenu
    // public function delete_sub_submenu($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('user_sub_submenu');

    //     $this->session->set_flashdata('message', '<div class="alert alert-success">Sub-submenu berhasil dihapus!</div>');
    //     redirect('menu/sub_submenu');
    // }
}
