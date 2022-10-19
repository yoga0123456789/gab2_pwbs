<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// panggil file "Server.php"
require APPPATH."libraries/Server.php";
// require APPPATH."libraries/Server.php";

class Mahasiswa extends Server {

    // buat service "GET"
    function service_get()
    {
        // // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa", "mdl", TRUE);
        // panggil method "get_data"
        $hasil = $this->mdl->get_data();
        // hasil respon
        $this->response($hasil,200);

    }



    // buat service "POST"
    function service_post()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter data yang akan di isi
        $data = array(
            "npm" =>$this->post("npm"), //array $data[0]
            "nama" =>$this->post("nama"), //array $data[0]
            "telepon" =>$this->post("telepon"), //array $data[0]
            "jurusan" =>$this->post("jurusan"), //array $data[0]
            "token" => base64_encode($this->post("npm")),
        );
        // panggil method "save data"
        $hasil = $this->mdl->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" =>"Data Mahasiswa Berhasil Disimpan"),200);
        }
        // jika hasil !=0
        else
        {
            $this->response(array("status" => "Data Mahasiswa Gagal Disimpan"),200);
        }

    }

    // buat service "PUT"
    function service_put()
    {

    }

    // buat service "DELETE"
    function service_delete()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter token "npm"
        $token = $this->delete("npm");
        //    panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {

            $this->response(array("status" => "Data Mahasiswa Gagal Dihapus"),200);
        }
    }
}
