<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Latihan extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
        // $date   = ['a' => $_GET['a'], 'b' => $_GET['b']] ?? null;
        $date   = null;
        $var    = [
            'page'  =>  'admin/latihan',
            'title' =>  'Jadwal Latihan',
            'latihan'   =>  $this->m_app->getLatihan(null, null, $date)->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'   =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    public function store()
    {
        check_admin();
        if ($this->input->post()) {

            $data = [
                'tempat'    => $this->input->post('tempat'),
                'tanggal'   => $this->input->post('tanggal'),
                'waktu'     => $this->input->post('waktu'),
                'user_id'   => $this->input->post('user_id'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('latihan', $data);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function update()
    {
        check_admin();
        $id =   $this->input->post('id');
        if ($this->input->post()) {

            $data = [
                'tempat'    => $this->input->post('tempat'),
                'tanggal'   => $this->input->post('tanggal'),
                'waktu'     => $this->input->post('waktu'),
                'user_id'   => $this->input->post('user_id'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('latihan', $data, $id);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function kehadiran()
    {
        // check_admin();
        if ($this->input->post()) {

            $data = [
                'latihan_id'    => $this->input->post('latihan_id'),
                'nilai'     => $this->input->post('nilai'),
                'user_id'   => $this->input->post('user_id'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('kehadiran', $data);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function kehadiran_update()
    {
        // check_admin();
        $id =   $this->input->post('id');
        if ($this->input->post()) {

            $data = [
                'nilai'     => $this->input->post('nilai'),
                'user_id'   => $this->input->post('user_id'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('kehadiran', $data, $id);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}