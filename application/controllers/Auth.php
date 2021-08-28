<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
    	$var['page']    = 'auth/login';
        $this->load->view('layout/auth', $var);
     
    }

    public function forgot_password() {
    	$var['page']    = 'auth/forgot_password';
        $this->load->view('layout/auth', $var);
     
    }

    public function reset_password($reset_key) {
    	$var['page']    = 'auth/reset_password';
        $var['reset_key'] = $reset_key;
        $this->load->view('layout/auth', $var);
     
    }

    public function update_password()
	{
        $reset_key     = $this->input->post('reset_password');
        $pw     = $this->input->post('password');
        $user   = $this->m_app->getUserWithKey($reset_key);

        if (empty($user)){
            $this->session->set_flashdata('message', 'Key Tidak Valid');
            redirect('auth');
        } else {
            $data['password'] = $this->bcrypt->hash($this->input->post('password'));

            $data = $this->security->xss_clean($data);
            $this->m_app->update('users', $data, $user->id);

            $this->session->set_flashdata('message', 'Reset Berhasil');
            redirect('auth');
        }
    }

     public function register() {
    	$var['page'] = 'auth/register';
        $this->load->view('auth/register', $var);
     
    }
    
    public function login()
	{
        $email     = $this->input->post('email');
        $pw     = $this->input->post('password');
        $user   = $this->m_app->getUser($email);

        if (empty($user)){
            $this->session->set_flashdata('message', 'Email tidak ditemukan');
            redirect('auth');
        } else {
            if(password_verify($pw, $user->password)) {
                $session = array(
                    'authenticated' => TRUE, // Buat session authenticated dengan value true
                    'username' => $user->username, // Buat session username
                    'nama' => $user->nama, // Buat session nama
                    'level' => $user->level, // Buat session level
					'image' => $user->image, // Buat session role
					'email' => $user->email, // Buat session email
                    'id' => $user->id, // Buat session role
                    'is_login' => TRUE
                );

                $this->session->set_userdata($session);

                if ($user->level == 1 or $user->level == 4) {
                    redirect('admin');
                } elseif ($user->level == 2) {
                    redirect('pelatih');
                } elseif ($user->level == 3) {
                    redirect('atlet');
                } else {
                    redirect('auth');
                }
                
                 
            } else {
                $this->session->set_flashdata('message', 'Password salah');
                redirect('auth');
            }
        }
    }

    public function check_email()
	{
        $email     = $this->input->post('email');
        $user   = $this->m_app->getUser($email);

        if (empty($user)){
            $this->session->set_flashdata('message', 'Email tidak ditemukan');
            redirect('auth/forgot_password');
        } else {
            $reset_key = random_string('alnum', 50);
            if ($this->m_app->update_reset_key($email, $reset_key)) {
                $this->load->library('email');
				$config = array();
				$config['charset'] = 'utf-8';
				$config['useragent'] = 'Codeigniter';
				$config['protocol']= "smtp";
				$config['mailtype']= "html";
				$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
				$config['smtp_port']= "465";
				$config['smtp_timeout']= "5";
				$config['smtp_user']= "neonsensei69@gmail.com"; // isi dengan email kamu
				$config['smtp_pass']= "Fire0799"; // isi dengan password kamu
				$config['crlf']="\r\n"; 
				$config['newline']="\r\n"; 
				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email
					
				$this->email->initialize($config);
				//konfigurasi pengiriman
				$this->email->from($config['smtp_user']);
				$this->email->to($this->input->post('email'));
				$this->email->subject("Reset your password");
 
				$message = "<h1>Sistem Informasi Atlet Panahan Banjarmasin</h1><br><p>Anda melakukan permintaan reset password</p>";
				$message .= "<a class='btn btn-primary' href='".site_url('auth/reset_password/'.$reset_key)."'>klik reset password</a>";
				$this->email->message($message);
				
				if($this->email->send())
				{
					echo "silahkan cek email <b>".$this->input->post('email').'</b> untuk melakukan reset password';
				}else
				{
					echo "Berhasil melakukan registrasi, gagal mengirim verifikasi email";
				}
				
				echo "<br><br><a href='".site_url("auth")."'>Kembali ke Menu Login</a>";
            } else {
                var_dump('error');
            }
        }
    }

    public function daftar(){
    	$nama = $this->input->post('nama');
    	$username = $this->input->post('username');
        $password = $this->input->post('password');
        $telepon = $this->input->post('telepon');

    	$msg = [
            'alpha_numeric_spaces' => 'inputan hanya huruf dan angka',
            'min_length' => 'minimal 8 huruf',
            'is_unique'  => 'username sudah digunakan',
        ];

        $this->form_validation->set_rules('nama', 'Nama', 'trim|alpha_numeric_spaces|min_length[8]', $msg);
        $this->form_validation->set_rules('username', 'username', 'is_unique[pengguna.username]', $msg);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]', $msg);

        if($this->form_validation->run()== FALSE){
        	$var['page'] = 'auth/register';
        	$this->load->view('auth/register', $var);
        }
        else {
        	 $data = [
                'nama'          => $nama,
                'username'      => $username,
                'password'      => $this->bcrypt->hash($password),
                'register_at'   => date('Y-m-d'),
                'level'         => 2,
                'telepon'       => $telepon,
                'foto'          => 'admin.png',
            ];


            $this->m_app->tambah('pengguna', $data);
            $id = $this->db->insert_id();
            $var['id'] = $id;
            $this->session->set_userdata('log', $var);

            redirect('app');
        }
    }

    function logout(){
    	$this->session->sess_destroy();
    	redirect('auth');
    }
}