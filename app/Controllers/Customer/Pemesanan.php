<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Model_pemesanan;
use App\Models\model_kamar;
use App\Models\Model_dashboard;

class Pemesanan extends BaseController
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
        if (!$session->get('username_login') || $session->get('status_login') != 'customer') {
            return redirect()->to('Login');
        }

        $model = new Model_pemesanan();
        $id = $session->get('user_id');
        $pemesanan = $model->view_data_customer($id)->getResultArray();
        $data = [
            'judul' => 'Pemesanan',
            'page_header' => 'Pemesanan',
            'panel_title' => 'Tabel Pemesanan',
            'pemesanan' => $pemesanan
        ];
        return view('Customer/vTPemesanan', $data);
    }

    public function add_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);

        $namabaru = 'noimage.jpg';

        $data = array(
            'id_pengguna'     => $session->get('user_id'),
            'bukti_transaksi'     => $namabaru,
            'tanggal_pesan'     => $this->request->getPost('input_tanggal'),
            'status_pemesanan'     => 'Pengajuan'
        );
        $model = new Model_pemesanan();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Customer/Pemesanan'));
    }

    public function add_pemesanan_lama()
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
            'status_pemesanan'     => 'pengajuan'
        );
        $model = new Model_pemesanan();
        $model->add_data($data);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'terisi');
        $id_kamar = $this->request->getPost('input_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Customer/Pemesanan'));
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
            'status_pemesanan'     => 'pengajuan'
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
        return redirect()->to(base_url('Customer/Pemesanan'));
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
        return redirect()->to('/Customer/Pemesanan');
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

    public function simpan_pemesanan()
    {
        $session = session();
        $data = array(
            'id_pengguna'     => $session->get('user_id'),
            'bukti_transaksi'     => 'n',
            'tanggal_pesan'     => date('Y-m-d G:i:s'),
            'status_pemesanan'     => 'Pengajuan'
        );
        $model = new Model_pemesanan();
        $model->add_data($data);
    }

    public function upload_pemesanan()
    {
        dd($this->request->getPost('edit_foto'));
    }
}
