<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Model_keranjang;
use App\Models\model_kamar;
use App\Models\Model_dashboard;
use App\Models\model_pengunjung;

class Keranjang extends BaseController
{

    protected $Model_keranjang;
    public function __construct()
    {
        $this->Model_keranjang = new Model_keranjang();
        helper('form');
        $this->db = db_connect();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'customer') {
            return redirect()->to('Login');
        }
        $id = $session->get('user_id');
        
        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_keranjang();
        $pemesanan = $model->view_data_keranjang($id)->getResultArray();

        $model_pengunjung = new model_pengunjung();
        $pengunjung = $model_pengunjung->detail_data($id)->getRowArray();

        $data = [
            'judul' => 'Keranjang',
            'page_header' => 'Keranjang',
            'panel_title' => 'Tabel Keranjang',
            'pemesanan' => $pemesanan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan'],
            'id_pemesanan' => $id,
            'pengunjung' => $pengunjung
        ];
        return view('customer/vInvoice', $data);
    }

    public function delete_pemesanan()
    {
        $model = new Model_keranjang();
        $id = $this->request->getPost('id');
        $id_pemesanan = $this->request->getPost('id_pemesanan');
        $session = session();
        $model->delete_data($id);

        $model_kamar = new model_kamar();
        $data_kamar = array('status_kamar' => 'kosong');
        $id_kamar = $this->request->getPost('id_kamar');
        $model_kamar->update_data($data_kamar, $id_kamar);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/customer/Keranjang');
    }
}
