<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_dashboard;

class FrontendController extends BaseController
{

    public function index()
    {
        $session = session();

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
                    "date(tanggal_pesan)" => $awal,
                    "id" => "0"
                ),
                "1" => array(
                    "date(tanggal_pesan)" => $akhir,
                    "id" => "0"
                )
            );
        }


        $total_pengguna = $model->total_pengguna()->getRowArray();
        $total_kamar_kosong = $model->total_kamar_kosong()->getRowArray();
        $total_kamar_terisi = $model->total_kamar_terisi()->getRowArray();
        $total_pemesanan_bulan_ini = $model->total_pemesanan_bulan_ini()->getRowArray();
        $jumlah_pemesanan = $model->jumlah_pemesanan()->getRowArray();

        $total_pengguna = $total_pengguna['id'] == 0 ? 0 : $total_pengguna['id'];
        $total_kamar_kosong = $total_kamar_kosong['id'] == 0 ? 0 : $total_kamar_kosong['id'];
        $total_kamar_terisi = $total_kamar_terisi['id'] == 0 ? 0 : $total_kamar_terisi['id'];
        $total_pemesanan_bulan_ini = $total_pemesanan_bulan_ini['id'] == 0 ? 0 : $total_pemesanan_bulan_ini['id'];
        $jumlah_pemesanan = $jumlah_pemesanan['id'] == 0 ? 0 : $jumlah_pemesanan['id'];

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
        helper(['form']);

        return view('frontend/index', $data);
    }

}