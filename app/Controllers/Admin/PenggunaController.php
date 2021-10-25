<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_pengguna;
use App\Models\Model_dashboard;

class PenggunaController extends BaseController
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
        // if (!$session->get('username_login') || $session->get('level_login') == 'User') {
        //     return redirect()->to('/booking_hotel/Admin/Login');
        // }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan();

        $model = new Model_pengguna();
        $pengguna = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Pengguna',
            'page_header' => 'Pengguna',
            'panel_title' => 'Tabel Pengguna',
            'pengguna' => $pengguna,
            'jml_pemesanan' => $jumlah_pemesanan
        ];
        return view('admin/vTPengguna', $data);
    }

    public function add_pengguna()
    {
        $session = session();
        // if (!$session->get('username_login') || $session->get('level_login') == 'User') {
        //     return redirect()->to('/booking_hotel/Admin/Login');
        // }
        $encrypter = \Config\Services::encrypter();

        $avatar      = $this->request->getFile('input_file');
        if ($avatar) {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);
        } else {
            $namabaru = 'noimage.jpg';
        }

        $data = array(
            'username' => $this->request->getPost('input_username'),
            'password' => base64_encode($encrypter->encrypt($this->request->getVar('input_password'))),
            'email' => $this->request->getPost('input_email'),
            'nama_lengkap' => $this->request->getPost('input_nama'),
            'no_hp' => $this->request->getPost('input_no_hp'),
            'alamat' => $this->request->getPost('input_alamat'),
            'status' => $this->request->getPost('input_status'),
            'file' => "docs/img/img_pengguna/" . $namabaru
        );
        $model = new Model_pengguna();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/PenggunaController'));
    }

    public function update_pengguna()
    {
        $session = session();
        // if (!$session->get('username_login') || $session->get('level_login') == 'User') {
        //     return redirect()->to('/booking_hotel/Admin/Login');
        // }
        $encrypter = \Config\Services::encrypter();

        $model = new Model_pengguna();
        $avatar      = $this->request->getFile('edit_file');
        if ($avatar) {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);
        } else {
            $namabaru = 'noimage.jpg';
        }
        
        $id = $this->request->getPost('id_pengguna');
        $data = array(
            'username' => $this->request->getPost('edit_username'),
            // 'password' => base64_encode($encrypter->encrypt($this->request->getVar('edit_password'))),
            'password' => $encrypter->encrypt(base64_encode($this->request->getVar('edit_password'))),
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
            if ($data_foto['file'] != 'noimage.jpg') {
                if (file_exists($data_foto['file'])) {
                    unlink($data_foto['file']);
                }
            }
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/PenggunaController'));
    }

    public function delete_pengguna()
    {
        $model = new Model_pengguna();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $data_foto = $model->detail_data($id)->getRowArray();

            if ($data_foto != null) {
                if ($data_foto['file'] != 'noimage.jpg') {
                    if (file_exists($data_foto['file'])) {
                        unlink($data_foto['file']);
                    }
                }
            }
            $model->delete_data($id);
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/Admin/PenggunaController');
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
        // $password = $encrypter->decrypt(base64_decode($data_password['password']));
        // $password = base64_decode($encrypter->decrypt($data_password['password']));
        // dd($password);
        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id'] = $value['id'];
            $isi['username'] = $value['username'];
            $isi['password'] = $value['password'];
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