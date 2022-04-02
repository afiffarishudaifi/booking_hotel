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
        $this->db = db_connect();
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
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        // dd($data);
        return view('admin/vLaporanPendapatan', $data);
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
                $isi['id_pemesanan'] = $value['id_pemesanan'];
                $isi['tanggal'] = $value['tanggal'];
                $isi['total'] = $value['total'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

}