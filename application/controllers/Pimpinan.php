<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pimpinan extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
        $var    = [
            'page'  =>  'admin/pimpinan',
            'title' =>  'Pimpinan',
            'pimpinan'   =>  $this->m_app->getPimpinan()->result(),
            

            // Tambahan
            
        ];
        $this->load->view('layout/admin', $var);
    }

    public function store()
    {
        check_admin();
        if ($this->input->post()) {

            $data = [
                'nama'  => $this->input->post('nama'),
              
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('pimpinan', $data);
            
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
                'nama'  => $this->input->post('nama'),
              
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('pimpinan', $data, $id);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}