<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Atlet extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
        check_atlet();
    }

    public function index() {
        $id = $this->session->id;
        $query = $this->m_app->getBonus(null, null, $id);
        $bonus = 0;
        foreach ($query->result() as $d) {
            $bonus += $d->jumlah;
        }
        $var = [
            'page'  =>  'atlet/dashboard',
            'title' =>  'Dashboard',
            'user'  =>  $this->m_app->getAnggota(),
            'prestasi'  =>  $this->m_app->getPrestasi(null, $id),
            'latihan'   =>  $this->m_app->getLatihan(),
            'kehadiran' =>  $this->m_app->getKehadiran(null, $id),
            'bonus'     =>  $bonus
        ];

        $this->load->view('layout/atlet', $var);
    }

    public function profil() {
        $var = [
            'page'  =>  'atlet/profil',
            'head'  =>  'akun',
            'title' =>  'Profil',
            'user'  =>  $this->m_app->getAnggota($this->session->id)->row(),
        ];

        $this->load->view('layout/atlet', $var);
    }

    public function latihan() {
        $var    = [
            'page'  =>  'atlet/latihan',
            'title' =>  'Jadwal Latihan',
            'latihan'       =>  $this->m_app->getLatihan()->result(),
            'kehadiran'     =>  $this->m_app->getLatihan()->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'       =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/atlet', $var);
    }

    public function pertandingan() {
        $var    = [
            'page'  =>  'atlet/pertandingan',
            'title' =>  'Jadwal Pertandingan',
            'pertandingan'   =>  $this->m_app->getPertandingan()->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'   =>  $this->m_app->getAnggota()->result(),

            // Tambahan
            'tingkat' => ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'],
        ];
        $this->load->view('layout/atlet', $var);
    }

    public function prestasi() {
        $var    = [
            'page'  =>  'atlet/prestasi',
            'title' =>  'Prestasi',
            'prestasi'   =>  $this->m_app->getPrestasi(null, $this->session->id)->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),

            // Tambahan
            'tingkat' => ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'],
        ];
        $this->load->view('layout/atlet', $var);
    }

    public function bonus() {
        $var    = [
            'page'  =>  'atlet/bonus',
            'title' =>  'Bonus Atlet',
            'bonus' =>  $this->m_app->getBonus(null, null, $this->session->id)->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/atlet', $var);
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

    public function kehadiran()
    {
        if ($this->input->post()) {

            $data = [
                'latihan_id'=> $this->input->post('latihan_id'),
                'user_id'   => $this->session->id,
                'nilai'     => null,
            ];

            $data = $this->security->xss_clean($data);
            $this->m_app->store('kehadiran', $data);
            
            $this->session->set_flashdata('success', 'Proses Berhasil');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

}