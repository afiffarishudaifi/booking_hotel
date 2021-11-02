<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_pemesanan;
use App\Models\model_kamar;
use App\Models\Model_dashboard;

class PemesananController extends BaseController
{

    protected $Model_pemesanan;
    public function __construct()
    {
        $this->Model_pemesanan = new Model_pemesanan();
        helper('form');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'Customer') {
            return redirect()->to('/Login');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_pemesanan();
        $pemesanan = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Pemesanan',
            'page_header' => 'Pemesanan',
            'panel_title' => 'Tabel Pemesanan',
            'pemesanan' => $pemesanan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        return view('admin/vTPemesanan', $data);
    }

    public function add_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);

        $data = array(
            'id_pengguna'     => $this->request->getPost('input_pengguna'),
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'tanggal_pesan'     => date('Y-m-d G:i:s'),
            'tanggal_masuk'     => $this->request->getPost('input_masuk'),
            'tanggal_keluar'     => $this->request->getPost('input_keluar'),
            'total_biaya'     => $this->request->getPost('input_hasil_total'),
            'status_pemesanan'     => $this->request->getPost('input_status')
        );
        $model = new Model_pemesanan();
        $model->add_data($data);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'terisi');
        $id_kamar = $this->request->getPost('input_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/PemesananController'));
    }

    public function update_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_pemesanan();

        $kamar_baru = $this->request->getPost('edit_kamar');
        $kamar_lama = $this->request->getPost('edit_kamar_lama');
        
        $id = $this->request->getPost('id_pemesanan');
        $data = array(
            'id_pengguna'     => $this->request->getPost('edit_pengguna'),
            'id_kamar'     => $this->request->getPost('edit_kamar'),
            'tanggal_masuk'     => $this->request->getPost('edit_masuk'),
            'tanggal_keluar'     => $this->request->getPost('edit_keluar'),
            'total_biaya'     => $this->request->getPost('edit_hasil_total'),
            'status_pemesanan'     => $this->request->getPost('edit_status')
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
        return redirect()->to(base_url('Admin/PemesananController'));
    }

    public function delete_pemesanan()
    {
        $model = new Model_pemesanan();
        $id = $this->request->getPost('id');
        $session = session();
        $model->delete_data($id);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'kosong');
        $id_kamar = $this->request->getPost('id_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);

        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/PemesananController');
    }

    public function data_kamar()
    {
        $model = new Model_pemesanan();
        $data_kamar = $model->data_kamar()->getResultArray();
        $respon = json_decode(json_encode($data_kamar), true);
        $data['results'] = array();

        foreach ($respon as $value) {
            $isi['id'] = $value['id'];
            $isi['text'] = $value['nama_kamar'];
            array_push($data['results'], $isi);
        }
        echo json_encode($data);
    }

    public function data_pengguna()
    {
        $model = new Model_pemesanan();
        $data_pengguna = $model->data_pengguna()->getResultArray();
        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();

        foreach ($respon as $value) {
            $isi['id'] = $value['id'];
            $isi['text'] = $value['nama_lengkap'];
            array_push($data['results'], $isi);
        }
        echo json_encode($data);
    }

    public function data_edit($id_pemesanan)
    {
        $model = new Model_pemesanan();
        $datapemesanan = $model->detail_data($id_pemesanan)->getResultArray();
        $respon = json_decode(json_encode($datapemesanan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id'] = $value['id'];
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['nama_kamar'] = $value['nama_kamar'];
            $isi['id_pengguna'] = $value['id_pengguna'];
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['tanggal_masuk'] = $value['tanggal_masuk'];
            $isi['tanggal_keluar'] = $value['tanggal_keluar'];
            $isi['status_pemesanan'] = $value['status_pemesanan'];
            $isi['total_biaya'] = $value['total_biaya'];
        endforeach;
        echo json_encode($isi);
    }

    public function biaya_kamar($id)
    {
        $model = new Model_pemesanan();
        $biaya_kamar = $model->biaya_kamar($id)->getRowArray();
        $result['biaya'] = $biaya_kamar['biaya'];
        echo json_encode($result);
    }
}