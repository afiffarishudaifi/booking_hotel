<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_dashboard;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->Model_dashboard = new Model_dashboard();
        helper('form');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
            return redirect()->to('Login/indexAdmin');
        }

        $model = new Model_dashboard();
        $id = $session->get('user_id');
    	$tanggal = $this->request->getPost('daterange');
        if ($tanggal == null && $tanggal == '') {
            $akhir = date('Y-m-d');
            $awal = date('Y-m-d', strtotime('-30 days', strtotime($akhir)));
            $range = "30 Hari Terakhir";
        } else {
            if ($tanggal) {
                $tgl = explode(' - ', $tanggal);
            }
            if ($tanggal) {
                $awal = date("Y-m-d", strtotime($tgl[0]));
            }
            if ($tanggal) {
                $akhir = date("Y-m-d", strtotime($tgl[1]));
            }
            $range = $awal . ' s/d ' . $akhir;
        }

        $param =
            [
                'id' => $id,
                'awal' => $awal,
                'akhir' => $akhir
            ];
        $data_pemesanan = $model->pemesanan($param)->getResultArray();
        $hasil = count($data_pemesanan);
        if ($hasil == 0) {
            $data_pemesanan = array(
                "0" => array(
                    "tanggal_pesan" => $awal,
                    "id_pemesanan" => "0"
                ),
                "1" => array(
                    "tanggal_pesan" => $akhir,
                    "id_pemesanan" => "0"
                )
            );
        }


        $total_pengguna = $model->total_pengguna()->getRowArray();
        $total_kamar_kosong = $model->total_kamar_kosong()->getRowArray();
        $total_kamar_terisi = $model->total_kamar_terisi()->getRowArray();
        $total_pemesanan_bulan_ini = $model->total_pemesanan_bulan_ini()->getRowArray();
        $jumlah_pemesanan = $model->jumlah_pemesanan()->getRowArray();

        $total_pengguna = $total_pengguna['id_pengguna'] == 0 ? 0 : $total_pengguna['id_pengguna'];
        $total_kamar_kosong = $total_kamar_kosong['id_kamar'] == 0 ? 0 : $total_kamar_kosong['id_kamar'];
        $total_kamar_terisi = $total_kamar_terisi['id_kamar'] == 0 ? 0 : $total_kamar_terisi['id_kamar'];
        $total_pemesanan_bulan_ini = $total_pemesanan_bulan_ini['id_pemesanan'] == 0 ? 0 : $total_pemesanan_bulan_ini['id_pemesanan'];
        $jumlah_pemesanan = $jumlah_pemesanan['id_pemesanan'] == 0 ? 0 : $jumlah_pemesanan['id_pemesanan'];

        $data = [
            'judul' => 'Dashboard',
            'range' => $range,
            'pemesanan' => $data_pemesanan,
            'total_pengguna' => $total_pengguna,
            'total_kamar_kosong' => $total_kamar_kosong,
            'total_kamar_terisi' => $total_kamar_terisi,
            'total_pemesanan_bulan_ini' => $total_pemesanan_bulan_ini,
            'jumlah_pemesanan' => $jumlah_pemesanan
        ];
        // dd($data);
        helper(['form']);

        return view('admin/index', $data);
    }

    public function jumlah_pemesanan()
    {
        $model = new Model_dashboard();
        $jumlah_pemesanan = $model->jumlah_pemesanan()->getRowArray();
        $cek_status = $model->cek_status_kamar(date("Y-m-d H:i:s"))->getRowArray();
        if ($cek_status != null) {
            $ubah_pemesanan = $model->update_status_pemesanan($cek_status['id']);
            $ubah_kamar = $model->update_status_kamar($cek_status['id_kamar']);
        }
        
        $cek_pembayaran = $model->cek_status_pembayaran(date("Y-m-d H:i:s"))->getRowArray();
        if ($cek_pembayaran != null) {
            $ubah_pemesanan = $model->update_status_pemesanan_batal($cek_pembayaran['id']);
            $ubah_kamar = $model->update_status_kamar($cek_pembayaran['id_kamar']);
        }

        $result['total_pemesanan'] = $jumlah_pemesanan['id_pemesanan'];
        echo json_encode($result);
    }

}
