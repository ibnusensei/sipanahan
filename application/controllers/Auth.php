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

     public function register() {
    	$var['page'] = 'auth/register';
        $this->load->view('auth/register', $var);
     
    }
    
    public function login()
	{
        $un     = $this->input->post('username');
        $pw     = $this->input->post('password');
        $user   = $this->m_app->getUser($un);

        if (empty($user)){
            $this->session->set_flashdata('message', 'Username tidak ditemukan');
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

                if ($user->level == 1) {
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