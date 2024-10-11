<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Jabatan extends BaseController
{
    public function index()
    {
        $jabatanModel = new JabatanModel();
        $data = [
            'title' => 'Data Jabatan',
            'jabatan' =>$jabatanModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/jabatan/jabatan', $data);
    }

    public function store() {
        // dd('Method store dipanggil');
        $validation = \Config\Services::validation();

        $rules = [
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama Jabatan wajib diisi"
                ],
            ],
        ]; 

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            // return view('admin/jabatan/jabatan', $data);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            // dd($validation);
        }

        $jabatanModel = new JabatanModel();
        $jabatanModel->insert([
            'jabatan' => $this->request->getPost('jabatan')
        ]);
        return redirect()->to('admin/jabatan')->with('success', 'Data berhasil ditambahkan');
    }
}
