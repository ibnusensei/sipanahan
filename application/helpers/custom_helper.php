<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Hasnur
 * Date: 18/02/2020
 * Time: 9:41
 */
	//-- check logged user
	if (!function_exists('check_login_user')) {
        function check_login_user() {
            $ci = get_instance();
            if ($ci->session->userdata('is_login') != TRUE) {
                $ci->session->set_flashdata('message', 'Login Terlebih Dahulu');
                redirect(site_url('auth'));
            }
        }
    }

    if (!function_exists('check_admin')) {
        function check_admin() {
            $ci = get_instance();
            $level = $ci->session->userdata('level');
            if ($level == 2 && $level == 3) {
                $ci->session->set_flashdata('message', 'Akses tidak dizinkan');
                redirect(site_url('auth'));
            }
        }
    }

    if (!function_exists('check_pelatih')) {
        function check_pelatih() {
            $ci = get_instance();
            $level = $ci->session->userdata('level');
            if ($level != '2') {
                $ci->session->set_flashdata('message', 'Akses tidak dizinkan');
                redirect(site_url('auth'));
            }
        }
    }

    if (!function_exists('check_atlet')) {
        function check_atlet() {
            $ci = get_instance();
            $level = $ci->session->userdata('level');
            if ($level != '3') {
                $ci->session->set_flashdata('message', 'Akses tidak dizinkan');
                redirect(site_url('auth'));
            }
        }
    }


	//-- current date time function
	if(!function_exists('current_datetime')){
        function current_datetime(){
            $dt = new DateTime('now', new DateTimezone('Asia/Makassar'));
            $date_time = $dt->format('Y-m-d H:i:s');
            return $date_time;
        }
    }

	//-- show current date & time with custom format
	if(!function_exists('my_date_show_time')){
        function my_date_show_time($date){
            if($date != ''){
                $date2 = date_create($date);
                $date_new = date_format($date2,"d M Y h:i A");
                return $date_new;
            }else{
                return '';
            }
        }
    }

	//-- show current date with custom format
	if(!function_exists('my_date_show')){
        function my_date_show($date){

            if($date != ''){
                $date2 = date_create($date);
                $date_new = date_format($date2,"d M Y");
                return $date_new;
            }else{
                return '';
            }
        }
    }
    if ( ! function_exists('rupiah'))
    {
        function rupiah($angka){
        
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        
        }
    }

    if ( ! function_exists('date_indo'))
    {
        function date_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.' '.$bulan.' '.$tahun;
        }
    }
      
    if ( ! function_exists('bulan'))
    {
        function bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Januari";
                    break;
                case 2:
                    return "Februari";
                    break;
                case 3:
                    return "Maret";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Juni";
                    break;
                case 7:
                    return "Juli";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }
    }
 
    //Format Shortdate
    if ( ! function_exists('shortdate_indo'))
    {
        function shortdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = short_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'/'.$bulan.'/'.$tahun;
        }
    }
      
    if ( ! function_exists('short_bulan'))
    {
        function short_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "01";
                    break;
                case 2:
                    return "02";
                    break;
                case 3:
                    return "03";
                    break;
                case 4:
                    return "04";
                    break;
                case 5:
                    return "05";
                    break;
                case 6:
                    return "06";
                    break;
                case 7:
                    return "07";
                    break;
                case 8:
                    return "08";
                    break;
                case 9:
                    return "09";
                    break;
                case 10:
                    return "10";
                    break;
                case 11:
                    return "11";
                    break;
                case 12:
                    return "12";
                    break;
            }
        }
    }
 
    //Format Medium date
    if ( ! function_exists('mediumdate_indo'))
    {
        function mediumdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = medium_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
    }
      
    if ( ! function_exists('medium_bulan'))
    {
        function medium_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Ags";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        }
    }

    //Format Medium date
    if ( ! function_exists('format_no_surat'))
    {
        function format_no_surat($no, $tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = romawi_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $no.'/'.'SP3/31/'.$bulan.'/'.$tahun;
        }
    }
      
    if ( ! function_exists('romawi_bulan'))
    {
        function romawi_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "I";
                    break;
                case 2:
                    return "II";
                    break;
                case 3:
                    return "III";
                    break;
                case 4:
                    return "IV";
                    break;
                case 5:
                    return "V";
                    break;
                case 6:
                    return "VI";
                    break;
                case 7:
                    return "VII";
                    break;
                case 8:
                    return "VIII";
                    break;
                case 9:
                    return "IX";
                    break;
                case 10:
                    return "X";
                    break;
                case 11:
                    return "XI";
                    break;
                case 12:
                    return "XII";
                    break;
            }
        }
    }
     
    //Long date indo Format
    if ( ! function_exists('longdate_indo'))
    {
        function longdate_indo($tanggal)
        {
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
      
            $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
            $nama_hari = "";
            if($nama=="Sunday") {$nama_hari="Minggu";}
            else if($nama=="Monday") {$nama_hari="Senin";}
            else if($nama=="Tuesday") {$nama_hari="Selasa";}
            else if($nama=="Wednesday") {$nama_hari="Rabu";}
            else if($nama=="Thursday") {$nama_hari="Kamis";}
            else if($nama=="Friday") {$nama_hari="Jumat";}
            else if($nama=="Saturday") {$nama_hari="Sabtu";}
            return $nama_hari.', '.$tgl.' '.$bulan.' '.$thn;
        }
    }

