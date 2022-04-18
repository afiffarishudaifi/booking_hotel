<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Model_dashboard;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->Model_dashboard = new Model_dashboard();
        helper('form');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'customer') {
            return redirect()->to('Login');
        }
        
        $id = $session->get('user_id');
        
        $model = new Model_dashboard();

        $cek_data =  $model->cek_data($id)->getRowArray();

        if($cek_data != null) {
            if($cek_data['nama_lengkap'] == '' || $cek_data['nik'] == '' || $cek_data['alamat'] == '' || $cek_data['no_hp'] == null) {
                return redirect()->to(base_url('Customer/Pengaturan'));
            } 
        }

        $data = [
            'judul' => 'Dashboard'
        ];
        helper(['form']);

        return view('customer/index', $data);
    }
}