<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_pemesanan;
use App\Models\Model_keranjang;
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

    public function add_detail_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);

        $data = array(
            'id_pengguna'     => $session->get('user_id'),
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'tanggal_masuk'     => $this->request->getPost('input_masuk'),
            'tanggal_keluar'     => $this->request->getPost('input_keluar'),
            'total_biaya'     => $this->request->getPost('input_hasil_total')
        );
        $model = new Model_keranjang();
        $model->add_data($data);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'terisi');
        $id_kamar = $this->request->getPost('input_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Customer/Keranjang'));
    }
}
