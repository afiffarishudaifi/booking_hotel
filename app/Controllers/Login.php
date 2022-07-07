<?php

namespace App\Controllers;
use App\Models\Model_login;

class Login extends BaseController
{
    private $loginModel=NULL;
    private $googleClient=NULL;
    function __construct(){
        require_once APPPATH. "Libraries/vendor/autoload.php";
        $this->loginModel = new Model_login();
        $this->googleClient = new \Google_Client();
        $this->googleClient->setClientId("668824993527-85c5qphkc0svk4r2lrfjlhbkkgfplini.apps.googleusercontent.com");
        $this->googleClient->setClientSecret("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");
        $this->googleClient->setRedirectUri("https://bookinghotelpurbaya.silda.xyz/Login/loginWithGoogle");
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");

    }

    public function loginWithGoogle()
    {
        $session = session();
        $model = new Model_login();
        // $max = $model->cek_max()->getRowArray()['id_user'];
        // $max = $max + 1;

        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if(!isset($token['error'])){
            $this->googleClient->setAccessToken($token['access_token']);
            session()->set("AccessToken", $token['access_token']);

            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            $currentDateTime = date("Y-m-d H:i:s");
            $userdata=array();
            if($this->loginModel->isAlreadyRegister($data['id'])){
                //User ALready Login and want to Login Again
                $userdata = [
                    'oauth_id'=>$data['id'],
                    'email'=>$data['email']
                ];
                $this->loginModel->updateUserData($userdata, $data['id']);

                $data_login = $model->cek_login($data['id'])->getRowArray();
                $ses_data = [
                    'user_id' => $data_login['id_pengguna'],
                    'username_login' => $data_login['nama_lengkap'],
                    'email_login' => $data_login['email'],
                    'foto' => $data_login['file'],
                    'status_login' => 'customer',
                    'logged_in' => TRUE,
                    'is_admin' => TRUE
                ];
            }else{
                //new User want to Login
                $userdata = array(
                    'oauth_id'=>$data['id'],
                    'email'=>$data['email'], 
                    'nama_lengkap' => $data['name'], 
                    'no_hp' => 0,
                    'file' => 'n'
                );
                $this->loginModel->insertUserData($userdata);

                $max_login = $model->cek_max_login($data['id'])->getRowArray()['id_pengguna'];
                $ses_data = [
                    'user_id' => $max_login,
                    'username_login' => $data['name'],
                    'email_login' => $data['email'],
                    'foto' => $data['file'],
                    'status_login' => 'customer',
                    'logged_in' => TRUE,
                    'is_admin' => TRUE
                ];
            }

            
            $session->set("LoggedUserData", $ses_data);
            $session->set($ses_data);

            return redirect()->to('/Frontend/Frontend');

        }else{
            $session->setFlashData("Error", "Something went Wrong");
            return redirect()->to(base_url());
        }
    }

    public function index()
    {
        $session = session();

        if ($session->get('username_login') || $session->get('status_login') == 'Admin') {
            return redirect()->to('Admin/Dashboard');
        } else if ($session->get('username_login') || $session->get('status_login') == 'Customer') {
            return redirect()->to('Customer/Dashboard');
        }

        helper(['form']);

        $data['googleButton'] = $this->googleClient->createAuthUrl();
        return view('vLogin', $data);
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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $data = $model->cek_admin($email)->getRowArray();

        if ($data) {
            $pass = $data['password'];
            if($data['level'] == 'Super Admin') {
                $status = 'superadmin';
                $verify_pass =  $encrypter->decrypt(base64_decode($pass));
                if ($verify_pass == $password) {
                    $ses_data = [
                        'user_id' => $data['id_admin'],
                        'username_login' => $data['nama_lengkap'],
                        'email_login' => $data['email'],
                        'foto' => $data['file'],
                        'status_login' => $status,
                        'logged_in' => TRUE,
                        'is_admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/SuperAdmin/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Password Tidak Sesuai');
                    return redirect()->to('/Login');
                }
            } else {
                $status = 'admin';
                $verify_pass =  $encrypter->decrypt(base64_decode($pass));
                if ($verify_pass == $password) {
                    $ses_data = [
                        'user_id' => $data['id_admin'],
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
                    $session->setFlashdata('msg', 'Password Tidak Sesuai');
                    return redirect()->to('/Login');
                }
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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $status = $data['status'];
            $verify_pass =  $encrypter->decrypt(base64_decode($pass));
            if ($verify_pass == $password) {
                if ($status == 'customer') {
                    $ses_data = [
                        'user_id' => $data['id_pengguna'],
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
                    $session->setFlashdata('msg', 'Anda Bukan Customer');
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

        session()->remove('LoggedUserData');
        session()->remove('AccessToken');
        return redirect()->to('/Login');
    }
}
