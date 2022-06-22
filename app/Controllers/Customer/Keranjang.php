<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Model_keranjang;
use App\Models\model_kamar;
use App\Models\Model_dashboard;
use App\Models\Model_pemesanan;
use App\Models\model_pengunjung;
use App\Models\Model_detail_pemesanan;
use App\Models\Model_detail_pengunjung;
use App\Models\Model_keranjang_pengunjung;

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
        

        $cek_data =  $model_dash->cek_data($id)->getRowArray();

        if($cek_data != null) {
            if($cek_data['nama_lengkap'] == '' || $cek_data['nik'] == '' || $cek_data['alamat'] == '' || $cek_data['no_hp'] == null) {
                return redirect()->to(base_url('Customer/Pengaturan'));
            } 
        }

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
            'pengunjung' => $pengunjung,
            'jumlah' => count($pemesanan)
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
        return redirect()->to('/Customer/Keranjang');
    }

    public function simpan_pemesanan()
    {
        $session = session();
        $model = new Model_keranjang();
        $model_detail = new Model_detail_pemesanan();
        $model_keranjang_pengunjung = new Model_keranjang_pengunjung();
        $model_pemesanan = new Model_pemesanan();
        $model_detail_pengunjung = new Model_detail_pengunjung();

        // pemesanan
        $data = array(
            'id_pengguna'     => $session->get('user_id'),
            'bukti_transaksi'     => 'n',
            'tanggal_pesan'     => date('Y-m-d H:i:s'),
            'status_pemesanan'     => 'Pengajuan'
        );
        $model_pemesanan->add_data($data);
        $id_max = $model_pemesanan->max()->getRowArray();
        $id_max = $id_max['id_pemesanan'];

        $input = $this->request->getPost('id');
        $jumlah = count($this->request->getPost('id'));
        for($i = 0; $i < $jumlah; $i++){
            $pilih = $model->detail_data($input[$i])->getRowArray();
            $data = array(
                'id_pemesanan'     => $id_max,
                'id_kamar'     => $pilih['id_kamar'],
                'tanggal_masuk'     => $pilih['tanggal_masuk'],
                'tanggal_keluar'     => $pilih['tanggal_keluar'],
                'total_biaya'     => $pilih['total_biaya']
            );
            $model_detail->add_data($data);

            $id_pemesanan_max = $model_detail->select_max_id()->getRowArray()['id_pemesanan']; //buat insert
            $cari_keranjang_pengunjung = $model_keranjang_pengunjung->cari_keranjang_pengunjung($input[$i])->getResultArray();
            foreach ($cari_keranjang_pengunjung as $value) {
                $data = array(
                    'id_detail'     => $id_pemesanan_max,
                    'nama'     => $value['nama'],
                    'jenis_kelamin'     => $value['jenis_kelamin']
                );
                $model_detail_pengunjung->add_data($data);
            }

            $model_detail->delete_data_from_keranjang($input[$i]);
        }
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Customer/Pemesanan');
    }
}
