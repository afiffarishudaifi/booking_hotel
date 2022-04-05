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
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'customer') {
            return redirect()->to('Login');
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

        foreach ($data as $datakategori) {
            $poli[] = array(
                "id" => $datakategori->id_kategori,
                "text" => $datakategori->nama_kategori,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
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

}