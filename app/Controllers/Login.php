<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $session = session();
        // if ($session->get('user_name')) {
        //     return redirect()->to('/tve/tv-e/index.php/dashboard/Dashboard');
        // }

        helper(['form']);
        return view('login');
    }

    public function login()
    {
        $session = session();
        $model = new UsersModel();
        $encrypter = \Config\Services::encrypter();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $status = $data['status'];
            $verify_pass =  $encrypter->decrypt(base64_decode($pass));
            if ($verify_pass == $password) {
                if ($status == 'admin' || $status == 'Admin') {
                    $ses_data = [
                        'user_id'       => $data['id'],
                        'user_name'     => $data['nama_lengkap'],
                        'user_email'    => $data['email'],
                        'user_status'    => $status,
                        'logged_in'     => TRUE,
                        'is_admin'     => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/booking_hotel/index.php/Admin/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Kamu Bukan Admin');
                    return redirect()->to('/booking_hotel/index.php/Login');
                }
            } else {
                $session->setFlashdata('msg', 'Password Tidak Sesuai');
                return redirect()->to('/booking_hotel/index.php/Login');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak di Temukan');
            return redirect()->to('/booking_hotel/index.php/Login');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/booking_hotel/index.php/Login');
    }
}
