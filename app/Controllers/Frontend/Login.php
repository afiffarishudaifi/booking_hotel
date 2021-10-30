<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Model_login;

class Login extends BaseController
{
    public function index()
    {
        $session = session();

        if ($session->get('username_login') || $session->get('status_login') == 'Admin') {
            return redirect()->to('Admin/Dashboard');
        } else if ($session->get('username_login') || $session->get('status_login') == 'Customer') {
            return redirect()->to('Customer/Dashboard');
        }

        helper(['form']);
        return view('frontend/login');
    }

    public function login()
    {
        $session = session();
        $model = new Model_login();
        $encrypter = \Config\Services::encrypter();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $status = $data['status'];
            $verify_pass =  $encrypter->decrypt(base64_decode($pass));
            if ($verify_pass == $password) {
                if ($status == 'Customer' || $status == 'customer') {
                    $ses_data = [
                        'user_id'       => $data['id'],
                        'username_login'     => $data['nama_lengkap'],
                        'email_login'    => $data['email'],
                        'status_login'    => $status,
                        'logged_in'     => TRUE,
                        'is_admin'     => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/Customer/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Kamu Bukan Admin');
                    return redirect()->to('/booking_hotel/Frontend/LoginController');
                }
            } else {
                $session->setFlashdata('msg', 'Password Tidak Sesuai');
                return redirect()->to('/booking_hotel/Frontend/LoginController');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak di Temukan');
            return redirect()->to('/booking_hotel/Frontend/LoginController');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/Frontend/LoginController');
    }
}
