<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_detail_Kamar;
use App\Models\Model_dashboard;

class DetailKamar extends BaseController
{

    protected $Model_detail_Kamar;
    public function __construct()
    {
        $this->Model_detail_Kamar = new Model_detail_Kamar();
        helper(['form', 'url']);
    }

    public function view($id)
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_detail_Kamar();
        $detail_kamar = $model->view_data($id)->getResultArray();
        $nama_kamar = $model->view_data($id)->getRowArray();
        $data = [
            'judul' => 'Detail Kamar',
            'page_header' => 'Detail Kamar',
            'panel_title' => 'Tabel Detail Kamar',
            'detail_kamar' => $detail_kamar,
            'id_kamar' => $id,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('admin/vTDetailKamar', $data);
    }

    public function add_detail_kamar()
    {
        $session = session();

        $id_kamar = $this->request->getPost('id_kamar');

        $data = array(
            'id_fasilitas'     => $this->request->getPost('input_fasilitas'),
            'id_kamar'     => $id_kamar
        );
        $model = new Model_detail_Kamar();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/DetailKamar/view/' . $id_kamar));
    }

    public function update_detail_kamar()
    {
        $session = session();
        $model = new Model_detail_Kamar();
        
        $id = $this->request->getPost('id_detail');
        $id_kamar = $this->request->getPost('id_kamar');
        $data = array(
            'id_fasilitas'     => $this->request->getPost('edit_fasilitas'),
            'id_kamar'     => $id_kamar
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/DetailKamar/view/' . $id_kamar));
    }

    public function delete_detail_kamar()
    {
        $model = new Model_detail_Kamar();
        $id = $this->request->getPost('id');
        $id_kamar = $this->request->getPost('id_kamar');
        $session = session();
        $model->delete_data($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to(base_url('Admin/DetailKamar/view/' . $id_kamar));
    }

    public function data_edit($id_detail)
    {
        $model = new Model_detail_Kamar();
        $data_detail = $model->detail_data($id_detail)->getResultArray();
        $respon = json_decode(json_encode($data_detail), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_detail'] = $value['id_detail'];
            $isi['id_fasilitas'] = $value['id_fasilitas'];
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['id_fasilitas'] = $value['id_fasilitas'];
            $isi['nama_fasilitas'] = $value['nama_fasilitas'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_fasilitas()
    {
        $model = new Model_detail_Kamar();
        $data_fasilitas = $model->data_fasilitas()->getResultArray();
        $respon = json_decode(json_encode($data_fasilitas), true);
        $data['results'] = array();

        foreach ($respon as $value) {
            $isi['id'] = $value['id_fasilitas'];
            $isi['text'] = $value['nama_fasilitas'];
            array_push($data['results'], $isi);
        }
        echo json_encode($data);
    }
}
