<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_app extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getUser($var) {
    	$this->db->where('username', $var);
        $this->db->where('status', 1);
    	return $this->db->get('users')->row();
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
    function getAnggota($var = null) {
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

    // Alat 
    function getAlat($var = null) {
        $this->db->select('alat.*, users.id AS user_id, users.nama');
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
    function getPrestasi($var = null, $user_id = null) {
        $this->db->select('prestasi.*, users.id AS user_id, users.nama, tim.tim');
        $this->db->from('prestasi');
        if ($var != null) {
            $this->db->where('prestasi.id', $var);
        }
        if ($user_id != null) {
            $this->db->where('prestasi.user_id', $user_id);
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
        $this->db->select('bonus.*, users.id AS user_id, users.nama, users.level' );
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

}