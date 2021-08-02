<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pertandingan extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function index() {
        $var    = [
            'page'  =>  'admin/pertandingan',
            'title' =>  'Jadwal Pertandingan',
            'pertandingan'   =>  $this->m_app->getPertandingan()->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'   =>  $this->m_app->getAnggota()->result(),

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
                'tempat'    => $this->input->post('tempat'),
                'tanggal'   => $this->input->post('tanggal'),
                'waktu'     => $this->input->post('waktu'),
                'user_id'   => $this->input->post('user_id'),
                'tingkat'   => $this->input->post('tingkat'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('pertandingan', $data);
            
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
                'tingkat'   => $this->input->post('tingkat'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->update('pertandingan', $data, $id);
            
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}