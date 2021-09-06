<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Laporan extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
        check_admin();
    }

    public function atlet() {
        $var    = [
            'page'  =>  'admin/laporan/user',
            'title' =>  'Atlet',
            'level' =>  3,
            'user'  =>  $this->m_app->getAnggota(null)->result(),
            'tim'   =>  $this->m_app->getTeam()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    public function pelatih() {
        $var    = [
            'page'  =>  'admin/laporan/user',
            'title' =>  'Pelatih',
            'level' =>  2,
            'user'  =>  $this->m_app->getPelatih(null)->result(),
            'tim'   =>  $this->m_app->getTeam()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

    public function prestasi() {
        $var    = [
            'page'  =>  'admin/laporan/prestasi',
            'title' =>  'Prestasi',
            'prestasi'   =>  $this->m_app->getPrestasi()->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),

            // Tambahan
            'tingkat' => ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'],
        ];
        $this->load->view('layout/admin', $var);
    }

    public function alat() {
        $var    = [
            'page'  =>  'admin/laporan/alat',
            'title' =>  'Alat',
            'user'  =>  $this->m_app->getAnggota()->result(),
            'alat'  =>  $this->m_app->getAlat()->result(),

            // Tambahan
            'jenis' => ['Busur', 'Anak Panah', 'Target'],
            'kondisi'   => ['Baik', 'Rusak', 'Hilang'],
        ];
        $this->load->view('layout/admin', $var);
    }

    public function latihan() {
        // $date   = ['a' => $_GET['a'], 'b' => $_GET['b']] ?? null;
        $date   = null;
        $var    = [
            'page'  =>  'admin/laporan/latihan',
            'title' =>  'Jadwal Latihan',
            'latihan'   =>  $this->m_app->getLatihan(null, null, $date)->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'   =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/admin', $var);
    }

}