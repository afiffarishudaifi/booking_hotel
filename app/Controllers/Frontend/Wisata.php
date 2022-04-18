<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_wisata;
use App\Models\Model_dashboard;
use App\Models\model_frontend;

class Wisata extends BaseController
{

    protected $Model_wisata;
    public function __construct()
    {
        $this->Model_wisata = new Model_wisata();
        helper('form');
    }

    public function index()
    {
        $session = session();

        $model = new Model_dashboard();
        $id = $session->get('user_id');

        $model_frontend = new model_frontend();
        $wisata = $model_frontend->view_data_wisata_full()->getResultArray();
        $data = [
            'judul' => 'Wisata Terdeket',
            'wisata' => $wisata
        ];
        helper(['form']);

        return view('frontend/listWisata', $data);
    }

    public function detail($id)
    {
        $session = session();
        $model = new Model_wisata();
        $wisata = $model->detail_data($id)->getRowArray();
        $data = [
            'judul' => 'Detail Wisata',
            'wisata' => $wisata
        ];

        return view('frontend/vDetailWisata', $data);
    }

}