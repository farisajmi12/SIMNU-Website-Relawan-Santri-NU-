<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_DB_query_builder $db
 * @property User_model $User_model
 * @property CI_Router $router
 */

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $email = $this->session->userdata('email');
        $role_id = $this->session->userdata('role_id');
        $current_class = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();

        if (!$email) {
            // Belum login
            if (!($current_class == 'auth' && in_array($current_method, ['index', 'registration', 'forgotpassword', 'resetpassword']))) {
                // Kalau bukan halaman login dan registrasi, redirect ke login
                redirect('auth');
            }
        } else {
            // Sudah login
            if ($current_class == 'auth' && in_array($current_method, ['index', 'registration'])) {
                // Kalau sudah login tapi masih akses halaman login atau registrasi, redirect ke dashboard sesuai role
                if ($role_id == 1) {
                    redirect('admin');
                } elseif ($role_id == 2) {
                    redirect('user');
                } elseif ($role_id == 3) {
                    redirect('operator');
                } else {
                    redirect('auth/blocked');
                }
            }
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('login', 'Email or Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'SIMNU Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasinya success
            $this->_login();
        }
    }


    private function _login()
    {
        $login = $this->input->post('login'); // Bisa username atau email
        $password = $this->input->post('password');

        // Load model User_model
        $this->load->model('User_model');

        // Cek user berdasarkan username atau email
        $user = $this->User_model->getUserByLogin($login);

        if ($user) {
            // Jika usernya aktif
            if ($user['is_active'] == 1) {
                // Cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email'    => $user['email'],
                        'name'    => $user['name'],
                        'username' => $user['username'],
                        'role_id'  => $user['role_id'],

                    ];
                    $this->session->set_userdata($data);

                    // Redirect berdasarkan role_id
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('user');
                    } elseif ($user['role_id'] == 3) {
                        redirect('operator'); // pastikan kamu punya controller bernama Operator
                    } else {
                        redirect('auth/blocked');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Email has not been activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim|min_length[2]', [
            'required' => 'Nama wajib diisi!',
            'min_length' => 'Nama minimal 2 karakter!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|alpha_numeric', [
            'required' => 'Username wajib diisi!',
            'min_length' => 'Username minimal 3 karakter!',
            'alpha_numeric' => 'Username hanya boleh huruf dan angka!'
        ]);
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'password2 dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIMNU User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            // Filter nomor telepon
            $no_telepon = preg_replace('/[^0-9]/', '', $this->input->post('no_telepon', true));
            if (substr($no_telepon, 0, 1) == '0') {
                $no_telepon = '+62' . substr($no_telepon, 1);
            }

            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'no_telepon' => $no_telepon,
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            // //siapkan token
            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $email,
            //     'token' => $token,
            //     'date_created' => time()
            // ];

            $this->db->insert('user', $data);
            // $this->db->delete('user_token', ['email' => $email]); // bersihkan token lama
            // $this->db->insert('user_token', $user_token);         // simpan token baru

            // $this->_sendEmail($token, 'verify');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created. Please Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out!</div>');
        redirect('auth');
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    // private function _sendEmail($token, $type)
    // {
    //     $config = [
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'relawansantrinu@gmail.com',
    //         'smtp_pass' => 'nrohgqonxpynbavj',
    //         'smtp_port' => 465,
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'newline'   => "\r\n"
    //     ];

    //     $this->load->library('email');
    //     $this->email->initialize($config);

    //     $this->email->from('relawansantrinu@gmail.com', 'SIMNU');
    //     $this->email->to($this->input->post('email'));

    //     if ($type == 'verify') {
    //         $this->email->subject('Account Verification');
    //         $this->email->message('Click this link to verify your account: 
    //         <a href="' . base_url('auth/verify?email=' . urlencode($this->input->post('email')) . '&token=' . urlencode($token)) . '">
    //         Activate</a>');
    //     }

    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }

    // private function _sendEmail($token, $type)
    // {
    //     $config = [
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'relawansantrinu@gmail.com',
    //         'smtp_pass' => 'nrohgqonxpynbavj',
    //         'smtp_port' => 465,
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'newline'   => "\r\n"
    //     ];

    //     $this->load->library('email');
    //     $this->email->initialize($config);

    //     $this->email->from('relawansantrinu@gmail.com', 'relawansantrinu');
    //     $this->email->to($this->input->post('email', true));

    //     if ($type == 'verify') {
    //         $email = urlencode($this->input->post('email', true));
    //         $token = urlencode($token);
    //         $verify_link = base_url("auth/verify?email={$email}&token={$token}");
    //         $this->email->subject('Account Verification');
    //         $this->email->message('Click this link to activate your account: <a href="' . $verify_link . '">Activate</a>');
    //     }

    //     if (!$this->email->send()) {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }


    // public function verify()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $user_token = $this->db->get_where('user_token', ['email' => $email, 'token' => $token])
    //             ->row_array();

    //         if ($user_token) {
    //             if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
    //                 $this->db->set('is_active', 1);
    //                 $this->db->where('email', $email);
    //                 $this->db->update('user');

    //                 $this->db->delete('user_token', ['email' => $email, 'token' => $token]);

    //                 $this->session->set_flashdata(
    //                     'message',
    //                     '<div class="alert alert-success" role="alert">
    //                 ' . $email . ' has been activated! Please login.</div>'
    //                 );
    //                 redirect('auth');
    //             } else {
    //                 $this->db->delete('user', ['email' => $email]);
    //                 $this->db->delete('user_token', ['email' => $email, 'token' => $token]);

    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //                 Account activation failed! Token expired.</div>');
    //                 redirect('auth');
    //             }
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //             Account activation failed! Wrong token.</div>');
    //             redirect('auth');
    //         }
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //         Account activation failed! Wrong email.</div>');
    //         redirect('auth');
    //     }
    // }


    // public function verify()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     // Pastikan token dan email di-decode
    //     $email = urldecode($email);
    //     $token = urldecode($token);

    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $user_token = $this->db->get_where('user_token', ['email' => $email, 'token' => $token])->row_array();
    //         echo "Email: " . $email . "<br>";
    //         echo "Token (URL): " . $token . "<br>";

    //         $user_token = $this->db->get_where('user_token', ['email' => $email, 'token' => $token])->row_array();

    //         if ($user_token) {
    //             echo "Token ditemukan!<br>";
    //         } else {
    //             echo "Token tidak cocok!<br>";
    //         }

    //         if ($user_token) {
    //             if (time() - $user_token['date_created'] < (60 * 60 * 24)) { // 24 jam
    //                 log_message('debug', 'Token valid, aktivasi user...');
    //                 $this->db->set('is_active', 1);
    //                 $this->db->where('email', $email);
    //                 $this->db->update('user');

    //                 // Hapus token agar tidak bisa diklik ulang
    //                 $this->db->delete('user_token', ['email' => $email]);

    //                 $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
    //                 redirect('auth');
    //             } else {
    //                 log_message('debug', 'Token expired.');
    //                 // Token expired, hapus user dan token
    //                 // $this->db->delete('user', ['email' => $email]);
    //                 // $this->db->delete('user_token', ['email' => $email]);

    //                 // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
    //                 // redirect('auth');
    //             }
    //         } else {
    //             log_message('debug', 'Token not found.');
    //             // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Invalid token.</div>');
    //             // redirect('auth');
    //         }
    //     } else {
    //         log_message('debug', 'User not found.');
    //         // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Email not found.</div>');
    //         // redirect('auth');
    //     }
    // }

    public function forgotpassword()
    {
        $this->form_validation->set_rules('login', 'Email atau Username', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $login = $this->input->post('login', true);

            // Cek email atau username
            $user = $this->db->get_where('user', ['email' => $login])->row_array();
            if (!$user) {
                $user = $this->db->get_where('user', ['username' => $login])->row_array();
            }

            if ($user) {
                // Simpan email ke session
                $this->session->set_userdata('reset_email', $user['email']);

                // Langsung arahkan ke halaman reset password
                redirect('auth/resetpassword');
            } else {
                // Jika tidak ditemukan, kembali ke form forgotpassword
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Email atau username tidak ditemukan.</div>');
                redirect('auth/forgotpassword');
            }
        }
    }


    public function resetpassword()
    {
        // Cek apakah sudah melalui forgotpassword
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/reset-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            // Bersihkan session
            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password berhasil diubah. Silakan login.</div>');
            redirect('auth');
        }
    }
}
