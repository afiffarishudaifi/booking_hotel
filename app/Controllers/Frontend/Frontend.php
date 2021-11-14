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

        $model = new Model_dashboard();
        $id = $session->get('user_id');

        $model_frontend = new model_frontend();
        $kamar = $model_frontend->view_data()->getResultArray();
        $data = [
            'judul' => 'Katalog Hotel',
            'kamar' => $kamar
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