<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_laporan_admin;
use App\Models\Model_dashboard;

class LaporanController extends BaseController
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
        if (!$session->get('username_login') || $session->get('status_login') == 'Customer') {
            return redirect()->to('/Login');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_laporan_admin();
        $pemesanan = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Laporan Pemesanan',
            'page_header' => 'Laporan Pemesanan',
            'panel_title' => 'Laporan Pemesanan',
            'pemesanan' => $pemesanan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        return view('admin/vLaporanPemesanan', $data);
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
        if (!$session->get('username_login') || $session->get('status_login') == 'Customer') {
            return redirect()->to('/Login');
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
        $laporan = $model->view_data_filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id'] = $value['id'];
                $isi['nama_kategori'] = $value['nama_kategori'];
                $isi['tanggal_pesan'] = date("d-m-Y h:i:s", strtotime($value['tanggal_pesan']));
                $isi['nama_lengkap'] = $value['nama_lengkap'];
                $isi['status_pemesanan'] = $value['status_pemesanan'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

}