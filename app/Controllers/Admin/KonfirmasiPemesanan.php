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
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
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
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('admin/vTKonfirmasiPemesanan', $data);
    }

    public function update_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_pemesanan();

        $id = $this->request->getPost('id_pemesanan');

        $pengunjung = $model->cari_pengunjung($id)->getRowArray();
        
        $id_user = $session->get('user_id');
        $data_pengunjung = array(
            'nama_lengkap' => $pengunjung['nama_lengkap'],
            'no_hp' => $pengunjung['no_hp'],
            'alamat' => $pengunjung['alamat']
        );
        if($this->request->getPost('input_konfirmasi') == 'tolak') {
            $pemesanan = $model->view_data_detail_pemesanan($id)->getResultArray();
        
            foreach ($pemesanan as $key) {
                $data = array(
                    'status_kamar'     => 'kosong'
                );
                $model->update_data_batal_pemesanan($data, $key['id_kamar']);
            }
        
            $data = array(
                'status_pemesanan'     => 'batal',
                'alasan_ditolak' => $this->request->getPost('edit_alasan'),
                'id_admin' => $id_user
            );
        } else {
            $data = array(
                'status_pemesanan'     => 'terkonfirmasi',
                'id_admin' => $id_user
            );
        }
        $model->update_data_admin($data, $id, $data_pengunjung);

        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/KonfirmasiPemesanan'));
    }

    public function data_edit($id_pemesanan)
    {
        $model = new Model_pemesanan();
        $datapemesanan = $model->detail_data_konfirmasi($id_pemesanan)->getResultArray();
        $respon = json_decode(json_encode($datapemesanan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pemesanan'] = $value['id_pemesanan'];
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['tanggal_pesan'] = $value['tanggal_pesan'];
            $isi['status_pemesanan'] = $value['status_pemesanan'];
            $isi['bukti_transaksi'] = $value['bukti_transaksi'];
            $isi['total_tagihan'] = $value['total_tagihan'];
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
