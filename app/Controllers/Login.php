<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('login', $data);
    }

    public function login_action() {
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[4]'
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('login', $data);
        }else {
            $session = session();
            $loginModel = new LoginModel();

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $cekUsername = $loginModel->where('username', $username)->first();
            if ($cekUsername) {
                $session_data = [
                    'username' => $cekUsername['username'],
                    'logged_in' => TRUE,
                    'role_id' => $cekUsername['role']
                ];
                $session->set($session_data);
                $password_db = $cekUsername['password'];
                $verify_password = password_verify($password, $password_db);
                if ($verify_password) {
                    switch($cekUsername['role']){
                        case "Admin":
                            return redirect()->to('admin/home');
                        case "Pegawai":
                            return redirect()->to('pegawai/home');
                        default: 
                            $session->setFlashdata('errorMessage', 'Akun anda belum terdaftar');
                            return redirect()->to('/');
                    }
                }else {
                    $session->setFlashdata('errorMessage', 'Password salah, silahkan coba lagi');
                    return redirect()->to('/');
                }
            }else {
                $session->setFlashdata('errorMessage', 'Username salah, silahkan coba lagi');
                return redirect()->to('/');
            }
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
