<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_DB_query_builder $db
 * @property User_model $
 * @property CI_Upload $upload
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $email = $this->session->userdata('email'); // Ambil email dari session
        if (!$email) {
            redirect('auth'); // Jika belum login, kembalikan ke halaman login
        }

        // Ambil data user berdasarkan email
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $email = $this->session->userdata('email');

        if (!$email) {
            redirect('auth');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Load view jika validasi gagal
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name     = $this->input->post('name');
            $username = $this->input->post('username');

            // Siapkan konfigurasi upload
            $config['upload_path']   = './uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            // Cek jika ada file yang diupload
            if (!empty($_FILES['image']['name'])) {
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');

                    // Hapus gambar lama jika bukan default
                    $old_image = $data['user']['image'];
                    if ($old_image && $old_image != 'default.jpg') {
                        $old_path = FCPATH . 'uploads/profile/' . $old_image;
                        if (file_exists($old_path)) {
                            unlink($old_path);
                        }
                    }

                    // Update gambar baru
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('user/edit');
                }
            }

            // Update data lain
            $this->db->set('name', $name);
            $this->db->set('username', $username);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $email = $this->session->userdata('email'); // Ambil email dari session
        if (!$email) {
            redirect('auth'); // Jika belum login, kembalikan ke halaman login
        }

        // Ambil data user berdasarkan email
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert"> Wrong current password</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-danger" role="alert"> New password cannot be the same as
                    current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_has = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_has);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-success" role="alert"> Password changed! </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
