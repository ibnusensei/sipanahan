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
        $pdf->Image(base_url($d->image), 70, 25, 75, 75, '', 'http://www.tcpdf.org', '', true, 100, '', false, false, 1, false, false, false);
        $pdf->Cell(185, 8, $d->nama, 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, "Email ", 1, 0, 'L');
        $pdf->Cell(135, 8, $d->email, 1, 1, '');
        $pdf->Cell(50, 8, "Tim ", 1, 0, 'L');
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
        $pdf->AddPage();
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 0, "Laporan Data Atlet - ".$tanggal, 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Nama", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tim", 1, 0, 'C');
        $pdf->Cell(50, 8, "Email", 1, 0, 'C');
        $pdf->Cell(35, 8, "Status", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addUser($pdf, $x+1, $d);
        }
        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Data Atlet - '.$tanggal.'.pdf'); 
    }

    public function pelatih() {
        $data = $this->m_app->getPelatih();
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 0, "Laporan Data Pelatih - ".$tanggal, 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Nama", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tim", 1, 0, 'C');
        $pdf->Cell(50, 8, "Email", 1, 0, 'C');
        $pdf->Cell(35, 8, "Status", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        foreach($data->result_array() as $x => $d) {
            $this->addUser($pdf, $x+1, $d);
        }
        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Data Pelatih - '.$tanggal.'.pdf'); 
    }

    public function prestasi($user_id = null) {
        $data = $this->m_app->getPrestasi(null, $user_id);
 
        $pdf = new \TCPDF();
        $pdf->AddPage();

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
            $pdf->Cell(50, 8, 'Tim' , 0, 0, 'L');
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
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(185, 8, 'Surat Keterangan Prestasi', 0, 1, 'C');
        $pdf->Cell(185, 15, '', 0, 1, 'C');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(185, 8, 'Dengan Ini Menyatakan Bahwa :' , 0, 1, 'L');
        $pdf->Cell(50, 8, 'Nama' , 0, 0, 'L');
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(135, 8, ': '.$d->nama , 0, 1, 'L');

        $pdf->SetFont('', '', 12);
        $pdf->Cell(50, 8, 'Tim' , 0, 0, 'L');
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

    private function ttd($pdf){
        $pdf->Cell(135, 10, '' , 0, 1, 'L');
        $pdf->Cell(100, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Banjarmasin, '. date('d-m-Y') , 0, 1, 'C');
        $pdf->Cell(135, 10, '' , 0, 1, 'L');
        $pdf->Cell(100, 8, '' , 0, 0, 'C');
        $pdf->Cell(85, 8, 'Tanda Tangan' , 0, 1, 'C');
    }

 
    private function addUser($pdf, $no, $d) {
        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(55, 8, $d['nama'], 1, 0, '');
        $pdf->Cell(35, 8, $d['tim'], 1, 0, 'C');
        $pdf->Cell(50, 8, $d['email'], 1, 0, 'C');
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

}