<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tim extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
        $var    = [
            'page'  =>  'admin/tim',
            'title' =>  'Team',
            'tim'   =>  $this->m_app->getTeam()->result()
        ];
        $this->load->view('layout/admin', $var);
    }

    public function store()
    {
        check_admin();
        if ($this->input->post()) {

            $data = [
                'tim'       => $this->input->post('tim'),
                'lokasi'    => $this->input->post('lokasi'),
                'cabang'    => $this->input->post('cabang'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('tim', $data);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function update()
    {
        check_admin();
        if ($this->input->post()) {

            $data = [
                'tim'       => $this->input->post('tim'),
                'lokasi'    => $this->input->post('lokasi'),
                'cabang'    => $this->input->post('cabang'),
            ];

            $data = $this->security->xss_clean($data);
            $id   = $this->input->post('id');
            $this->m_app->update('tim', $data, $id);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}