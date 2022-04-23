<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\Model_pengunjung;
use App\Models\Model_dashboard;

class Pengunjung extends BaseController
{

    protected $Model_pengunjung;
    public function __construct()
    {
        $this->Model_pengunjung = new Model_pengunjung();
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

        $model = new Model_pengunjung();
        $pengunjung = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Pengunjung',
            'page_header' => 'Pengunjung',
            'panel_title' => 'Tabel Pengunjung',
            'pengunjung' => $pengunjung,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('superadmin/vTPengunjung', $data);
    }

    public function add_pengguna()
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
            'nik' => $this->request->getPost('input_nik'),
            'password' => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'email' => $this->request->getPost('input_email'),
            'nama_lengkap' => $this->request->getPost('input_nama'),
            'no_hp' => $this->request->getPost('input_no_hp'),
            'alamat' => $this->request->getPost('input_alamat'),
            'file' => "docs/img/img_pengguna/" . $namabaru
        );

        $model = new Model_pengunjung();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('SuperAdmin/Pengunjung'));
    }

    public function update_pengguna()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $model = new Model_pengunjung();
        $avatar      = $this->request->getFile('edit_file');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_pengguna/', $namabaru);

            $id = $this->request->getPost('id_pengguna');
            $data = array(
                'nik' => $this->request->getPost('edit_nik'),
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
            $id = $this->request->getPost('id_pengguna');
            $data = array(
                'nik' => $this->request->getPost('edit_nik'),
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

    public function delete_pengguna()
    {
        $model = new Model_pengunjung();
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
        $model = new Model_pengunjung();
        $cek_email = $model->cek_email($email)->getResultArray();
        $respon = json_decode(json_encode($cek_email), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_pengguna)
    {
        $model = new Model_pengunjung();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_pengguna)->getResultArray();
        $data_password = $model->detail_data($id_pengguna)->getRowArray();
        if($data_password['password'] != null) {
            $password = $encrypter->decrypt(base64_decode($data_password['password']));
        } else {
            $password = '';
        }

        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pengguna'] = $value['id_pengguna'];
            $isi['password'] = $password;
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['email'] = $value['email'];
            $isi['no_hp'] = $value['no_hp'];
            $isi['alamat'] = $value['alamat'];
            $isi['nik'] = $value['nik'];
            $isi['file'] = $value['file'];
        endforeach;
        echo json_encode($isi);
    }
}
