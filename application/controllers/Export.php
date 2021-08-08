<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Export extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(['m_app']);
    }

    public function user($user_id) {
        $d = $this->m_app->getPengguna($user_id)->row();
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 8, ($d->level == 2) ? 'Kartu Tanda Pelatih' : 'Kartu Tanda Atlet', 1, 1, 'C');
        $pdf->Cell(185, 90, '', 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);

        // set JPEG quality
        $pdf->setJPEGQuality(75);

        // Image method signature:
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
        

        $pdf->SetFont('', 'B', 12);
        $pdf->Image(base_url($d->image), 70, 25, 75, 75, '', 'http://www.tcpdf.org', '', true, 100, '', false, false, 0, false, false, false);
        $pdf->Cell(185, 8, $d->nama, 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, "Email ", 1, 0, 'L');
        $pdf->Cell(135, 8, $d->email, 1, 1, '');
        $pdf->Cell(50, 8, "Team ", 1, 0, 'L');
        $pdf->Cell(135, 8, $d->tim, 1, 1, '');
        $pdf->Cell(50, 8, "Status ", 1, 0, 'L');
        $pdf->Cell(135, 8, ($d->status == 1) ? 'Aktif' : 'Non-Aktif', 1, 1, '');
        $pdf->SetFont('', '', 12);

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Data Atlet - '.$tanggal.'.pdf'); 
    }

    public function atlet() {
        $data = $this->m_app->getAnggota();
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('l');
        $this->headl($pdf);
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(300, 0, "Laporan Data Atlet - ".$tanggal, 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nama", 1, 0, 'C');
        $pdf->Cell(55, 8, "Team", 1, 0, 'C');
        $pdf->Cell(50, 8, "Email", 1, 0, 'C');
        $pdf->Cell(30, 8, "Telepon", 1, 0, 'C');
        $pdf->Cell(50, 8, "Alamat", 1, 0, 'C');
        $pdf->Cell(35, 8, "Status", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addUser($pdf, $x+1, $d);
        }
        $tanggal = date('d-m-Y');
        $this->ttdl($pdf);
        $pdf->Output('Laporan Data Atlet - '.$tanggal.'.pdf'); 
    }

    public function pelatih() {
        $data = $this->m_app->getPelatih();
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('l');
        $this->headl($pdf);
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 0, "Laporan Data Pelatih - ".$tanggal, 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nama", 1, 0, 'C');
        $pdf->Cell(55, 8, "Team", 1, 0, 'C');
        $pdf->Cell(50, 8, "Email", 1, 0, 'C');
        $pdf->Cell(30, 8, "Telepon", 1, 0, 'C');
        $pdf->Cell(50, 8, "Alamat", 1, 0, 'C');
        $pdf->Cell(35, 8, "Status", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addUser($pdf, $x+1, $d);
        }
        $tanggal = date('d-m-Y');
        $this->ttdl($pdf);
        $pdf->Output('Laporan Data Pelatih - '.$tanggal.'.pdf'); 
    }

    public function prestasi($user_id = null) {
        $data = $this->m_app->getPrestasi(null, $user_id);
 
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $this->head($pdf);

        if ($user_id != null) {
            $user   = $this->m_app->getAnggota($user_id)->row();
            $pdf->SetFont('', 'B', 20);
            $pdf->Cell(185, 8, 'Surat Rekomendasi', 0, 1, 'C');
            $pdf->Cell(185, 15, '', 0, 1, 'C');

            $pdf->SetFont('', '', 12);
            $pdf->Cell(185, 8, 'Dengan Ini Merekomendasikan :' , 0, 1, 'L');
            $pdf->Cell(50, 8, 'Nama' , 0, 0, 'L');
            $pdf->SetFont('', 'B', 12);
            $pdf->Cell(135, 8, ': '.$user->nama , 0, 1, 'L');

            $pdf->SetFont('', '', 12);
            $pdf->Cell(50, 8, 'Team' , 0, 0, 'L');
            $pdf->SetFont('', 'B', 12);
            $pdf->Cell(135, 8, ': '.$user->tim , 0, 1, 'L');

            $pdf->SetFont('', '', 12);
            $pdf->Cell(185, 8, 'Dengan prestasi yang diraih sebagai berikut :' , 0, 1, 'L');
        } else {
            $pdf->SetFont('', 'B', 20);
            $pdf->Cell(185, 0, "Laporan Data Prestasi", 0, 1, 'C');
        }

        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Prestasi", 1, 0, 'C');
        $pdf->Cell(35, 8, "Atlet", 1, 0, 'C');
        $pdf->Cell(50, 8, "Tingkat", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tanggal", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addPrestasi($pdf, $x+1, $d);
        }
        
        $this->ttd($pdf);
        $pdf->Output('Laporan Data Prestasi.pdf'); 
    }

    public function pertandingan($user_id = null) {
        
        $data = $this->m_app->getPertandingan();
 
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $this->head($pdf);
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 0, "Laporan Data Pertandingan", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Pertandingan", 1, 0, 'C');
        $pdf->Cell(35, 8, "Pelatih", 1, 0, 'C');
        $pdf->Cell(50, 8, "Tingkat", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tanggal", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addPertandingan($pdf, $x+1, $d);
        }
        
        $this->ttd($pdf);
        $pdf->Output('Laporan Data Prestasi.pdf'); 
    }

    public function surat_prestasi($id) {
        $d = $this->m_app->getPrestasi($id)->row();
        $tingkat = ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'];
 
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $this->head($pdf);
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 8, 'Surat Keterangan Prestasi', 0, 1, 'C');
        $pdf->Cell(185, 15, '', 0, 1, 'C');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(185, 8, 'Dengan Ini Menyatakan Bahwa :' , 0, 1, 'L');
        $pdf->Cell(50, 8, 'Nama' , 0, 0, 'L');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(135, 8, ': '.$d->nama , 0, 1, 'L');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, 'Team' , 0, 0, 'L');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(135, 8, ': '.$d->tim , 0, 1, 'L');

        $pdf->Cell(135, 10, '' , 0, 1, 'L');
        $pdf->SetFont('', '', 12);
        $pdf->Cell(185, 8, 'telah berhasil meraih :' , 0, 1, 'L');

        $pdf->Cell(50, 8, 'Prestasi' , 0, 0, 'L');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(135, 8, ': '.$d->prestasi , 0, 1, 'L');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, 'Tanggal' , 0, 0, 'L');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(135, 8, ': '.date($d->tanggal) , 0, 1, 'L');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, 'Tingkat' , 0, 0, 'L');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(135, 8, ': '.$tingkat[$d->tingkat] , 0, 1, 'L');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(135, 10, '' , 0, 1, 'L');
        $pdf->Cell(185, 8, 'Berikut Surat Keterangan Ini Dibuat untuk digunakan sebagaimana mestinya' , 0, 1, 'L');
        $this->ttd($pdf);
        
        $pdf->SetAutoPageBreak(true, 0);

        // set JPEG quality
        

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Data Atlet - '.$tanggal.'.pdf'); 
    }

    public function bonus() {
        
        $data = $this->m_app->getBonus($_GET['role']);
 
        $pdf = new \TCPDF();
        $pdf->AddPage();

        $this->head($pdf);

        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 0, "Laporan Bonus", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tanggal", 1, 0, 'C');
        $pdf->Cell(35, 8, "Penerima", 1, 0, 'C');
        $pdf->Cell(35, 8, "Nominal", 1, 0, 'C');
        $pdf->Cell(75, 8, "Bonus", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addBonus($pdf, $x+1, $d);
        }
        
        $this->ttd($pdf);
        $pdf->Output('Laporan Data Prestasi.pdf'); 
    }

    public function alat() {
        
        $data = $this->m_app->getAlat();
 
        $pdf = new \TCPDF();
        $pdf->AddPage();

        $this->head($pdf);

        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 0, "Laporan Alat", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(75, 8, "Nama", 1, 0, 'C');
        $pdf->Cell(35, 8, "Pemilik", 1, 0, 'C');
        $pdf->Cell(35, 8, "Jenis", 1, 0, 'C');
        $pdf->Cell(35, 8, "Kondisi", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addAlat($pdf, $x+1, $d);
        }
        
        $this->ttd($pdf);
        $pdf->Output('Laporan Data Alat.pdf'); 
    }

    public function penilaian() {
        $data = $this->m_app->getPenilaian();
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('l');
        $this->headl($pdf);
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(300, 0, "Laporan Data Penilaian Atlet ", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nama", 1, 0, 'C');
        $pdf->Cell(20, 8, "Stance", 1, 0, 'C');
        $pdf->Cell(20, 8, "Nocking", 1, 0, 'C');
        $pdf->Cell(20, 8, "Set Up", 1, 0, 'C');
        $pdf->Cell(20, 8, "Drawing", 1, 0, 'C');
        $pdf->Cell(20, 8, "Anchoring", 1, 0, 'C');
        $pdf->Cell(20, 8, "Holding", 1, 0, 'C');
        $pdf->Cell(20, 8, "Aiming", 1, 0, 'C');
        $pdf->Cell(20, 8, "Release", 1, 0, 'C');
        $pdf->Cell(20, 8, "Follow Thr.", 1, 0, 'C');
        $pdf->Cell(35, 8, "Nilai", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addPenilaian($pdf, $x+1, $d);
        }
        $tanggal = date('d-m-Y');
        $this->ttdl($pdf);
        $pdf->Output('Laporan Data Penilaian Atlet.pdf'); 
    }

    public function nilai($user_id) {
        $data = $this->m_app->getPenilaian($user_id)->row();
        if ($data->total > 0) {
            $av = $data->total / 9;
        } else {
            $av = 0;
        }

        $pdf = new \TCPDF();
        $pdf->AddPage();
        $this->head($pdf);
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(180, 0, "Laporan Data Penilaian Atlet ", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(50, 8, "Nama", 0, 0, 'L');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, ": ".$data->nama, 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(60, 8, "Stance", 0, 0, 'C');
        $pdf->Cell(60, 8, "Nocking", 0, 0, 'C');
        $pdf->Cell(60, 8, "Set Up", 0, 1, 'C');

        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(60, 8, $data->n1, 1, 0, 'C');
        $pdf->Cell(60, 8, $data->n2, 1, 0, 'C');
        $pdf->Cell(60, 8, $data->n3, 1, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('', '', 12);
        $pdf->Cell(60, 8, "Drawing", 0, 0, 'C');
        $pdf->Cell(60, 8, "Anchoring", 0, 0, 'C');
        $pdf->Cell(60, 8, "Holding", 0, 1, 'C');

        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(60, 8, $data->n4, 1, 0, 'C');
        $pdf->Cell(60, 8, $data->n5, 1, 0, 'C');
        $pdf->Cell(60, 8, $data->n6, 1, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('', '', 12);
        $pdf->Cell(60, 8, "Aiming", 0, 0, 'C');
        $pdf->Cell(60, 8, "Release", 0, 0, 'C');
        $pdf->Cell(60, 8, "Follow Through", 0, 1, 'C');

        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(60, 8, $data->n7, 1, 0, 'C');
        $pdf->Cell(60, 8, $data->n8, 1, 0, 'C');
        $pdf->Cell(60, 8, $data->n9, 1, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('', '', 12);
        $pdf->Cell(90, 8, "Nilai", 1, 0, 'C');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(90, 8, $data->total, 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        $pdf->Cell(90, 8, "Rata-rata", 1, 0, 'C');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(90, 8, $av, 1, 1, 'C');
        $pdf->SetFont('', '', 12);

        $tanggal = date('d-m-Y');
        $this->ttd($pdf);
        $pdf->Output('Laporan Data Penilaian Atlet.pdf'); 
    }

    private function head($pdf) {
        $pdf->Image(base_url('assets/kop.jpeg'), 0, 0, 200, 0, '', 'http://www.tcpdf.org', 'C', true, 300, '', false, false, 0, true, false, false);
        $pdf->Cell(185, 30, "", 0, 1, 'C');
    }

    private function headl($pdf) {
        $pdf->Image(base_url('assets/kop.jpeg'), 0, 0, 250, 0, '', 'http://www.tcpdf.org', 'C', true, 300, '', false, false, 0, true, false, false);
        $pdf->Cell(300, 50, "", 0, 1, 'C');
    }

    private function ttd($pdf){
        $pdf->Cell(135, 10, '' , 0, 1, 'L');
        $pdf->Cell(100, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Banjarmasin, '. date('d-m-Y') , 0, 1, 'C');
        $pdf->Cell(100, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Mengetahui ' , 0, 1, 'C');
        $pdf->Cell(135, 15, '' , 0, 1, 'L');
        $pdf->Cell(100, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Ir. H. Supian ST. MT' , 0, 1, 'C');
        $pdf->Cell(100, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Ketua Umum' , 0, 1, 'C');
    }

    private function ttdl($pdf){
        $pdf->Cell(135, 10, '' , 0, 1, 'L');
        $pdf->Cell(200, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Banjarmasin, '. date('d-m-Y') , 0, 1, 'C');
        $pdf->Cell(200, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Mengetahui ' , 0, 1, 'C');
        $pdf->Cell(135, 15, '' , 0, 1, 'L');
        $pdf->Cell(200, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Ir. H. Supian ST. MT' , 0, 1, 'C');
        $pdf->Cell(200, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Ketua Umum' , 0, 1, 'C');
    }

 
    private function addUser($pdf, $no, $d) {
        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(50, 8, $d['nama'], 1, 0, '');
        $pdf->Cell(55, 8, $d['tim'], 1, 0, 'C');
        $pdf->Cell(50, 8, $d['email'], 1, 0, 'C');
        $pdf->Cell(30, 8, $d['telepon'], 1, 0, 'C');
        $pdf->Cell(50, 8, $d['alamat'], 1, 0, 'C');
        $pdf->Cell(35, 8, ($d['status'] == 1) ? 'Aktif' : 'Non-Aktif', 1, 1, 'L');
    }

    private function addPrestasi($pdf, $no, $d) {
        $tingkat = ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'];

        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(55, 8, $d['prestasi'], 1, 0, '');
        $pdf->Cell(35, 8, $d['nama'], 1, 0, 'C');
        $pdf->Cell(50, 8, $tingkat[$d['tingkat']], 1, 0, 'C');
        $pdf->Cell(35, 8, date($d['tanggal']), 1, 1, 'L');
    }

    private function addPertandingan($pdf, $no, $d) {
        $tingkat = ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'];

        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(55, 8, $d['tempat'], 1, 0, '');
        $pdf->Cell(35, 8, $d['nama'], 1, 0, 'C');
        $pdf->Cell(50, 8, $tingkat[$d['tingkat']], 1, 0, 'C');
        $pdf->Cell(35, 8, date($d['tanggal']), 1, 1, 'L');
    }

    private function addBonus($pdf, $no, $d) {
        $tingkat = ['Kecamatan', 'Kabupaten / Kota', 'Provinsi', 'Nasional'];

        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(35, 8, date($d['tanggal']), 1, 0, '');
        $pdf->Cell(35, 8, $d['nama'], 1, 0, 'C');
        $pdf->Cell(35, 8, $d['jumlah'], 1, 0, 'C');
        $pdf->Cell(75, 8, $d['bonus'], 1, 1, 'L');
    }

    private function addAlat($pdf, $no, $d) {
        $kondisi =  ['', 'Baik', 'Rusak', 'Hilang'];
        $jenis   =  ['', 'Busur', 'Anak Panah', 'Target'];

        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(75, 8, $d['alat'], 1, 0, '');
        $pdf->Cell(35, 8, $d['nama'], 1, 0, 'C');
        $pdf->Cell(35, 8, $jenis[$d['jenis']], 1, 0, 'C');
        $pdf->Cell(35, 8, $kondisi[$d['kondisi']], 1, 1, 'L');
    }

    private function addPenilaian($pdf, $no, $d) {
        if ($d->total > 0) {
            $av = $d->total / 9;
        } else {
            $av = 0;
        }

        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(50, 8, $d['nama'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n1'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n2'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n3'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n4'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n5'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n6'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n7'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n8'], 1, 0, 'C');
        $pdf->Cell(20, 8, $d['n9'], 1, 0, 'C');
        $pdf->Cell(35, 8, $av, 1, 1, 'L');
    }

}