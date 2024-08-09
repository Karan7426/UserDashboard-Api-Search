<?php

namespace App\Controllers;

use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('dashboard/index', [
            'user_name' => session()->get('user_name'),
            'user_picture' => session()->get('user_picture'),
            'user' => $user 
        ]);
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($file = $this->uploadPicture()) {
            $data['picture'] = $file;
        }

        $userModel->update(session()->get('user_id'), $data);
        session()->set(['user_name' => $data['name'], 'user_picture' => $data['picture'] ?? session()->get('user_picture')]);

        
        session()->setFlashdata('success', 'Profile updated successfully!');

         
        return redirect()->to('/dashboard');
    }

    private function uploadPicture()
    {
        $file = $this->request->getFile('picture');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            return $newName;
        }
        return null;
    }
}
