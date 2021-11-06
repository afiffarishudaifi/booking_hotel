<?php

namespace App\Controllers;
use App\Models\Model_pengguna;

class Register extends BaseController
{
    public function index()
    {
        return view('vRegistrasi');
    }

    public function registrasi()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $avatar      = $this->request->getFile('input_file');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);
        } else {
            $namabaru = 'noimage.jpg';
        }

        $data = array(
            'username' => $this->request->getPost('input_username'),
            'password' => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'email' => $this->request->getPost('input_email'),
            'nama_lengkap' => $this->request->getPost('input_nama'),
            'no_hp' => $this->request->getPost('input_no_hp'),
            'alamat' => $this->request->getPost('input_alamat'),
            'status' => 'customer',
            'file' => "docs/img/img_pengguna/" . $namabaru
        );

        $model = new Model_pengguna();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Login'));
    }

    public function cek_username($username)
    {
        $model = new Model_pengguna();
        $cek_username = $model->cek_username($username)->getResultArray();
        $respon = json_decode(json_encode($cek_username), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function cek_email($email)
    {
        $model = new Model_pengguna();
        $cek_email = $model->cek_email($email)->getResultArray();
        $respon = json_decode(json_encode($cek_email), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }
}
