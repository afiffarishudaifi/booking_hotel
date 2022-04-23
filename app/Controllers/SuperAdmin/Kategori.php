<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\Model_kategori_kamar;
use App\Models\Model_dashboard;

class Kategori extends BaseController
{

    protected $Model_kategori_kamar;
    public function __construct()
    {
        $this->Model_kategori_kamar = new Model_kategori_kamar();
        helper('form');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'superadmin') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_kategori_kamar();
        $kategori = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Kategori Kamar',
            'page_header' => 'Kategori Kamar',
            'panel_title' => 'Tabel Kategori Kamar',
            'kategori' => $kategori,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('superadmin/vTKategori', $data);
    }

    public function add_kategori_kamar()
    {
        $session = session();
        helper(['form', 'url']);

        $data = array(
            'nama_kategori'     => $this->request->getPost('input_nama'),
            'deskripsi'     => $this->request->getPost('input_deskripsi')
        );
        $model = new Model_kategori_kamar();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('SuperAdmin/Kategori'));
    }

    public function update_kategori_kamar()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_kategori_kamar();
        
        $id = $this->request->getPost('id_kategori');

        $data = array(
            'nama_kategori'     => $this->request->getPost('edit_nama'),
            'deskripsi'     => $this->request->getPost('edit_deskripsi')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('SuperAdmin/Kategori'));
    }

    public function delete_kategori_kamar()
    {
        $model = new Model_kategori_kamar();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/SuperAdmin/Kategori');
    }

    public function data_edit($id_kategori)
    {
        $model = new Model_kategori_kamar();
        $datapengguna = $model->detail_data($id_kategori)->getResultArray();
        $respon = json_decode(json_encode($datapengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_kategori'] = $value['id_kategori'];
            $isi['nama_kategori'] = $value['nama_kategori'];
            $isi['deskripsi'] = $value['deskripsi'];
        endforeach;
        echo json_encode($isi);
    }

    public function cek_nama($nama)
    {
        $model = new Model_kategori_kamar();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }
}
