<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_Pemesanan;
use App\Models\Model_dashboard;

class PemesananController extends BaseController
{

    protected $Model_Pemesanan;
    public function __construct()
    {
        $this->Model_Pemesanan = new Model_Pemesanan();
        helper('form');
    }

    public function index()
    {
        $session = session();
        // if (!$session->get('username_login') || $session->get('level_login') == 'User') {
        //     return redirect()->to('/booking_hotel/Admin/Login');
        // }

        // $model_dash = new Model_dashboard();
        // $jumlah_pemesanan = $model_dash->jumlah_pemesanan();

        $model = new Model_Pemesanan();
        $pemesanan = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Pemesanan',
            'page_header' => 'Pemesanan',
            'panel_title' => 'Tabel Pemesanan',
            'pemesanan' => $pemesanan
            // 'jml_pemesanan' => $jumlah_pemesanan
        ];
        return view('admin/vTPemesanan', $data);
    }

    public function add_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);

        $data = array(
            'nama_fasilitas'     => $this->request->getPost('input_fasilitas')
        );
        $model = new Model_Pemesanan();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/FasilitasController'));
    }

    public function update_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_Pemesanan();
        
        $id = $this->request->getPost('id_fasilitas');
        $data = array(
            'nama_fasilitas'     => $this->request->getPost('edit_fasilitas'),
            'id'     => $this->request->getPost('id_fasilitas')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/FasilitasController'));
    }

    public function delete_pemesanan()
    {
        $model = new Model_Pemesanan();
        $id = $this->request->getPost('id');
        $session = session();
        $model->delete_data($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/FasilitasController');
    }

    public function data_edit($id_pemesanan)
    {
        $model = new Model_Pemesanan();
        $datapemesanan = $model->detail_data($id_pemesanan)->getResultArray();
        $respon = json_decode(json_encode($datapemesanan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id'] = $value['id'];
            $isi['nama_fasilitas'] = $value['nama_fasilitas'];
        endforeach;
        echo json_encode($isi);
    }
}