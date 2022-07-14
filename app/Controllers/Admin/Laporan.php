<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_laporan_admin;
use App\Models\Model_dashboard;

class Laporan extends BaseController
{

    protected $Model_laporan_admin;
    public function __construct()
    {
        $this->Model_laporan_admin = new Model_laporan_admin();
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
            return redirect()->to('Login/indexAdmin');
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
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('admin/vLaporanPemesanan', $data);
    }

    public function data_kategori()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("kategori_kamar");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_kategori, nama_kategori');
            $builder->like('nama_kategori', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kategori, nama_kategori');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pengguna) {
            $poli[] = array(
                "id" => $pengguna->id_kategori,
                "text" => $pengguna->nama_kategori,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function data($tanggal = null, $kategori = null, $status = null)
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
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
        $laporan = $model->view_data_filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id_pemesanan'] = $value['id_pemesanan'];
                $isi['nama_kategori'] = $value['nama_kategori'];
                $isi['tanggal_pesan'] = date("d-m-Y h:i:s", strtotime($value['tanggal_pesan']));
                $isi['nama_lengkap'] = $value['nama_lengkap'];
                $isi['status_pemesanan'] = $value['status_pemesanan'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    public function data_cetak()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'admin') {
            return redirect()->to('Login/indexAdmin');
        }

        $tanggal = $this->request->getPost('tanggal') ;
        $kategori = $this->request->getPost('kategori') ;
        $status = $this->request->getPost('status') ;

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

        $data = [
            'judul' => 'Laporan Pemesanan',
            'laporan' => $laporan
        ];
        return view('admin/cetakLaporanPemesanan', $data);
    }

}
