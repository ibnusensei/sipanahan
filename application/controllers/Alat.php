<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Alat extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
        $var    = [
            'page'  =>  'admin/alat',
            'title' =>  'Alat',
            'user'  =>  $this->m_app->getAnggota()->result(),
            'alat'  =>  $this->m_app->getAlat()->result(),

            // Tambahan
            'jenis' => ['Busur', 'Anak Panah', 'Target'],
            'kondisi'   => ['Baik', 'Rusak', 'Hilang'],
        ];
        $this->load->view('layout/admin', $var);
    }

    public function store()
    {
        check_admin();
        if ($this->input->post()) {
            $file =  $_FILES["image"]["name"];
            $upload = $this->m_app->uploadImage($file, 'alat');
            if($upload == 'error') {
                $image = 'assets/img/default-user.svg';
                $this->session->set_flashdata('error', 'Gagal Menambah Data');
            } else {
                $image = $upload;
                $this->session->set_flashdata('success', 'Proses Berhasil');
            }

            $data = [
                'alat'      => $this->input->post('alat'),
                'user_id'   => $this->input->post('user_id'),
                'jenis'     => $this->input->post('jenis'),
                'kondisi'   => $this->input->post('kondisi'),
                'image'     => $image
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('alat', $data);
            
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function update()
    {
        check_admin();
        $id =   $this->input->post('id');
        $d  =   $this->m_app->getAlat($id)->row();
        if ($this->input->post()) {
            if ($this->input->post['image'] != null) {
                $file =  $_FILES["image"]["name"];
                $upload = $this->m_app->uploadImage($file, 'alat');
                if($upload == 'error') {
                    $image = 'assets/img/default-user.svg';
                    $this->session->set_flashdata('error', 'Gagal Mengubah Data');
                } else {
                    $image = $upload;
                    $this->session->set_flashdata('success', 'Proses Berhasil');
                }
            } else {
                $image = $d->image;
            }
            

            $data = [
                'alat'      => $this->input->post('alat'),
                'user_id'   => $this->input->post('user_id'),
                'jenis'     => $this->input->post('jenis'),
                'kondisi'   => $this->input->post('kondisi'),
                'image'     => $image
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('alat', $data, $id);
            
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}