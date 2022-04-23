<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\Model_admin;
use App\Models\Model_dashboard;

class Admin extends BaseController
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
        if (!$session->get('username_login') || $session->get('status_login') != 'superadmin') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_admin();
        $admin = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Admin',
            'page_header' => 'Admin',
            'panel_title' => 'Tabel Admin',
            'admin' => $admin,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('superadmin/vTAdmin', $data);
    }

    public function add_admin()
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
            'password' => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'email' => $this->request->getPost('input_email'),
            'nama_lengkap' => $this->request->getPost('input_nama'),
            'no_hp' => $this->request->getPost('input_no_hp'),
            'alamat' => $this->request->getPost('input_alamat'),
            'file' => "docs/img/img_pengguna/" . $namabaru
        );

        $model = new Model_admin();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('SuperAdmin/Pengunjung'));
    }

    public function update_admin()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $model = new Model_admin();
        $avatar      = $this->request->getFile('edit_file');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);

            $id = $this->request->getPost('id_admin');
            $data = array(
                'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                'email' => $this->request->getPost('edit_email'),
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
            $id = $this->request->getPost('id_admin');
            $data = array(
                'password' => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                'email' => $this->request->getPost('edit_email'),
                'nama_lengkap' => $this->request->getPost('edit_nama'),
                'no_hp' => $this->request->getPost('edit_no_hp'),
                'alamat' => $this->request->getPost('edit_alamat')
            );
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('SuperAdmin/Pengunjung'));
    }

    public function delete_admin()
    {
        $model = new Model_admin();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $data_foto = $model->detail_data($id)->getRowArray();

            if ($data_foto != null) {
                if ($data_foto['file'] != 'docs/img/img_pengguna/noimage.jpg') {
                    if (file_exists($data_foto['file'])) {
                        unlink($data_foto['file']);
                    }
                }
            }
            $model->delete_data($id);
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/SuperAdmin/Pengunjung');
    }

    public function cek_email($email)
    {
        $model = new Model_admin();
        $cek_email = $model->cek_email($email)->getResultArray();
        $respon = json_decode(json_encode($cek_email), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_admin)
    {
        $model = new Model_admin();
        $encrypter = \Config\Services::encrypter();

        $data_admin = $model->detail_data($id_admin)->getResultArray();
        $data_password = $model->detail_data($id_admin)->getRowArray();
        if($data_password['password'] != null) {
            $password = $encrypter->decrypt(base64_decode($data_password['password']));
        } else {
            $password = '';
        }

        $respon = json_decode(json_encode($data_admin), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_admin'] = $value['id_admin'];
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
