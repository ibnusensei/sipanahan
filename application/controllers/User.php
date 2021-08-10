<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
        
    }

    public function index() {
        $var    = [
            'page'  =>  'admin/user',
            'title' =>  'Atlet',
            'level' =>  3,
            'user'  =>  $this->m_app->getAnggota(null)->result(),
            'tim'   =>  $this->m_app->getTeam()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    public function pelatih() {
        $var    = [
            'page'  =>  'admin/user',
            'title' =>  'Pelatih',
            'level' =>  2,
            'user'  =>  $this->m_app->getPelatih(null)->result(),
            'tim'   =>  $this->m_app->getTeam()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    

    public function store()
    {
        check_admin();
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $check = $this->m_app->checkUser($username);
            if ($check > 0) {
                $this->session->set_flashdata('error', 'Username Telah Digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                
            $file =  $_FILES["image"]["name"];
            $upload = $this->m_app->uploadImage($file, 'user');
            if($upload == 'error') {
                $image = 'assets/img/default-user.svg';
                $this->session->set_flashdata('error', 'Gagal Menambah Data');
            } else {
                $image = $upload;
                $this->session->set_flashdata('success', 'Proses Berhasil');
            }


            $data = [
                'nama'      => $this->input->post('nama'),
                'email'     => $this->input->post('email'),
                'telepon'   => $this->input->post('telepon'),
                'alamat'    => $this->input->post('alamat'),
                'username'  => $username,
                'password'  => $this->bcrypt->hash($username),
                'tim_id'    => $this->input->post('tim_id'),
                'level'     => $this->input->post('level'),
                'status'    => 1,
                'image'     => $image
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('users', $data);

            $user = $this->m_app->getUser($username);
            $this->m_app->qrcode($user->id);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    public function update()
    {
        check_admin();
        if ($this->input->post()) {
            $d = $this->m_app->dataUser($this->input->post('id'));
            $username = $this->input->post('username');
            $check = $this->m_app->checkUser($username, $d->id);
            if ($check > 0) {
                $this->session->set_flashdata('error', 'Username Telah Digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            } else {

            $file =  $_FILES["image"]["name"];
            if (empty($file)) {
                $image = $d->image;
            } else {
                $upload = $this->m_app->uploadImage($file, 'user');
                if($upload == 'error') {
                    $image = 'assets/img/default-user.svg';
                    $this->session->set_flashdata('error', 'Gagal Mengubah Data');
                } else {
                    delete_files($d->image);
                    $image = $upload;
                    $this->session->set_flashdata('success', 'Proses Berhasil');
                }
            }
            

            $data = [
                'nama'      => $this->input->post('nama'),
                'email'     => $this->input->post('email'),
                'telepon'   => $this->input->post('telepon'),
                'alamat'    => $this->input->post('alamat'),
                'username'  => $this->input->post('username'),
                'password'  => $this->bcrypt->hash($this->input->post('username')),
                'tim_id'    => $this->input->post('tim_id'),
                'status'    => $this->input->post('status'),
                'image'     => $image
            ];

            $data = $this->security->xss_clean($data);
            $id   = $this->input->post('id');
            $this->m_app->update('users', $data, $id);

            delete_files('assets/img/qrcode/'.$d->id.'.png');
            $user = $this->m_app->getUser($username);
            $this->m_app->qrcode($user->id);
            
            redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    public function penilaian()
    {
        check_admin();
        if ($this->input->post()) {
            $data = [
                'user_id'   => $this->input->post('user_id'),
                'n1'        => $this->input->post('n1'),
                'n2'        => $this->input->post('n2'),
                'n3'        => $this->input->post('n3'),
                'n4'        => $this->input->post('n4'),
                'n5'        => $this->input->post('n5'),
                'n6'        => $this->input->post('n6'),
                'n7'        => $this->input->post('n7'),
                'n8'        => $this->input->post('n8'),
                'n9'        => $this->input->post('n9'),
                'penilai'   => $this->session->id,
                'tanggal'   => date('Y-m-d')
            ];

            $data = $this->security->xss_clean($data);
            $id   = $this->input->post('id');

            if ($id != null) {
                $this->m_app->update('penilaian', $data, $id);
            } else {
                $this->m_app->store('penilaian', $data);
            }
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    // Profil

    public function update_profil()
    {
        if ($this->input->post()) {
            $d = $this->m_app->dataUser($this->session->id);
            $username = $this->input->post('username');
            $check = $this->m_app->checkUser($username, $d->id);
            if ($check > 0) {
                $this->session->set_flashdata('error', 'Username Telah Digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            } else {

            $file =  $_FILES["image"]["name"];
            if (empty($file)) {
                $image = $d->image;
            } else {
                $upload = $this->m_app->uploadImage($file, 'user');
                if($upload == 'error') {
                    $image = $d->image;
                    $this->session->set_flashdata('error', 'Gagal Mengubah Data');
                } else {
                    delete_files($d->image);
                    $image = $upload;
                    $this->session->set_flashdata('success', 'Proses Berhasil');
                }
            }

            $data = [
                'nama'      => $this->input->post('nama'),
                'email'     => $this->input->post('email'),
                'username'  => $this->input->post('username'),
                'image'     => $image,
                'telepon'   => $this->input->post('telepon'),
                'alamat'    => $this->input->post('alamat'),
            ];

            if ($this->input->post('password') != null) {
                $data['password'] = $this->bcrypt->hash($this->input->post('password'));
            }

            $data = $this->security->xss_clean($data);
            $id   = $this->input->post('id');
            $this->m_app->update('users', $data, $id);
            
            delete_files('assets/img/qrcode/'.$d->id.'.png');
            $user = $this->m_app->getUser($username);
            $this->m_app->qrcode($user->id);
            
            redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

}