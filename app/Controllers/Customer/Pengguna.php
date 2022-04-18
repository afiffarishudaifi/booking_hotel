<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Model_pengunjung;
use App\Models\Model_dashboard;

class Pengguna extends BaseController
{

    protected $Model_pengunjung;
    public function __construct()
    {
        $this->Model_pengunjung = new Model_pengunjung();
        helper(['form', 'url']);
    }

    public function update_pengguna()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'customer') {
            return redirect()->to('Login');
        }

        $session = session();
        $encrypter = \Config\Services::encrypter();

        $model = new Model_pengunjung();
        $avatar      = $this->request->getFile('edit_file');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);

            $id = $this->request->getPost('id_pengguna');
            $data = array(
                'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                'email' => $this->request->getPost('edit_email'),
	            'nik' => $this->request->getPost('edit_nik'),
                'nama_lengkap' => $this->request->getPost('edit_nama'),
                'no_hp' => $this->request->getPost('edit_no_hp'),
                'alamat' => $this->request->getPost('edit_alamat'),
                'file' => "docs/img/img_pengguna/" . $namabaru
            );

            $data_foto = $model->detail_data($id)->getRowArray();

            if ($data_foto != null) {
                if ($data_foto['file'] != 'docs/img/img_pengguna/noimage.jpg') {
                    if (file_exists($data_foto['file'])) {
                        unlink($data_foto['file']);
                    }
                }
            }
        } else {
            $id = $this->request->getPost('id_pengguna');
            $data = array(
                'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                'email' => $this->request->getPost('edit_email'),
	            'nik' => $this->request->getPost('edit_nik'),
                'nama_lengkap' => $this->request->getPost('edit_nama'),
                'no_hp' => $this->request->getPost('edit_no_hp'),
                'alamat' => $this->request->getPost('edit_alamat')
            );
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/PenggunaController'));
    }

    public function cek_email($email)
    {
        $model = new Model_pengunjung();
        $cek_email = $model->cek_email($email)->getResultArray();
        $respon = json_decode(json_encode($cek_email), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_pengguna)
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'customer') {
            return redirect()->to('Login');
        }
        
        $model = new Model_pengunjung();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_pengguna)->getResultArray();
        $data_password = $model->detail_data($id_pengguna)->getRowArray();
        $password = $encrypter->decrypt(base64_decode($data_password['password']));

        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pengguna'] = $value['id_pengguna'];
            $isi['password'] = $password;
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['nik'] = $value['nik'];
            $isi['email'] = $value['email'];
            $isi['no_hp'] = $value['no_hp'];
            $isi['alamat'] = $value['alamat'];
            $isi['file'] = $value['file'];
        endforeach;
        echo json_encode($isi);
    }
}