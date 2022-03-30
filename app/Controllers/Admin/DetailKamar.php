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
        $this->db = db_connect();
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
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("fasilitas");

        $fasilitas = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_fasilitas, nama_fasilitas');
            $builder->like('nama_fasilitas', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_fasilitas, nama_fasilitas');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pengguna) {
            $fasilitas[] = array(
                "id" => $pengguna->id_fasilitas,
                "text" => $pengguna->nama_fasilitas,
            );
        }

        $response['data'] = $fasilitas;

        return $this->response->setJSON($response);
    }
}
