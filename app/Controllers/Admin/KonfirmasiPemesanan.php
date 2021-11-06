<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_pemesanan;
use App\Models\model_kamar;
use App\Models\Model_dashboard;

class KonfirmasiPemesanan extends BaseController
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
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_pemesanan();
        $pemesanan = $model->view_data_konfirmasi()->getResultArray();
        $data = [
            'judul' => 'Konfirmasi Pemesanan',
            'page_header' => 'Konfirmasi Pemesanan',
            'panel_title' => 'Tabel Konfirmasi Pemesanan',
            'pemesanan' => $pemesanan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        return view('admin/vTKonfirmasiPemesanan', $data);
    }

    public function update_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_pemesanan();

        $id = $this->request->getPost('id_pemesanan');
        $data = array(
            'status_pemesanan'     => 'terkonfirmasi'
        );
        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/KonfirmasiPemesanan'));
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