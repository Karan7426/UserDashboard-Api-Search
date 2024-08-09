<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'picture' => 'uploaded[picture]|max_size[picture,2048]|is_image[picture]|mime_in[picture,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$this->validate($validation->getRules())) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture' => $this->uploadPicture()
        ];

        if ($userModel->insert($data)) {
            session()->setFlashdata('success', 'Registration successful! You can now log in.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set(['user_id' => $user['id'], 'user_name' => $user['name'], 'user_picture' => $user['picture']]);
            return redirect()->to('/dashboard');
        }

        session()->setFlashdata('error', 'Invalid credentials. Please try again.');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    private function uploadPicture()
    {
        $file = $this->request->getFile('picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            return $newName;
        }
        return null;
    }
}
