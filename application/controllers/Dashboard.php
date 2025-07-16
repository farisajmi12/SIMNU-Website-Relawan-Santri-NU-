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


class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
        // Optional: Cek role user (jika bukan admin)
    }

    public function index()
    {
        $data['title'] = 'Dashboard Lembaga';
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
        $this->load->view('dashboard/index', $data);
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
        $this->load->view('dashboard/ldnu', $data);
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
        $this->load->view('dashboard/ltmnu', $data);
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
        $this->load->view('dashboard/lbm', $data);
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
        $this->load->view('dashboard/lknu', $data);
        $this->load->view('templates/footer');
    }

    public function lkknu()
    {
        $data['title'] = 'LKKNU';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        // Hitung berdasarkan sub_kategori
        $sub_kategori_list = [
            'Yatim',
            'Piatu',
            'Yatim & Piatu',
            'Cerai',
            'Ditinggal Mati',
            'Pengangguran',
            'Tua Renta',
            'Fakir',
            'Miskin'
        ];

        foreach ($sub_kategori_list as $sub) {
            $key = str_replace([' ', '&'], ['_', 'dan'], strtolower($sub)); // yatim, piatu, yatim_dan_piatu, dll
            $data[$key] = $this->db->where('sub_kategori', $sub)
                ->count_all_results('penerimamanfaat');
        }

        // Barang Masuk (total per nama_barang)
        $data['barang_masuk'] = $this->db->select('nama_barang, COUNT(*) as total')
            ->from('penerimaan_barang')
            ->group_by('nama_barang')
            ->get()
            ->result_array();

        // Jumlah donatur
        $data['donatur_count'] = $this->db->count_all('donatur');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/lkknu', $data);
        $this->load->view('templates/footer');
    }
}
