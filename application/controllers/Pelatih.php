<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pelatih extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
        check_pelatih();
    }

    public function index() {
        $id = $this->session->id;
        $query = $this->m_app->getBonus(null, null, $id);
        $bonus = 0;
        foreach ($query->result() as $d) {
            $bonus += $d->jumlah;
        }
        $var = [
            'page'  =>  'pelatih/dashboard',
            'title' =>  'Dashboard',
            'user'  =>  $this->m_app->getAnggota(),
            'prestasi'  =>  $this->m_app->getPrestasi(null, $id),
            'latihan'   =>  $this->m_app->getLatihan(),
            'melatih'   =>  $this->m_app->getLatihan(null, $id),
            'kehadiran' =>  $this->m_app->getKehadiran(null, $id),
            'bonus'     =>  $bonus
        ];

        $this->load->view('layout/pelatih', $var);
    }

    public function profil() {
        $var = [
            'page'  =>  'pelatih/profil',
            'head'  =>  'akun',
            'title' =>  'Profil',
            'user'  =>  $this->m_app->getPelatih($this->session->id)->row(),
        ];

        $this->load->view('layout/pelatih', $var);
    }

    public function latihan() {
        $var    = [
            'page'  =>  'pelatih/latihan',
            'title' =>  'Jadwal Latihan',
            'latihan'       =>  $this->m_app->getLatihan()->result(),
            'kehadiran'     =>  $this->m_app->getLatihan()->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'       =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/pelatih', $var);
    }

    public function pertandingan() {
        $var    = [
            'page'  =>  'pelatih/pertandingan',
            'title' =>  'Jadwal Pertandingan',
            'pertandingan'   =>  $this->m_app->getPertandingan()->result(),
            'user'  =>  $this->m_app->getPelatih()->result(),
            'anggota'   =>  $this->m_app->getAnggota()->result(),

            // Tambahan
            'tingkat' => ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'],
        ];
        $this->load->view('layout/pelatih', $var);
    }

    public function prestasi() {
        $var    = [
            'page'  =>  'pelatih/prestasi',
            'title' =>  'Prestasi',
            'prestasi'   =>  $this->m_app->getPrestasi(null, $this->session->id)->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),

            // Tambahan
            'tingkat' => ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'],
        ];
        $this->load->view('layout/pelatih', $var);
    }

    public function bonus() {
        $var    = [
            'page'  =>  'pelatih/bonus',
            'title' =>  'Bonus pelatih',
            'bonus' =>  $this->m_app->getBonus(null, null, $this->session->id)->result(),
            'user'  =>  $this->m_app->getAnggota()->result(),
        ];
        $this->load->view('layout/pelatih', $var);
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
            
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function penilaian() {
        $d = $this->m_app->dataUser($this->session->id);
        $var    = [
            'page'  =>  'pelatih/user',
            'title' =>  'Atlet Tim '.$d->tim,
            'level' =>  3,
            'user'  =>  $this->m_app->getAnggota(null, $d->tim_id)->result(),
            'tim'   =>  $this->m_app->getTeam()->result(),
        ];
        $this->load->view('layout/pelatih', $var);
    }

}