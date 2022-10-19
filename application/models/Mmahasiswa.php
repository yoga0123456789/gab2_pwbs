<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmahasiswa extends CI_Model {

    // buat fungsi "get_data"
    function get_data()
    {
        $this->db->select("id AS id_mhs, npm AS npm_mhs, nama AS nama_mhs, jurusan AS jurusan_mhs");
        $this->db->from("tb_mahasiswa");
        $this->db->order_by("npm","ASC");
        $query = $this->db->get()->result();

        return $query;
    }
    // buat fungsi untuk delete data
    function delete_data($token)
    {
        // cek apakah npm ada atau tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();
        // jika npm ditemukan
        if(count($query) ==1)
        {
            // hapus data mahasiswa
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika npm tidak di temukan
        else
        {
            // kirim nilai hasil =0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controler" Mahasiswa
        return $hasil;
    }

    // buat fungsi untuk save data
    function save_data($npm, $nama, $telepon, $jurusan, $token)
    {
         // cek apakah npm ada atau tidak
         $this->db->select("npm");
         $this->db->from("tb_mahasiswa");
         $this->db->where("TO_BASE64(npm) = '$token'");
        //  $this->db->where("npm = '$npm'");
         // eksekusi query
         $query = $this->db->get()->result();
         // jika npm ditemukan
         if(count($query) == 0)
         {
            // isi nilai untuk masing" filed
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
            );

            // simmoan data
            $this->db->insert("tb_mahasiswa", $data);
            $hasil = 0;
            
         }
        //  jika npm ditemukan 
         else
         {
            $hasil = 1;

         }
         return $hasil;

    }
}
