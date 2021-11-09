<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Model_laporan;
use App\Models\Model_dashboard;

class Laporan extends BaseController
{

    protected $Model_laporan;
    public function __construct()
    {
        $this->Model_laporan = new Model_laporan();
        helper('form');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'admin') {
            return redirect()->to('Login/indexAdmin');
        }
        $id_pengguna = $session->get('user_id');

        $model = new Model_laporan();
        $pemesanan = $model->view_data($id_pengguna)->getResultArray();
        $data = [
            'judul' => 'Laporan Pemesanan',
            'page_header' => 'Laporan Pemesanan',
            'panel_title' => 'Laporan Pemesanan',
            'pemesanan' => $pemesanan
        ];
        return view('customer/vLaporanPemesanan', $data);
    }

    public function data_kategori()
    {
        $session = session();
        $model = new Model_laporan();
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
        if (!$session->get('username_login') || $session->get('status_login') == 'admin') {
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

        $id_pengguna = $session->get('user_id');
        $param['id_pengguna'] = $id_pengguna;

        $model = new Model_laporan();
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