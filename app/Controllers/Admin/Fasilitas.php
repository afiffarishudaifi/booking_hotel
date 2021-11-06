<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_fasilitas;
use App\Models\Model_dashboard;

class Fasilitas extends BaseController
{

    protected $Model_fasilitas;
    public function __construct()
    {
        $this->Model_fasilitas = new Model_fasilitas();
        helper('form');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_fasilitas();
        $fasilitas = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Fasilitas',
            'page_header' => 'Fasilitas',
            'panel_title' => 'Tabel Fasilitas',
            'fasilitas' => $fasilitas,
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        return view('admin/vTFasilitas', $data);
    }

    public function add_fasilitas()
    {
        $session = session();
        helper(['form', 'url']);

        $data = array(
            'nama_fasilitas'     => $this->request->getPost('input_fasilitas')
        );
        $model = new Model_fasilitas();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Fasilitas'));
    }

    public function update_fasilitas()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_fasilitas();
        
        $id = $this->request->getPost('id_fasilitas');
        $data = array(
            'nama_fasilitas'     => $this->request->getPost('edit_fasilitas'),
            'id'     => $this->request->getPost('id_fasilitas')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Fasilitas'));
    }

    public function delete_fasilitas()
    {
        $model = new Model_fasilitas();
        $id = $this->request->getPost('id');
        $session = session();
        $model->delete_data($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/Fasilitas');
    }

    public function data_edit($id_fasilitas)
    {
        $model = new Model_fasilitas();
        $datafasilitas = $model->detail_data($id_fasilitas)->getResultArray();
        $respon = json_decode(json_encode($datafasilitas), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id'] = $value['id'];
            $isi['nama_fasilitas'] = $value['nama_fasilitas'];
        endforeach;
        echo json_encode($isi);
    }

    public function cek_nama($nama)
    {
        $model = new Model_fasilitas();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }
}