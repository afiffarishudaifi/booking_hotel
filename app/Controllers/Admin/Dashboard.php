<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_dashboard;

class Dashboard extends BaseController
{

    public function index()
    {
        $session = session();
        // if (!$session->get('username_login') || $session->get('level_login') == 'User') {
        //     return redirect()->to('/smartapps/Dashboard/Login');
        // }

        $model = new Model_dashboard();
        $id = $session->get('id_login');
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


        $total_pengguna = $model->total_pengguna();
        $total_kamar_kosong = $model->total_kamar_kosong();
        $total_kamar_terisi = $model->total_kamar_terisi();
        $total_pemesanan_bulan_ini = $model->total_pemesanan_bulan_ini();
        $jumlah_pengajuan_pemesanan = $model->jumlah_pengajuan_pemesanan();

        $data = [
            'judul' => 'Dashboard',
            'range' => $range,
            'pemesanan' => $data_pemesanan,
            'total_pengguna' => $total_pengguna,
            'total_kamar_kosong' => $total_kamar_kosong,
            'total_kamar_terisi' => $total_kamar_terisi,
            'total_pemesanan_bulan_ini' => $total_pemesanan_bulan_ini,
            'jumlah_pengajuan_pemesanan' => $jumlah_pengajuan_pemesanan
        ];
        helper(['form']);

        return view('admin/index', $data);
    }

    public function jumlah_pemesanan()
    {
        $model = new Model_dashboard();
        $jumlah_pengajuan_pemesanan = $model->jumlah_pengajuan_pemesanan();
        $result['total_pemesanan'] = $jumlah_pengajuan_pemesanan['id'];
        echo json_encode($result);
    }

}