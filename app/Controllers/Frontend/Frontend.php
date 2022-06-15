<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_dashboard;
use App\Models\Model_laporan;
use App\Models\model_frontend;

class Frontend extends BaseController
{

    public function index()
    {
        $session = session();
        $kosong = array();
        date_default_timezone_set('Asia/Jakarta');

        $model = new Model_dashboard();
        $id = $session->get('user_id');


        $cek_data =  $model->cek_data($id)->getRowArray();

        if($cek_data != null) {
            if($cek_data['nama_lengkap'] == '' || $cek_data['nik'] == '' || $cek_data['alamat'] == '' || $cek_data['no_hp'] == null) {
                return redirect()->to(base_url('Customer/Pengaturan'));
            } 
        }

        $model_frontend = new model_frontend();
        $param['input_masuk'] = date('Y-m-d');
        $data = $model_frontend->cek_kamar($param)->getResultArray();
        foreach ($data as $value) {
            $kosong[] = $value['id_kamar'];
        }
        $kamar = $model_frontend->view_data($kosong)->getResultArray();
        $wisata = $model_frontend->view_data_wisata()->getResultArray();
        $data = [
            'judul' => 'Katalog Hotel',
            'kamar' => $kamar,
            'wisata' => $wisata
        ];
        helper(['form']);

        return view('frontend/index', $data);
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

}
