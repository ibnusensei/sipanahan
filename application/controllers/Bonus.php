<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bonus extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function atlet() {
        $var    = [
            'page'  =>  'admin/bonus',
            'title' =>  'Bonus Atlet',
            'bonus' =>  $this->m_app->getBonus(3)->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    public function pelatih() {
        $var    = [
            'page'  =>  'admin/bonus',
            'title' =>  'Bonus Pelatih',
            'bonus' =>  $this->m_app->getBonus(2)->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    public function store()
    {
        check_admin();
        if ($this->input->post()) {

            $data = [
                'bonus'     => $this->input->post('bonus'),    
                'tanggal'   => $this->input->post('tanggal'),
                'user_id'   => $this->input->post('user_id'),
                'jumlah'    => $this->input->post('jumlah'),
                'ket'       => $this->input->post('ket'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('bonus', $data);
            
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function update()
    {
        check_admin();
        $id =   $this->input->post('id');
        if ($this->input->post()) {

            $data = [
                'bonus'     => $this->input->post('bonus'),    
                'tanggal'   => $this->input->post('tanggal'),
                'user_id'   => $this->input->post('user_id'),
                'jumlah'    => $this->input->post('jumlah'),
                'ket'       => $this->input->post('ket'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('bonus', $data, $id);
            
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}