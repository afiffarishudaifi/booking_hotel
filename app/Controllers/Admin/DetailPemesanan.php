<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_detail_pemesanan;
use App\Models\model_kamar;
use App\Models\Model_dashboard;

class DetailPemesanan extends BaseController
{

    protected $Model_detail_pemesanan;
    public function __construct()
    {
        $this->Model_detail_pemesanan = new Model_detail_pemesanan();
        helper('form');
        $this->db = db_connect();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function viewData($id)
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_detail_pemesanan();
        $pemesanan = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Detail Pemesanan',
            'page_header' => 'Detail Pemesanan',
            'panel_title' => 'Tabel Detail Pemesanan',
            'pemesanan' => $pemesanan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan'],
            'id_pemesanan' => $id
        ];
        return view('admin/vTDetailPemesanan', $data);
    }

    public function add_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);

        $id_pemesanan = $this->request->getPost('id_pemesanan');
        $data = array(
            'id_pemesanan'     => $id_pemesanan,
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'tanggal_masuk'     => $this->request->getPost('input_masuk'),
            'tanggal_keluar'     => $this->request->getPost('input_keluar'),
            'total_biaya'     => $this->request->getPost('input_biaya')
        );
        $model = new Model_detail_pemesanan();
        $model->add_data($data);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'terisi');
        $id_kamar = $this->request->getPost('input_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/DetailPemesanan/viewData/' . $id_pemesanan));
    }

    public function update_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_detail_pemesanan();

        $kamar_baru = $this->request->getPost('edit_kamar');
        $kamar_lama = $this->request->getPost('edit_kamar_lama');
        
        $id_pemesanan = $this->request->getPost('id_pemesanan');
        $id = $this->request->getPost('id_detail');
        $data = array(
            'id_kamar'     => $this->request->getPost('edit_kamar'),
            'tanggal_masuk'     => $this->request->getPost('edit_masuk'),
            'tanggal_keluar'     => $this->request->getPost('edit_keluar'),
            'total_biaya'     => $this->request->getPost('edit_biaya')
        );

        if ($kamar_lama != $kamar_baru) {
            $model_kamar = new model_kamar();
            $data_kamar_lama = array('status_kamar' => 'kosong');
            $model_kamar->update_data($data_kamar_lama, $kamar_lama);

            $data_kamar_baru = array('status_kamar' => 'terisi');
            $model_kamar->update_data($data_kamar_baru, $kamar_baru);
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/DetailPemesanan//viewData/' . $id_pemesanan));
    }

    public function delete_pemesanan()
    {
        $model = new Model_detail_pemesanan();
        $id = $this->request->getPost('id');
        $id_pemesanan = $this->request->getPost('id_pemesanan');
        $session = session();
        $model->delete_data($id);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'kosong');
        $id_kamar = $this->request->getPost('id_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);

        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/DetailPemesanan//viewData/' . $id_pemesanan);
    }

    public function data_kamar()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("kamar");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_kamar, nama_kamar');
            $builder->like('nama_kamar', $query, 'both');
            $builder->where('status_kamar','Kosong');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kamar, nama_kamar');
            $builder->where('status_kamar','Kosong');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $kamar) {
            $poli[] = array(
                "id" => $kamar->id_kamar,
                "text" => $kamar->nama_kamar,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function data_edit($id_pemesanan)
    {
        $model = new Model_detail_pemesanan();
        $datapemesanan = $model->detail_data($id_pemesanan)->getResultArray();
        $respon = json_decode(json_encode($datapemesanan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pemesanan'] = $value['id_pemesanan'];
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['nama_kamar'] = $value['nama_kamar'];
            $isi['tanggal_masuk'] = $value['tanggal_masuk'];
            $isi['tanggal_keluar'] = $value['tanggal_keluar'];
            $isi['total_biaya'] = $value['total_biaya'];
        endforeach;
        echo json_encode($isi);
    }

    public function biaya_kamar($id)
    {
        $model = new Model_detail_pemesanan();
        $biaya_kamar = $model->biaya_kamar($id)->getRowArray();
        $result['biaya'] = $biaya_kamar['biaya'];
        echo json_encode($result);
    }
}
