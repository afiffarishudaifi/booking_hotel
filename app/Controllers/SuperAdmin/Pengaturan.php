<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\Model_pengguna;
use App\Models\Model_dashboard;

class Pengaturan extends BaseController
{

    protected $Model_pengguna;
    public function __construct()
    {
        $this->Model_pengguna = new Model_pengguna();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'superadmin') {
            return redirect()->to('Login/indexAdmin');
        }

        $id_pengguna = $session->get('user_id');
        $model = new Model_pengguna();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_pengguna)->getResultArray();
        $data_password = $model->detail_data($id_pengguna)->getRowArray();
        $password = $encrypter->decrypt(base64_decode($data_password['password']));

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $data = [
            'judul' => 'Pengguna',
            'page_header' => 'Pengguna',
            'panel_title' => 'Tabel Pengguna',
            'pengguna' => $data_pengguna,
            'password' => $password,
            'id_pengguna' => $id_pengguna,
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        return view('superadmin/vPengaturan', $data);
    }

    public function update_pengguna()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $model = new Model_pengguna();
        $avatar      = $this->request->getFile('edit_file');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);

            $id = $this->request->getPost('id_pengguna');
	        $data = array(
	            'username' => $this->request->getPost('edit_username'),
	            'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
	            'email' => $this->request->getPost('edit_email'),
	            'nama_lengkap' => $this->request->getPost('edit_nama'),
	            'no_hp' => $this->request->getPost('edit_no_hp'),
	            'alamat' => $this->request->getPost('edit_alamat'),
	            'status' => $this->request->getPost('edit_status'),
	            'file' => "docs/img/img_pengguna/" . $namabaru,
	            'id' => $this->request->getPost('id_pengguna')
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
	            'username' => $this->request->getPost('edit_username'),
	            'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
	            'email' => $this->request->getPost('edit_email'),
	            'nama_lengkap' => $this->request->getPost('edit_nama'),
	            'no_hp' => $this->request->getPost('edit_no_hp'),
	            'alamat' => $this->request->getPost('edit_alamat'),
	            'status' => $this->request->getPost('edit_status'),
	            'id' => $this->request->getPost('id_pengguna')
	        );
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        $session->destroy();
        return redirect()->to(base_url('/Login'));
    }

    public function cek_username($username)
    {
        $model = new Model_pengguna();
        $cek_username = $model->cek_username($username)->getResultArray();
        $respon = json_decode(json_encode($cek_username), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_pengguna)
    {
        $model = new Model_pengguna();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_pengguna)->getResultArray();
        $data_password = $model->detail_data($id_pengguna)->getRowArray();
        $password = $encrypter->decrypt(base64_decode($data_password['password']));

        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id'] = $value['id'];
            $isi['username'] = $value['username'];
            $isi['password'] = $password;
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['email'] = $value['email'];
            $isi['no_hp'] = $value['no_hp'];
            $isi['alamat'] = $value['alamat'];
            $isi['status'] = $value['status'];
            $isi['file'] = $value['file'];
        endforeach;
        echo json_encode($isi);
    }
}