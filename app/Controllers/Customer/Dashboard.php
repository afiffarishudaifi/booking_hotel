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
        if (!$session->get('username_login') || $session->get('status_login') == 'admin') {
            return redirect()->to('Login');
        }

        $model = new Model_dashboard();

        $data = [
            'judul' => 'Dashboard'
        ];
        helper(['form']);

        return view('customer/index', $data);
    }
}