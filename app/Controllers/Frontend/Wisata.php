<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_wisata;

class Wisata extends BaseController
{

    protected $Model_wisata;
    public function __construct()
    {
        $this->Model_wisata = new Model_wisata();
        helper('form');
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