<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_laporan;
use App\Models\Model_pencarian;

class Pencarian extends BaseController
{

    protected $Model_laporan;
    public function __construct()
    {
        $this->Model_laporan = new Model_laporan();
        helper('form');
    }

    public function pencarian()
    {
        $session = session();
        $model = new Model_pencarian();
        $param['input_masuk'] = substr($this->request->getPost('input_masuk'),0,10) . ' ' . substr($this->request->getPost('input_masuk'),11,15);
        $param['input_keluar'] =substr($this->request->getPost('input_keluar'),0,10) . ' ' . substr($this->request->getPost('input_keluar'),11,15);
        $param['input_kategori'] = $this->request->getPost('input_kategori');
        $kamar_kosong = $model->view_data($param)->getResultArray();

        $data = [
            'judul' => 'Hasil Pencarian',
            'kamar' => $kamar_kosong
        ];

        return view('frontend/vPencarian', $data);
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

    public function detail($id)
    {
        $session = session();
        $model = new Model_pencarian();
        $kamar = $model->detail_kamar(1)->getRowArray();
        $fasilitas = $model->detail_fasilitas($kamar['id_kamar'])->getResultArray();
        $foto = $model->detail_foto($kamar['id_kamar'])->getResultArray();
        $foto_limit = $model->detail_foto_limit($kamar['id_kamar'])->getRowArray();
        $data = [
            'judul' => 'Detail Kamar',
            'kamar' => $kamar,
            'fasilitas' => $fasilitas,
            'foto' => $foto,
            'foto_cover' => $foto_limit['nama_foto']
        ];

        return view('frontend/vDetailKamar', $data);
    }

}