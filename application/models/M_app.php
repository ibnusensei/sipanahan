<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_app extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function checkUser($var, $id = null) {
        if ($id != null) {
            $this->db->where_not_in('id', $id);
        }
    	$this->db->where('username', $var);
    	return $this->db->from('users')->count_all_results();
    }

    function dataUser($var) {
        $this->db->select('users.*, tim.id AS tim_id, tim.tim');
    	$this->db->where('users.id', $var);
        $this->db->join('tim', 'tim.id = users.tim_id');
    	return $this->db->get('users')->row();
    }

    function getUserWithKey($var) {
    	$this->db->where('reset_password', $var);
    	return $this->db->get('users')->row();
    }

    function getUser($var) {
    	$this->db->where('email', $var);
        $this->db->where('status', 1);
    	return $this->db->get('users')->row();
    }

    public function update_reset_key($email, $reset_key)
    {
        $this->db->where('email', $email);
        $data = array('reset_password' => $reset_key);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getPengguna($var = null) {
        $this->db->select('users.*, tim.id AS tim_id, tim.tim');
        $this->db->from('users');
        if ($var != null) {
            $this->db->where('users.id', $var);
        }
        $this->db->join('tim', 'tim.id = users.tim_id');
        $this->db->order_by('id', 'DESC');
    	return $this->db->get();
    }

    // Anggota 
    function getAnggota($var = null, $tim = null) {
        $this->db->select('users.*, tim.id AS tim_id, tim.tim');
        $this->db->from('users');
        if ($var != null) {
            $this->db->where('users.id', $var);
        }

        if ($tim != null) {
            $this->db->where('users.tim_id', $tim);
        }

        if (!empty($_GET['search'])) {
            $this->db->like('users.nama', $_GET['search']);
            $this->db->or_like('users.email', $_GET['search']);
        }
        $this->db->join('tim', 'tim.id = users.tim_id');
        $this->db->where('level', 3);
        $this->db->order_by('id', 'DESC');
    	return $this->db->get();
    }

    // Pelatih 
    function getPelatih($var = null) {
        $this->db->select('users.*, tim.id AS tim_id, tim.tim');
        $this->db->from('users');
        if ($var != null) {
            $this->db->where('users.id', $var);
        }
        if (!empty($_GET['search'])) {
            $this->db->like('users.nama', $_GET['search']);
            $this->db->or_like('users.email', $_GET['search']);
        }
        $this->db->join('tim', 'tim.id = users.tim_id');
        $this->db->where('level', 2);
        $this->db->order_by('id', 'DESC');
    	return $this->db->get();
    }

    // Team
    function getTeam($var = null) {
        if ($var != null) {
            $this->db->where('id', $var);
        }

        if (!empty($_GET['search'])) {
            $this->db->like('tim', $_GET['search']);
        }

        $this->db->order_by('id', 'DESC');
    	return $this->db->get('tim');
    }

    function getPrestasiTim($var = null) {
        $this->db->select('prestasi.*, users.id AS user_id, tim.id AS tim_id, ');

        $this->db->join('users', 'users.id = prestasi.user_id');
        $this->db->join('tim', 'tim.id = users.tim_id');
        
        if ($var != null) {
            $this->db->where('tim_id', $var);
        }

        $this->db->select("count(*) as total");

        $this->db->order_by('id', 'DESC');
    	return $this->db->get('prestasi');
    }

    // Alat 
    function getAlat($var = null) {
        $this->db->select('alat.*, users.id AS user_id, users.nama, tim.tim');
        $this->db->from('alat');
        if ($var != null) {
            $this->db->where('alat.id', $var);
        }

        if (!empty($_GET['search'])) {
            $this->db->like('alat', $_GET['search']);
            $this->db->or_like('users.nama', $_GET['search']);
        }

        if (!empty($_GET['kondisi'])) {
            $this->db->where('kondisi', $_GET['kondisi']);
        }

        if (!empty($_GET['jenis'])) {
            $this->db->where('jenis', $_GET['jenis']);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->join('users', 'users.id = alat.user_id');
        $this->db->join('tim', 'tim.id = users.tim_id');
    	return $this->db->get();
    }

    // Alat 
    function getLatihan($var = null, $user_id = null, $date = null) {
        $this->db->select('latihan.*, users.id AS user_id, users.nama');
        $this->db->from('latihan');
        if ($var != null) {
            $this->db->where('latihan.id', $var);
        }

        if ($user_id != null) {
            $this->db->where('latihan.user_id', $user_id);
        } 

        if (!empty($_GET['a']) && !empty($_GET['b'])) {
            $this->db->where('latihan.tanggal >=', $_GET['a']);
            $this->db->where('latihan.tanggal <=', $_GET['b']);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->join('users', 'users.id = latihan.user_id');
    	return $this->db->get();
    }

    function getKehadiran($var = null, $user_id = null) {
        $this->db->select('kehadiran.*, users.id AS user_id, users.nama, latihan.id AS latihan_id, latihan.tempat');
        $this->db->from('kehadiran');
        if ($var != null) {
            $this->db->where('kehadiran.latihan_id', $var);
        }

        if ($user_id != null) {
            $this->db->where('kehadiran.user_id', $user_id);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->join('users', 'users.id = kehadiran.user_id');
        $this->db->join('latihan', 'latihan.id = kehadiran.latihan_id');
    	return $this->db->get();
    }

    // Pertandingan 
    function getPertandingan($var = null) {
        $this->db->select('pertandingan.*, users.id AS user_id, users.nama');
        $this->db->from('pertandingan');
        if ($var != null) {
            $this->db->where('pertandingan.id', $var);
        }

        if (!empty($_GET['a']) && !empty($_GET['b'])) {
            $this->db->where('pertandingan.tanggal >=', $_GET['a']);
            $this->db->where('pertandingan.tanggal <=', $_GET['b']);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->join('users', 'users.id = pertandingan.user_id');
    	return $this->db->get();
    }

    // Pertandingan 
    function getPrestasi($var = null, $user_id = null, $tim = null) {
        $this->db->select('prestasi.*, users.id AS user_id, users.nama, tim.tim');
        $this->db->from('prestasi');
        if ($var != null) {
            $this->db->where('prestasi.id', $var);
        }
        if ($user_id != null) {
            $this->db->where('prestasi.user_id', $user_id);
        }

        if ($tim != null) {
            $this->db->where('users.tim_id', $tim);
        }

        if (!empty($_GET['a']) && !empty($_GET['b'])) {
            $this->db->where('prestasi.tanggal >=', $_GET['a']);
            $this->db->where('prestasi.tanggal <=', $_GET['b']);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->join('users', 'users.id = prestasi.user_id');

        if (!empty($_GET['search'])) {
            $this->db->like('users.nama', $_GET['search']);
        }

        $this->db->join('tim', 'tim.id = users.tim_id');
    	return $this->db->get();
    }

    public function getLapangan() {
        $this->db->select('lapangan.*, users.id AS user_id, users.nama');
        $this->db->join('users', 'users.id = lapangan.user_id');
        $this->db->from('lapangan');
        return $this->db->get();
    }

    // Bonus 
    function getBonus($role = null, $var = null, $user_id = null) {
        $this->db->select('bonus.*, users.id AS user_id, users.nama, users.level, tim.id AS tim_id, tim.tim' );
        $this->db->from('bonus');
        if ($var != null) {
            $this->db->where('bonus.id', $var);
        }
        if ($user_id != null) {
            $this->db->where('bonus.user_id', $user_id);
        }

        if (!empty($_GET['a']) && !empty($_GET['b'])) {
            $this->db->where('bonus.tanggal >=', $_GET['a']);
            $this->db->where('bonus.tanggal <=', $_GET['b']);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->join('users', 'users.id = bonus.user_id');
        $this->db->join('tim', 'tim.id = users.tim_id');
        if ($role != null) {
            $this->db->where('users.level', $role);
        }
    	return $this->db->get();
    }



    // CRUD
    //  Untuk menambahkan data
    public function store($table, $data)
    {
        $result = $this->db->insert($table, $data); 
        return $result;
    }


//  Untuk mengubah data
    public function update($table, $data, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update($table, $data); 
        return $result;
    } 

//  Untuk menghapus data
    public function destroy($table, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete($table); 
        return $result;
    }
    // CRUD




    //  Untuk UPLOAD IMAGE
    public function uploadImage($file, $path) {
        $this->load->library('upload'); 

        $name = preg_replace('/[^A-Za-z0-9.]/', "", $file);

        $config['upload_path']   = './assets/img/'. $path;
        $config['allowed_types'] = 'jpg|png|jpeg|gif|svg';
        $config['file_name']     = time() . $name;

        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $name = 'assets/img/' . $path . '/' . $config['file_name'];
            return $name;
        } else {
            // Jika gagal :
            return 'error';
        }
    }

    function getUserPerTim()
    {
        $this->db->where('level', 3);
        $this->db->group_by('tim_id');
        $this->db->select('tim');
        $this->db->join('tim', 'tim.id = users.tim_id' );
        $this->db->select("count(*) as total");
        return $this->db->from('users')
          ->get()
          ->result();
    }

    function getPrestasiPerTahun()
    {
        $this->db->order_by('tanggal','desc');
        // $this->db->group_by('MONTH(tanggal), YEAR(tanggal)');
        $this->db->group_by('YEAR(tanggal)');
        $this->db->select('tanggal');
        $this->db->select("count(*) as total");
        return $this->db->from('prestasi')
          ->get()
          ->result();
    }

    function getPenilaian($user_id = null) {
        $this->db->select('(Select (n1+n2+n3+n4+n5+n6+n7+n8+n9)) AS total', FALSE);
        $this->db->select('penilaian.*, users.id AS user_id, users.nama');
        $this->db->from('penilaian');
        if ($user_id != null) {
            $this->db->where('penilaian.user_id', $user_id);
        }
        $this->db->order_by('total', 'DESC');
        $this->db->join('users', 'users.id = penilaian.user_id');
    	return $this->db->get();
    }

    function qrcode($id) {
        $this->load->library('ciqrcode');
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/img/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $qrcode= $id.'.png'; //buat name dari qr code sesuai dengan nim
 
        $user = $this->dataUser($id);
        $level =  ['', 'Admin', 'Pelatih', 'Atlet'];
        $text = 'Nama '.$level[$user->level].' : '.$user->nama.', Tim : '.$user->tim;
        $params['data'] = $text; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$qrcode; //simpan image QR CODE ke folder assets/images/
        return $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }

    function kirimNotifikasi($phone,$msg)
    {
            $link  =  "https://tx.wablas.com/api/send-message";
            $data = [
            'phone' => $phone,
            'message' => $msg,
            ];
            
            
            $curl = curl_init();
            $token =  "beJoWcnPwXygKxALNZbuHuozGPL9BJ1hTrwOuzFafL0zKxtVnxJlvFTvk1I7XU0N";
    
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                )
            );
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            curl_close($curl); 
            return $result;
    }

}