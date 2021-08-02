<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
        check_admin();
    }

    public function index() {
        $var = [
            'page'  =>  'admin/dashboard',
            'title' =>  'Dashboard',
            'user'  =>  $this->m_app->getAnggota(),
            'pelatih'   =>  $this->m_app->getPelatih(),
            'team'  =>  $this->m_app->getTeam(),
            'userPerTim'  =>  $this->m_app->getUserPerTim(),
            'prestasiPerTahun'  =>  $this->m_app->getPrestasiPerTahun(),
        ];

        $this->load->view('layout/admin', $var);
    }


    // Destroy Data
    // =============================================================================================

    public function destroy($table, $id)
    {
        check_admin();
        $this->m_app->destroy($table, $id);

        $this->session->set_flashdata('success', 'Berhasil Menghapus Data');
        redirect($_SERVER['HTTP_REFERER']);

    }

}