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
 * @property Donatur_model $Donatur_model
 * @property Penerimaan_model $Penerimaan_model
 * @property Pengeluaran_model $Pengeluaran_model
 * @property Laporan_model $Laporan_model
 * @property Penerima_model $Penerima_model
 * @property Jenis_donasi_model $Jenis_donasi_model
 * @property Penerima_uang_model $Penerimaan_uang_model
 * @property Penerima_barang_model $Penerimaan_barang_model
 * @property Pengeluaran_uang_model $Pengeluaran_uang_model
 * @property Pengeluaran_barang_model $Pengeluaran_barang_model
 */


class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->model('Penerima_model');
        $this->load->model('Donatur_model');
        $this->load->model('Jenis_donasi_model');
        $this->load->model('Penerimaan_uang_model');
        $this->load->model('Penerimaan_barang_model');
        $this->load->model('Pengeluaran_uang_model');
        $this->load->model('Pengeluaran_barang_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $email = $this->session->userdata('email'); // Ambil email dari session
        if (!$email) {
            redirect('auth'); // Jika belum login, kembalikan ke halaman login
        }

        // Ambil data user berdasarkan email
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        // Jika tidak ada gambar, beri default
        if (empty($data['user']['image'])) {
            $data['user']['image'] = 'default.png';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function ldnu()
    {
        $data['title'] = 'LDNU';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/ldnu', $data);
        $this->load->view('templates/footer');
    }
    public function ltmnu()
    {
        $data['title'] = 'LTMNU';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/ltmnu', $data);
        $this->load->view('templates/footer');
    }

    public function lbm()
    {
        $data['title'] = 'LBM';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lbm', $data);
        $this->load->view('templates/footer');
    }

    public function lknu()
    {
        $data['title'] = 'LKNU';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lknu', $data);
        $this->load->view('templates/footer');
    }

    public function lkknu()
    {
        $data['title'] = 'LKKNU';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lkknu', $data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $data['title'] = 'Manajemen User';
        $current_user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $current_user;
        $data['users'] = $this->User_model->get_all_users_except($current_user['id']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function save_user()
    {
        $id = $this->input->post('id');
        $no_telepon = preg_replace('/[^0-9]/', '', $this->input->post('no_telepon'));
        if (substr($no_telepon, 0, 1) === '0') {
            $no_telepon = '+62' . substr($no_telepon, 1);
        } elseif (substr($no_telepon, 0, 2) === '62') {
            $no_telepon = '+' . $no_telepon;
        } elseif (substr($no_telepon, 0, 3) !== '+62') {
            $no_telepon = '+62' . $no_telepon;
        }


        $data = [
            'name'        => $this->input->post('name'),
            'username'    => $this->input->post('username'),
            'email'       => $this->input->post('email'),
            'no_telepon'  => $no_telepon,
            'role_id'     => $this->input->post('role'),
        ];

        $password = $this->input->post('password');
        if (!empty($password)) {
            if (strlen($password) < 8) {
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Password minimal 8 karakter.</div>');
                redirect('admin/user');
                return;
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($id) {
            if ($this->User_model->update_user($id, $data)) {
                $this->session->set_flashdata('success', '<div class="alert alert-success">User berhasil diperbarui!</div>');
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Gagal memperbarui user.</div>');
            }
        } else {
            $data['is_active'] = 1;
            $data['date_created'] = time();
            if ($this->User_model->insert_user($data)) {
                $this->session->set_flashdata('success', '<div class="alert alert-success">User berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Gagal menambahkan user.</div>');
            }
        }
        redirect('admin/user');
    }

    public function delete_user($id)
    {
        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', '<div class="alert alert-success">User berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Gagal menghapus user.</div>');
        }
        redirect('admin/user');
    }

    public function toggle_user($id)
    {
        $user = $this->User_model->get_user_by_id($id);
        if ($user) {
            $new_status = $user->is_active ? 0 : 1;
            if ($this->User_model->update_user($id, ['is_active' => $new_status])) {
                $status_msg = $new_status ? 'diaktifkan' : 'dinonaktifkan';
                $this->session->set_flashdata('success', "<div class='alert alert-success'>User berhasil $status_msg!</div>");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Gagal mengubah status user.</div>');
            }
        }
        redirect('admin/user');
    }

    public function get_user_by_id()
    {
        $id = $this->input->post('id');
        $user = $this->User_model->get_user_by_id($id);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'User tidak ditemukan']);
        }
    }

    public function role()
    {
        $data['title'] = 'Role';
        $email = $this->session->userdata('email'); // Ambil email dari session
        if (!$email) {
            redirect('auth'); // Jika belum login, kembalikan ke halaman login
        }

        // Ambil data user berdasarkan email
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        // Validasi numeric
        if (!is_numeric($role_id)) {
            show_404();
        }

        $data['title'] = 'Role Access';
        $email = $this->session->userdata('email');

        // Cek session
        if (!$email) {
            redirect('auth');
        }

        // Get user data
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        if (empty($data['user'])) {
            $this->session->unset_userdata('email');
            redirect('auth');
        }

        // Get role data
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        if (empty($data['role'])) {
            $this->session->set_flashdata('error', 'Role tidak ditemukan');
            redirect('admin/role');
        }

        // Get menu data
        if ($role_id == 3) { // Operator
            $this->db->where('id !=', 1); // Exclude admin menu
        }

        $this->db->where('id !=', 1); // Exclude menu tertentu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        if (empty($data['menu'])) {
            $data['menu'] = [];
        }

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        // Cegah Operator (role_id = 3) dapat akses ke menu admin (menu_id = 1)
        if ($role_id == 3 && $menu_id == 1) {
            echo 'forbidden';
            return;
        }

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id

        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Change!</div>');

        echo 'success';
    }

    public function saveRole()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');

        if ($id) {
            // Edit
            $this->db->update('user_role', ['role' => $role], ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Role updated!</div>');
        } else {
            // Tambah baru
            $this->db->insert('user_role', ['role' => $role]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Role added!</div>');
        }

        redirect('admin/role');
    }

    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Role deleted!</div>');
        redirect('admin/role');
    }

    public function penerimamanfaat()
    {
        $data['title'] = 'Penerima Manfaat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Load model dan library
        $this->load->model('Penerima_model');
        $this->load->library('pagination');

        // Konfigurasi pagination
        $config['base_url'] = base_url('admin/penerimamanfaat');
        $config['total_rows'] = $this->Penerima_model->count_all();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Load data dengan pagination
        $data['anak_yatim'] = $this->Penerima_model->get_paginated_by_kategori('anak_yatim', $config['per_page'], $page);
        $data['janda_jompo'] = $this->Penerima_model->get_paginated_by_kategori('janda_jompo', $config['per_page'], $page);
        $data['dhuafa'] = $this->Penerima_model->get_paginated_by_kategori('dhuafa', $config['per_page'], $page);
        $data['pagination_links'] = $this->pagination->create_links();

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penerimamanfaat', $data);
        $this->load->view('templates/footer');
    }

    public function save_penerima()
    {
        $this->load->model('Penerima_model');

        // Validasi nomor HP Indonesia
        $no_hp = $this->input->post('no_hp');
        if (!preg_match('/^(\+62|62|0)[8][1-9][0-9]{6,9}$/', $no_hp)) {
            $this->session->set_flashdata('error', 'Nomor HP harus nomor Indonesia yang valid (contoh: 08123456789, +628123456789, atau 628123456789)');
            redirect('admin/penerimamanfaat');
            return;
        }

        // Konfigurasi upload
        $config['upload_path']   = FCPATH . 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        $profile_photo = '';
        $photo_rumah   = '';

        // Upload profile photo
        if (!empty($_FILES['profile_photo']['name'])) {
            $config['upload_path'] = './uploads/profile_photos/';
            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_photo')) {
                $profile_photo = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/penerimamanfaat');
            }
        }

        // Upload photo_rumah
        if (!empty($_FILES['photo_rumah']['name'])) {
            $config['upload_path'] = './uploads/photo_rumah/';
            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo_rumah')) {
                $photo_rumah = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/penerimamanfaat');
            }
        }

        $sub_kategori = $this->input->post('sub_kategori');
        // Data input
        $data = [
            'nik'            => $this->input->post('nik'),
            'nama'           => $this->input->post('nama'),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            'umur'           => $this->input->post('umur'),
            'agama'          => $this->input->post('agama'),
            'ttl'            => $this->input->post('ttl'),
            'anak_ke'        => $this->input->post('anak_ke', true) ?: null,
            'ibu_kandung'    => $this->input->post('ibu_kandung', true) ?: null,
            'alamat_lengkap' => $this->input->post('alamat_lengkap'),
            'kode_pos'       => $this->input->post('kode_pos'),
            'no_hp'          => $this->input->post('no_hp'),
            'kategori'       => $this->input->post('kategori'),
            'sub_kategori' => $sub_kategori,

        ];

        // Format nomor HP ke format 62 (standar internasional)
        $data['no_hp'] = $this->formatPhoneNumber($data['no_hp']);

        // Tambahkan hanya jika file baru diupload
        if ($profile_photo) {
            $data['profile_photo'] = $profile_photo;
        }
        if ($photo_rumah) {
            $data['photo_rumah'] = $photo_rumah;
        }

        $id = $this->input->post('id_penerima');
        if ($id) {
            // Update data jika id_penerima ada
            if ($this->Penerima_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data.');
            }
        } else {
            // Simpan data baru
            if ($this->Penerima_model->save($data)) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data.');
            }
        }

        redirect('admin/penerimamanfaat');
    }

    // Fungsi untuk memformat nomor telepon ke format 62
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone); // Hapus semua karakter non-digit

        // Jika diawali dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) == '0') {
            $phone = '+62' . substr($phone, 1);
        }
        // Jika diawali dengan +62, hapus tanda +
        elseif (substr($phone, 0, 3) == '62') {
            $phone = '+' . substr($phone, 3);
        }
        // Jika diawali dengan 62, biarkan saja
        elseif (substr($phone, 0, 2) == '+62') {
            // Tidak perlu perubahan
        }

        return $phone;
    }

    public function delete_penerima($nik)
    {
        $this->load->model('Penerima_model');

        // Hapus file foto jika ada
        $penerima = $this->Penerima_model->get_by_nik($nik);
        if ($penerima) {
            if (!empty($penerima->profile_photo)) {
                unlink(FCPATH . 'uploads/profile_photos/' . $penerima->profile_photo);
            }
            if (!empty($penerima->photo_rumah)) {
                unlink(FCPATH . 'uploads/photo_rumah/' . $penerima->photo_rumah);
            }
        }

        if ($this->Penerima_model->delete($nik)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('admin/penerimamanfaat');
    }

    public function donasi()
    {
        $data['title'] = 'Menu Donasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/donasi', $data);
        $this->load->view('templates/footer');
    }

    public function donatur()
    {
        $data['title'] = 'Data Donatur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['donatur'] = $this->Donatur_model->get_all();

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/donatur', $data);
        $this->load->view('templates/footer');
    }

    public function save_donatur()
    {

        // Normalisasi nomor telepon
        $no_telepon = preg_replace('/[^0-9]/', '', $this->input->post('no_hp'));

        if (substr($no_telepon, 0, 1) === '0') {
            $no_telepon = '+62' . substr($no_telepon, 1);
        } elseif (substr($no_telepon, 0, 2) === '62') {
            $no_telepon = '+' . $no_telepon;
        } elseif (substr($no_telepon, 0, 3) !== '+62') {
            $no_telepon = '+62' . $no_telepon;
        }

        $data = [
            'nik_kode'       => $this->input->post('nik_kode'),
            'nama'           => $this->input->post('nama'),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            'tipe'           => $this->input->post('tipe'),
            'agama'          => $this->input->post('agama'),
            'alamat'         => $this->input->post('alamat'),
            'kode_pos'       => $this->input->post('kode_pos'),
            'no_hp'          => $no_telepon
        ];

        if ($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }

        if ($this->Donatur_model->save($data)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal disimpan.');
        }

        redirect('admin/donatur');
    }

    public function delete_donatur($id)
    {
        if ($this->Donatur_model->delete_by_id($id)) {
            $this->session->set_flashdata('success', 'Data donatur berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data donatur.');
        }

        redirect('admin/donatur');
    }

    // Halaman utama Jenis Donasi
    public function jenis_donasi()
    {
        $data['title'] = 'Jenis Donasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenis_donasi'] = $this->Jenis_donasi_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/jenis_donasi', $data);
        $this->load->view('templates/footer');
    }

    // Simpan dan Update Jenis Donasi
    public function save_jenis_donasi()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'deskripsi' => $this->input->post('deskripsi')
        ];

        if ($id) {
            // Jika ID ada, update data
            if ($this->Jenis_donasi_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data.');
            }
        } else {
            // Jika ID tidak ada, simpan data baru
            if ($this->Jenis_donasi_model->save($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data.');
            }
        }

        redirect('admin/jenis_donasi');
    }

    // Hapus Jenis Donasi
    public function delete_jenis_donasi($id)
    {
        if ($this->Jenis_donasi_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        redirect('admin/jenis_donasi');
    }

    public function penerimaan()
    {
        $data['title'] = 'Penerimaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Load model dan library
        $this->load->model('Penerimaan_uang_model');
        $this->load->model('Penerimaan_barang_model');
        $this->load->library('pagination');

        // Filter parameters
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $donatur_id = $this->input->get('donatur_id');
        $jenis_donasi_id = $this->input->get('jenis_donasi_id');

        // Konfigurasi pagination untuk penerimaan uang
        $config['base_url'] = base_url('admin/penerimaan');
        $config['total_rows'] = $this->Penerimaan_uang_model->count_filtered($start_date, $end_date, $donatur_id, $jenis_donasi_id) +
            $this->Penerimaan_barang_model->count_filtered($start_date, $end_date, $donatur_id, $jenis_donasi_id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        // Load data dengan filter dan pagination
        $data['penerimaan_uang'] = $this->Penerimaan_uang_model->get_filtered_paginated(
            $start_date,
            $end_date,
            $donatur_id,
            $jenis_donasi_id,
            $config['per_page'],
            $page
        );

        $data['penerimaan_barang'] = $this->Penerimaan_barang_model->get_filtered_paginated(
            $start_date,
            $end_date,
            $donatur_id,
            $jenis_donasi_id,
            $config['per_page'],
            $page
        );

        $data['donatur'] = $this->db->get('donatur')->result();
        $data['jenis_donasi'] = $this->db->get('jenis_donasi')->result();
        $data['pagination_links'] = $this->pagination->create_links();
        $data['filter'] = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'donatur_id' => $donatur_id,
            'jenis_donasi_id' => $jenis_donasi_id
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penerimaan', $data);
        $this->load->view('templates/footer');
    }

    public function save_penerimaan()
    {
        $type = $this->input->post('type'); // 'uang' atau 'barang'
        $id = $this->input->post('id');

        if ($type == 'uang') {
            $this->_save_penerimaan_uang($id);
        } elseif ($type == 'barang') {
            $this->_save_penerimaan_barang($id);
        }

        redirect('admin/penerimaan');
    }

    private function _save_penerimaan_uang($id = null)
    {
        $uploadDir = './uploads/penerimaan_uang/';
        $fullUploadPath = FCPATH . $uploadDir;

        // Pastikan direktori ada
        if (!is_dir($fullUploadPath)) {
            mkdir($fullUploadPath, 0755, true);
        }

        $config['upload_path']   = './' . $uploadDir;
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        $fileData = null;

        // Upload lampiran jika ada
        if (!empty($_FILES['lampiran']['name'])) {
            $config['file_name'] = time() . '_' . $_FILES['lampiran']['name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('lampiran')) {
                $fileData = $this->upload->data();
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/penerimaan');
            }
        }

        // Jika ada file yang diupload, hapus file lama jika ada
        if ($id) {
            $oldData = $this->Penerimaan_uang_model->getById($id);
            if ($oldData && $oldData->lampiran && file_exists($fullUploadPath . $oldData->lampiran)) {
                unlink($fullUploadPath . $oldData->lampiran);
            }
        }

        $data = [
            'tanggal'           => $this->input->post('tanggal'),
            'donatur_id'        => $this->input->post('donatur_id'),
            'jenis_donasi_id'   => $this->input->post('jenis_donasi_id'),
            'jumlah'            => str_replace('.', '', $this->input->post('jumlah')),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'keterangan'        => $this->input->post('keterangan')
        ];

        if ($fileData) {
            $data['lampiran'] = $uploadDir . $fileData['file_name'];
        }

        if ($id) {
            $this->Penerimaan_uang_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data penerimaan uang berhasil diperbarui.');
        } else {
            $this->Penerimaan_uang_model->insert($data);
            $this->session->set_flashdata('success', 'Data penerimaan uang berhasil disimpan.');
        }
    }

    private function _save_penerimaan_barang($id = null)
    {
        $uploadDir = './uploads/penerimaan_barang/';
        $fullUploadPath = FCPATH . $uploadDir;

        // Pastikan direktori ada
        if (!is_dir($fullUploadPath)) {
            mkdir($fullUploadPath, 0755, true);
        }

        $config['upload_path']   = './' . $uploadDir;
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        $fileData = null;

        // Upload lampiran jika ada
        if (!empty($_FILES['lampiran']['name'])) {
            $config['file_name'] = time() . '_' . $_FILES['lampiran']['name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('lampiran')) {
                $fileData = $this->upload->data();
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/penerimaan');
            }
        }

        // Jika ada file yang diupload, hapus file lama jika ada
        if ($id) {
            $oldData = $this->Penerimaan_barang_model->getById($id);
            if ($oldData && $oldData->lampiran && file_exists($fullUploadPath . $oldData->lampiran)) {
                unlink($fullUploadPath . $oldData->lampiran);
            }
        }

        $data = [
            'tanggal'           => $this->input->post('tanggal'),
            'donatur_id'        => $this->input->post('donatur_id'),
            'jenis_donasi_id'   => $this->input->post('jenis_donasi_id'),
            'nama_barang'       => $this->input->post('nama_barang'),
            'jumlah'            => $this->input->post('jumlah'),
            'satuan'            => $this->input->post('satuan'),
            'keterangan'        => $this->input->post('keterangan')
        ];

        if ($fileData) {
            $data['lampiran'] = $uploadDir . $fileData['file_name'];
        }

        if ($id) {
            $this->Penerimaan_barang_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data penerimaan barang berhasil diperbarui.');
        } else {
            $this->Penerimaan_barang_model->insert($data);
            $this->session->set_flashdata('success', 'Data penerimaan barang berhasil disimpan.');
        }
    }

    public function delete_penerimaan($type, $id)
    {
        if ($type == 'uang') {
            $this->_delete_penerimaan_uang($id);
        } elseif ($type == 'barang') {
            $this->_delete_penerimaan_barang($id);
        }

        redirect('admin/penerimaan');
    }

    private function _delete_penerimaan_uang($id)
    {
        $data = $this->Penerimaan_uang_model->getById($id);

        if ($data && $data->lampiran && file_exists(FCPATH . $data->lampiran)) {
            unlink(FCPATH . $data->lampiran);
        }

        $this->Penerimaan_uang_model->delete($id);
        $this->session->set_flashdata('success', 'Data penerimaan uang berhasil dihapus.');
    }

    private function _delete_penerimaan_barang($id)
    {
        $data = $this->Penerimaan_barang_model->getById($id);

        if ($data && $data->lampiran && file_exists(FCPATH . $data->lampiran)) {
            unlink(FCPATH . $data->lampiran);
        }

        $this->Penerimaan_barang_model->delete($id);
        $this->session->set_flashdata('success', 'Data penerimaan barang berhasil dihapus.');
    }

    public function pengeluaran()
    {
        $data['title'] = 'Pengeluaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Load model dan library
        $this->load->model('Pengeluaran_uang_model');
        $this->load->model('Pengeluaran_barang_model');
        $this->load->library('pagination');

        // Filter parameters
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $jenis_donasi_id = $this->input->get('jenis_donasi_id');

        // Konfigurasi pagination untuk pengeluaran
        $config['base_url'] = base_url('admin/pengeluaran');
        $config['total_rows'] = $this->Pengeluaran_uang_model->count_filtered($start_date, $end_date, $jenis_donasi_id) +
            $this->Pengeluaran_barang_model->count_filtered($start_date, $end_date, $jenis_donasi_id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        // Load data dengan filter dan pagination
        $data['pengeluaran_uang'] = $this->Pengeluaran_uang_model->get_filtered_paginated(
            $start_date,
            $end_date,
            $jenis_donasi_id,
            $config['per_page'],
            $page
        );

        $data['pengeluaran_barang'] = $this->Pengeluaran_barang_model->get_filtered_paginated(
            $start_date,
            $end_date,
            $jenis_donasi_id,
            $config['per_page'],
            $page
        );

        $data['jenis_donasi'] = $this->db->get('jenis_donasi')->result();
        $data['pagination_links'] = $this->pagination->create_links();
        $data['filter'] = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'jenis_donasi_id' => $jenis_donasi_id
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengeluaran', $data);
        $this->load->view('templates/footer');
    }

    public function save_pengeluaran()
    {
        $type = $this->input->post('type'); // 'uang' atau 'barang'
        $id = $this->input->post('id');

        if ($type == 'uang') {
            $this->_save_pengeluaran_uang($id);
        } elseif ($type == 'barang') {
            $this->_save_pengeluaran_barang($id);
        }

        redirect('admin/pengeluaran');
    }

    private function _save_pengeluaran_uang($id = null)
    {
        $uploadDir = './uploads/pengeluaran_uang/';
        $fullUploadPath = FCPATH . $uploadDir;

        // Pastikan direktori ada
        if (!is_dir($fullUploadPath)) {
            mkdir($fullUploadPath, 0755, true);
        }

        $config['upload_path']   = './' . $uploadDir;
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        $fileData = null;

        // Upload lampiran jika ada
        if (!empty($_FILES['lampiran']['name'])) {
            $config['file_name'] = time() . '_' . $_FILES['lampiran']['name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('lampiran')) {
                $fileData = $this->upload->data();
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/pengeluaran');
            }
        }

        // Jika ada file yang diupload, hapus file lama jika ada
        if ($id) {
            $oldData = $this->Pengeluaran_uang_model->getById($id);
            if ($oldData && $oldData->lampiran && file_exists($fullUploadPath . $oldData->lampiran)) {
                unlink($fullUploadPath . $oldData->lampiran);
            }
        }

        $data = [
            'tanggal'           => $this->input->post('tanggal'),
            'jenis_donasi_id'   => $this->input->post('jenis_donasi_id'),
            'jumlah'            => str_replace('.', '', $this->input->post('jumlah')),
            'sumber_dana'       => $this->input->post('sumber_dana'),
            'keterangan'        => $this->input->post('keterangan')
        ];

        if ($fileData) {
            $data['lampiran'] = $uploadDir . $fileData['file_name'];
        }

        if ($id) {
            $this->Pengeluaran_uang_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data pengeluaran uang berhasil diperbarui.');
        } else {
            $this->Pengeluaran_uang_model->insert($data);
            $this->session->set_flashdata('success', 'Data pengeluaran uang berhasil disimpan.');
        }
    }

    private function _save_pengeluaran_barang($id = null)
    {
        $uploadDir = './uploads/pengeluaran_barang/';
        $fullUploadPath = FCPATH . $uploadDir;

        // Pastikan direktori ada
        if (!is_dir($fullUploadPath)) {
            mkdir($fullUploadPath, 0755, true);
        }

        $config['upload_path']   = './' . $uploadDir;
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        $fileData = null;

        // Upload lampiran jika ada
        if (!empty($_FILES['lampiran']['name'])) {
            $config['file_name'] = time() . '_' . $_FILES['lampiran']['name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('lampiran')) {
                $fileData = $this->upload->data();
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/pengeluaran');
            }
        }

        // Jika ada file yang diupload, hapus file lama jika ada
        if ($id) {
            $oldData = $this->Pengeluaran_barang_model->getById($id);
            if ($oldData && $oldData->lampiran && file_exists($fullUploadPath . $oldData->lampiran)) {
                unlink($fullUploadPath . $oldData->lampiran);
            }
        }

        $data = [
            'tanggal'           => $this->input->post('tanggal'),
            'jenis_donasi_id'   => $this->input->post('jenis_donasi_id'),
            'nama_barang'       => $this->input->post('nama_barang'),
            'jumlah'            => $this->input->post('jumlah'),
            'satuan'            => $this->input->post('satuan'),
            'keterangan'        => $this->input->post('keterangan')
        ];

        if ($fileData) {
            $data['lampiran'] = $uploadDir . $fileData['file_name'];
        }

        if ($id) {
            $this->Pengeluaran_barang_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data pengeluaran barang berhasil diperbarui.');
        } else {
            $this->Pengeluaran_barang_model->insert($data);
            $this->session->set_flashdata('success', 'Data pengeluaran barang berhasil disimpan.');
        }
    }

    public function delete_pengeluaran($type, $id)
    {
        if ($type == 'uang') {
            $this->_delete_pengeluaran_uang($id);
        } elseif ($type == 'barang') {
            $this->_delete_pengeluaran_barang($id);
        }

        redirect('admin/pengeluaran');
    }

    private function _delete_pengeluaran_uang($id)
    {
        $data = $this->Pengeluaran_uang_model->getById($id);

        if ($data && $data->lampiran && file_exists(FCPATH . $data->lampiran)) {
            unlink(FCPATH . $data->lampiran);
        }

        $this->Pengeluaran_uang_model->delete($id);
        $this->session->set_flashdata('success', 'Data pengeluaran uang berhasil dihapus.');
    }

    private function _delete_pengeluaran_barang($id)
    {
        $data = $this->Pengeluaran_barang_model->getById($id);

        if ($data && $data->lampiran && file_exists(FCPATH . $data->lampiran)) {
            unlink(FCPATH . $data->lampiran);
        }

        $this->Pengeluaran_barang_model->delete($id);
        $this->session->set_flashdata('success', 'Data pengeluaran barang berhasil dihapus.');
    }

    public function laporan()
    {
        // 1. Setup dasar
        $data['title'] = 'Laporan Keuangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model(['Penerimaan_uang_model', 'Pengeluaran_uang_model', 'Jenis_donasi_model']);
        $this->load->library('pagination');

        // 2. Ambil parameter filter
        $start_date = $this->input->get('start_date') ?? date('Y-m-01');
        $end_date = $this->input->get('end_date') ?? date('Y-m-d');
        $jenis_donasi_id = $this->input->get('jenis_donasi_id');

        // 3. Validasi dan format tanggal
        $db_start_date = date('Y-m-d', strtotime($start_date));
        $db_end_date = date('Y-m-d', strtotime($end_date));

        // 4. Hitung saldo awal (PENTING!)
        $saldo_awal = $this->hitung_saldo_awal($db_start_date, $jenis_donasi_id);

        // 5. Setup pagination
        $config = $this->setup_pagination($db_start_date, $db_end_date, $jenis_donasi_id);
        $this->pagination->initialize($config);
        $offset = $this->uri->segment(3) ?? 0;

        // 6. Ambil data transaksi
        $transaksi = $this->ambil_data_transaksi($config['per_page'], $offset, $db_start_date, $db_end_date, $jenis_donasi_id);

        // 7. Format laporan (PENTING!)
        $laporan = $this->format_laporan($transaksi, $start_date, $saldo_awal);

        // 8. Hitung total dan saldo akhir
        $totals = $this->hitung_total($laporan, $saldo_awal);

        // 9. Siapkan data untuk view
        $data = array_merge($data, [
            'laporan' => $laporan,
            'saldo_awal' => $saldo_awal,
            'pagination_links' => $this->pagination->create_links(),
            'jenis_donasi' => $this->Jenis_donasi_model->get_all(),
            'filter' => compact('start_date', 'end_date', 'jenis_donasi_id')
        ], $totals);

        // 10. Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer');
    }

    private function hitung_saldo_awal($tanggal, $jenis_donasi_id)
    {
        // Ambil hanya transaksi sebelum tanggal (bukan termasuk tanggal itu)
        $tanggal_sebelumnya = date('Y-m-d', strtotime($tanggal . ' -1 day'));

        $penerimaan = $this->Penerimaan_uang_model->get_total_penerimaan_before_date($tanggal_sebelumnya, $jenis_donasi_id);
        $pengeluaran = $this->Pengeluaran_uang_model->get_total_pengeluaran_before_date($tanggal_sebelumnya, $jenis_donasi_id);

        return $penerimaan - $pengeluaran;
    }

    // Fungsi pembantu untuk setup pagination
    private function setup_pagination($start_date, $end_date, $jenis_donasi_id)
    {
        return [
            'base_url' => base_url('admin/laporan'),
            'per_page' => 10,
            'uri_segment' => 3,
            'reuse_query_string' => TRUE,
            'total_rows' => $this->Penerimaan_uang_model->count_filtered($start_date, $end_date, $jenis_donasi_id)
                + $this->Pengeluaran_uang_model->count_filtered($start_date, $end_date, $jenis_donasi_id)
        ];
    }

    // Fungsi pembantu untuk ambil data transaksi
    private function ambil_data_transaksi($limit, $offset, $start_date, $end_date, $jenis_donasi_id)
    {
        return [
            'penerimaan' => $this->Penerimaan_uang_model->get_paginated($limit, $offset, $start_date, $end_date, $jenis_donasi_id),
            'pengeluaran' => $this->Pengeluaran_uang_model->get_paginated($limit, $offset, $start_date, $end_date, $jenis_donasi_id)
        ];
    }

    // Fungsi pembantu untuk format laporan
    private function format_laporan($transaksi, $start_date, $saldo_awal)
    {
        $laporan = [];

        // Tambahkan saldo awal
        $laporan[] = (object)[
            'tanggal' => date('d-m-Y', strtotime($start_date)),
            'keterangan' => 'Saldo Awal Periode',
            'penerimaan' => 0,
            'pengeluaran' => 0,
            'is_saldo_awal' => true,
            'saldo' => $saldo_awal
        ];

        // Tambahkan transaksi penerimaan
        foreach ($transaksi['penerimaan'] as $p) {
            $laporan[] = (object)[
                'tanggal' => date('d-m-Y', strtotime($p->tanggal)),
                'keterangan' => 'Penerimaan dari ' . $p->donatur_nama . ' - ' . $p->keterangan,
                'penerimaan' => $p->jumlah,
                'pengeluaran' => 0,
                'is_saldo_awal' => false
            ];
        }

        // Tambahkan transaksi pengeluaran
        foreach ($transaksi['pengeluaran'] as $k) {
            $laporan[] = (object)[
                'tanggal' => date('d-m-Y', strtotime($k->tanggal)),
                'keterangan' => $k->keterangan,
                'penerimaan' => 0,
                'pengeluaran' => $k->jumlah,
                'is_saldo_awal' => false
            ];
        }

        // Urutkan berdasarkan tanggal
        usort($laporan, function ($a, $b) {
            if ($a->is_saldo_awal) return -1;
            if ($b->is_saldo_awal) return 1;
            return strtotime(str_replace('-', '/', $a->tanggal)) - strtotime(str_replace('-', '/', $b->tanggal));
        });

        // Hitung saldo berjalan
        $running_saldo = $saldo_awal;
        foreach ($laporan as &$row) {
            if (!$row->is_saldo_awal) {
                $running_saldo += $row->penerimaan - $row->pengeluaran;
                $row->saldo = $running_saldo;
            }
        }

        return $laporan;
    }

    // Fungsi pembantu untuk hitung total
    private function hitung_total($laporan, $saldo_awal)
    {
        $total_penerimaan = array_sum(array_column($laporan, 'penerimaan'));
        $total_pengeluaran = array_sum(array_column($laporan, 'pengeluaran'));

        return [
            'total_penerimaan' => $total_penerimaan,
            'total_pengeluaran' => $total_pengeluaran,
            'saldo_akhir' => $saldo_awal + $total_penerimaan - $total_pengeluaran
        ];
    }

    // Di Controller Admin
    public function get_kabupaten($provinsi_id)
    {
        $kabupaten = $this->db->where('provinsi_id', $provinsi_id)
            ->order_by('nama', 'ASC')
            ->get('kabupaten_kota')
            ->result_array();
        echo json_encode($kabupaten);
    }

    public function get_kecamatan($kabupaten_id)
    {
        $kecamatan = $this->db->where('kabupaten_id', $kabupaten_id)
            ->order_by('nama', 'ASC')
            ->get('kecamatan')
            ->result_array();
        echo json_encode($kecamatan);
    }

    public function get_kelurahan($kecamatan_id)
    {
        $kelurahan = $this->db->where('kecamatan_id', $kecamatan_id)
            ->order_by('nama', 'ASC')
            ->get('kelurahan_desa')
            ->result_array();
        echo json_encode($kelurahan);
    }

    // public function laporan()
    // {
    //     $data['title'] = 'Laporan Keuangan';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->model('Penerimaan_uang_model');
    //     $this->load->model('Pengeluaran_uang_model');
    //     $this->load->model('Jenis_donasi_model');
    //     $this->load->library('pagination');

    //     // 1. Ambil dan validasi parameter filter
    //     $start_date = $this->input->get('start_date');
    //     $end_date = $this->input->get('end_date');
    //     $jenis_donasi_id = $this->input->get('jenis_donasi_id');

    //     // Validasi format tanggal
    //     if (!DateTime::createFromFormat('Y-m-d', $start_date)) {
    //         $start_date = date('Y-m-01');
    //     }
    //     if (!DateTime::createFromFormat('Y-m-d', $end_date)) {
    //         $end_date = date('Y-m-d');
    //     }

    //     // 2. Hitung saldo awal periode
    //     $total_penerimaan_sebelum = $this->Penerimaan_uang_model->get_total_penerimaan_before_date($start_date, $jenis_donasi_id);
    //     $total_pengeluaran_sebelum = $this->Pengeluaran_uang_model->get_total_pengeluaran_before_date($start_date, $jenis_donasi_id);
    //     $saldo_awal = $total_penerimaan_sebelum - $total_pengeluaran_sebelum;

    //     // 3. Setup pagination
    //     $config['base_url'] = base_url('admin/laporan');
    //     $config['per_page'] = 10;
    //     $config['uri_segment'] = 3;
    //     $config['reuse_query_string'] = TRUE;
    //     $config['total_rows'] = $this->Penerimaan_uang_model->count_filtered($start_date, $end_date, $jenis_donasi_id)
    //         + $this->Pengeluaran_uang_model->count_filtered($start_date, $end_date, $jenis_donasi_id);
    //     $this->pagination->initialize($config);

    //     // 4. Ambil data transaksi
    //     $offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
    //     $penerimaan = $this->Penerimaan_uang_model->get_paginated($config['per_page'], $offset, $start_date, $end_date, $jenis_donasi_id);
    //     $pengeluaran = $this->Pengeluaran_uang_model->get_paginated($config['per_page'], $offset, $start_date, $end_date, $jenis_donasi_id);

    //     // 5. Format data laporan
    //     $laporan = [];

    //     // Tambahkan saldo awal
    //     $laporan[] = (object)[
    //         'tanggal' => $start_date,
    //         'keterangan' => 'Saldo Awal Periode',
    //         'penerimaan' => 0,
    //         'pengeluaran' => 0,
    //         'is_saldo_awal' => true,
    //         'saldo' => $saldo_awal
    //     ];

    //     // Tambahkan transaksi penerimaan
    //     foreach ($penerimaan as $p) {
    //         $laporan[] = (object)[
    //             'tanggal' => date('d-m-Y', strtotime($p->tanggal)),
    //             'keterangan' => 'Penerimaan dari ' . $p->donatur_nama . ' - ' . $p->keterangan,
    //             'penerimaan' => $p->jumlah,
    //             'pengeluaran' => 0,
    //             'is_saldo_awal' => false,
    //             'saldo' => 0
    //         ];
    //     }

    //     // Tambahkan transaksi pengeluaran
    //     foreach ($pengeluaran as $k) {
    //         $laporan[] = (object)[
    //             'tanggal' => date('d-m-Y', strtotime($k->tanggal)),
    //             'keterangan' => $k->keterangan,
    //             'penerimaan' => 0,
    //             'pengeluaran' => $k->jumlah,
    //             'is_saldo_awal' => false,
    //             'saldo' => 0
    //         ];
    //     }

    //     // 6. Urutkan data - saldo awal tetap di urutan pertama
    //     usort($laporan, function ($a, $b) {
    //         if ($a->is_saldo_awal) return -1;
    //         if ($b->is_saldo_awal) return 1;
    //         return strtotime(str_replace('-', '/', $a->tanggal)) - strtotime(str_replace('-', '/', $b->tanggal));
    //     });

    //     // 7. Hitung saldo berjalan
    //     $running_saldo = $saldo_awal;
    //     foreach ($laporan as &$row) {
    //         if ($row->is_saldo_awal) {
    //             $row->saldo = $running_saldo;
    //         } else {
    //             $running_saldo += $row->penerimaan - $row->pengeluaran;
    //             $row->saldo = $running_saldo;
    //         }
    //     }

    //     // 8. Handle empty data
    //     if (count($laporan) == 1) { // Hanya saldo awal
    //         $laporan[0]->keterangan = 'Tidak ada transaksi pada periode ini';
    //     }

    //     // 9. Siapkan data untuk view
    //     $data['laporan'] = $laporan;
    //     $data['saldo_awal'] = $saldo_awal;
    //     $data['pagination_links'] = $this->pagination->create_links();
    //     $data['jenis_donasi'] = $this->Jenis_donasi_model->get_all();
    //     $data['filter'] = [
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //         'jenis_donasi_id' => $jenis_donasi_id
    //     ];

    //     // 10. Load view
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/laporan', $data);
    //     $this->load->view('templates/footer');
    // }
}
