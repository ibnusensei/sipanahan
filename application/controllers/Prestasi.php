<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prestasi extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
        $var    = [
            'page'  =>  'admin/prestasi',
            'title' =>  'Prestasi',
            'prestasi'   =>  $this->m_app->getPrestasi()->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),

            // Tambahan
            'tingkat' => ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'],
        ];
        $this->load->view('layout/admin', $var);
    }

    public function store()
    {
        check_admin();
        if ($this->input->post()) {

            $data = [
                'prestasi'  => $this->input->post('prestasi'),
                'tanggal'   => $this->input->post('tanggal'),
                'user_id'   => $this->input->post('user_id'),
                'tingkat'   => $this->input->post('tingkat'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('prestasi', $data);
            
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
                'prestasi'  => $this->input->post('prestasi'),
                'tanggal'   => $this->input->post('tanggal'),
                'user_id'   => $this->input->post('user_id'),
                'tingkat'   => $this->input->post('tingkat'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('prestasi', $data, $id);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}