<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_laporan_admin;
use App\Models\Model_dashboard;

class LaporanPendapatan extends BaseController
{

    protected $Model_laporan_admin;
    public function __construct()
    {
        $this->Model_laporan_admin = new Model_laporan_admin();
        helper('form');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_laporan_admin();
        $pendapatan = $model->view_data_pendapatan()->getResultArray();
        $data = [
            'judul' => 'Laporan Pendapatan',
            'page_header' => 'Laporan Pendapatan',
            'panel_title' => 'Laporan Pendapatan',
            'pendapatan' => $pendapatan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        // dd($data);
        return view('admin/vLaporanPendapatan', $data);
    }

    public function data_kategori()
    {
        $session = session();
        $model = new Model_laporan_admin();
        $data_kategori = $model->data_kategori()->getResultArray();
        $respon = json_decode(json_encode($data_kategori), true);
        $data['results'] = array();

        foreach ($respon as $value) {
            $isi['id'] = $value['id'];
            $isi['text'] = $value['nama_kategori'];
            array_push($data['results'], $isi);
        }
        echo json_encode($data);
    }

    public function data($tanggal = null, $kategori = null, $status = null)
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0]));
        if ($tanggal) $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1]));
        if ($kategori != 'null') {
            $param['id_kategori'] = $kategori;
        } else {
            $param['id_kategori'] = null;
        }
        if ($status != 'null') {
            $param['status_pemesanan'] = $status;
        } else {
            $param['status_pemesanan'] = null;
        }

        $model = new Model_laporan_admin();
        $laporan = $model->view_data_filter_pendapatan($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id'] = $value['id'];
                $isi['tanggal'] = $value['tanggal'];
                $isi['total'] = $value['total'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

}