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


class Operator extends CI_Controller
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
        $data['title'] = 'Dashboard Operator';
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
        $this->load->view('operator/index', $data);
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
        $this->load->view('operator/ldnu', $data);
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
        $this->load->view('operator/ltmnu', $data);
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
        $this->load->view('operator/lbm', $data);
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
        $this->load->view('operator/lknu', $data);
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
        $this->load->view('operator/lkknu', $data);
        $this->load->view('templates/footer');
    }

    public function penerimamanfaat()
    {
        $data['title'] = 'Penerima Manfaat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Load model dan library
        $this->load->model('Penerima_model');
        $this->load->library('pagination');

        // Konfigurasi pagination
        $config['base_url'] = base_url('operator/penerimamanfaat');
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
        $this->load->view('operator/penerimamanfaat', $data);
        $this->load->view('templates/footer');
    }

    public function save_penerima()
    {
        $this->load->model('Penerima_model');

        // Validasi nomor HP Indonesia
        $no_hp = $this->input->post('no_hp');
        if (!preg_match('/^(\+62|62|0)[8][1-9][0-9]{6,9}$/', $no_hp)) {
            $this->session->set_flashdata('error', 'Nomor HP harus nomor Indonesia yang valid (contoh: 08123456789, +628123456789, atau 628123456789)');
            redirect('operator/penerimamanfaat');
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
                redirect('operator/penerimamanfaat');
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
                redirect('operator/penerimamanfaat');
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

        redirect('operator/penerimamanfaat');
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


    public function donasi()
    {
        $data['title'] = 'Menu Donasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operator/donasi', $data);
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
        $this->load->view('operator/donatur', $data);
        $this->load->view('templates/footer');
    }

    public function save_donatur()
    {
        $data = [
            'nik_kode'       => $this->input->post('nik_kode'),
            'nama'           => $this->input->post('nama'),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            'tipe'           => $this->input->post('tipe'),
            'agama'          => $this->input->post('agama'),
            'alamat'         => $this->input->post('alamat'),
            'kode_pos'       => $this->input->post('kode_pos'),
            'no_hp'          => $this->input->post('no_hp')
        ];

        if ($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }

        if ($this->Donatur_model->save($data)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal disimpan.');
        }

        redirect('operator/donatur');
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
        $this->load->view('operator/jenis_donasi', $data);
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

        redirect('operator/jenis_donasi');
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
        $config['base_url'] = base_url('operator/penerimaan');
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
        $this->load->view('operator/penerimaan', $data);
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

        redirect('operator/penerimaan');
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
                redirect('operator/penerimaan');
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
                redirect('operator/penerimaan');
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
        $config['base_url'] = base_url('operator/pengeluaran');
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
        $this->load->view('operator/pengeluaran', $data);
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

        redirect('operator/pengeluaran');
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
                redirect('operator/pengeluaran');
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
                redirect('operator/pengeluaran');
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
        $this->load->view('operator/laporan', $data);
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
            'base_url' => base_url('operator/laporan'),
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
}
