<?php

namespace App\Controllers;
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
        return view('vLogin');
    }

    public function indexAdmin()
    {
        $session = session();

        if ($session->get('username_login') || $session->get('status_login') == 'Admin') {
            return redirect()->to('Admin/Dashboard');
        } else if ($session->get('username_login') || $session->get('status_login') == 'Customer') {
            return redirect()->to('Customer/Dashboard');
        }

        helper(['form']);
        return view('vLoginAdmin');
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
                if ($status == 'admin' || $status == 'Admin') {
                    $ses_data = [
                        'user_id' => $data['id'],
                        'username_login' => $data['nama_lengkap'],
                        'email_login' => $data['email'],
                        'foto' => $data['file'],
                        'status_login' => $status,
                        'logged_in' => TRUE,
                        'is_admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/Admin/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Kamu Bukan Admin');
                    return redirect()->to('/Login');
                }
            } else {
                $session->setFlashdata('msg', 'Password Tidak Sesuai');
                return redirect()->to('/Login');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak di Temukan');
            return redirect()->to('/Login');
        }
    }

    public function login_customer()
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
                if ($status == 'admin' || $status == 'customer') {
                    $ses_data = [
                        'user_id' => $data['id'],
                        'username_login' => $data['nama_lengkap'],
                        'email_login' => $data['email'],
                        'foto' => $data['file'],
                        'status_login' => $status,
                        'logged_in' => TRUE,
                        'is_admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/Customer/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Kamu Bukan Customer');
                    return redirect()->to('/Login');
                }
            } else {
                $session->setFlashdata('msg', 'Password Tidak Sesuai');
                return redirect()->to('/Login');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak di Temukan');
            return redirect()->to('/Login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/Login');
    }
}
