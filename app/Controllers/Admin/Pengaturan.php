<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_admin;
use App\Models\Model_dashboard;

class Pengaturan extends BaseController
{

    protected $Model_admin;
    public function __construct()
    {
        $this->Model_admin = new Model_admin();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
            return redirect()->to('Login/indexAdmin');
        }

        $id_pengguna = $session->get('user_id');
        $model = new Model_admin();
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
            'pengguna' => $data_pengguna[0],
            'password' => $password,
            'id_pengguna' => $id_pengguna,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('admin/vPengaturan', $data);
    }

    public function update_pengguna()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $model = new Model_admin();
        $avatar      = $this->request->getFile('edit_file');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);

            $id = $this->request->getPost('id_pengguna');
            $data = array(
                'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
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
                'nama_lengkap' => $this->request->getPost('edit_nama'),
                'no_hp' => $this->request->getPost('edit_no_hp'),
                'alamat' => $this->request->getPost('edit_alamat')
            );
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        $session->destroy();
        return redirect()->to(base_url('/Login/indexAdmin'));
    }

    public function cek_username($username)
    {
        $model = new Model_admin();
        $cek_username = $model->cek_username($username)->getResultArray();
        $respon = json_decode(json_encode($cek_username), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_pengguna)
    {
        $model = new Model_admin();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_pengguna)->getResultArray();
        $data_password = $model->detail_data($id_pengguna)->getRowArray();
        $password = $encrypter->decrypt(base64_decode($data_password['password']));

        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['password'] = $password;
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['email'] = $value['email'];
            $isi['no_hp'] = $value['no_hp'];
            $isi['alamat'] = $value['alamat'];
            $isi['file'] = $value['file'];
        endforeach;
        echo json_encode($isi);
    }
}
