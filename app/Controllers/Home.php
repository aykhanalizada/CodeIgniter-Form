<?php

namespace App\Controllers;

use App\Models\User;
use DateTime;

class Home extends BaseController
{

    public function __construct()
    {
        helper('form');
    }


    public function index(): string
    {
        return view('login');
    }

    public function login()
    {

        if ($this->isUserLoggedIn()) {
            return redirect()->to('profile'); // Redirect to profile page
        } else {
            $validate = [
                'email' => 'required|valid_email',
                'password' => 'required'
            ];

            if (!$this->validate($validate)) {
                return view('', ['validation' => $this->validator]);
            }


            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = new User();
            $user = $user->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'user_id' => $user['id']
                ]);

                return redirect()->to('profile');
            } else {
                return redirect()->to('')->withInput()->with('error', 'Invalid email or password');

            }
        }
    }

    public function register()
    {

        if ($this->isUserLoggedIn()) {
            return redirect()->to('profile');
        } else {
            if ($this->request->is('post')) {

                $validate = [
                    'name' => 'required',
                    'surname' => 'required',
                    'email' => 'required|valid_email|is_unique[users.email]',
                    'password' => 'required|min_length[6]',
                    'confirm_password' => 'required|matches[password]'
                ];

                if (!$this->validate($validate)) {
                    return view('register', ['validation' => $this->validator]);
                }

                $name = $this->request->getPost('name');
                $surname = $this->request->getPost('surname');
                $birthday = $this->request->getPost('birthday');
                $email = $this->request->getPost('email');
                $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

                $user = new User();
                $userData = [
                    'name' => $name,
                    'surname' => $surname,
                    'birthday' => $birthday,
                    'email' => $email,
                    'password' => $password,
                ];
                $user->insert($userData);

                return redirect()->to('/')->with('success', 'Registration successful! ');
            }

            return view('register');
        }
    }
    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('');
        }


        $user = new User();
        $user = $user->find($userId);

        if (!$user) {
            return redirect()->to('');
        }


        $birthday=new DateTime($user['birthday']);
$today= new DateTime();
$age=$today->diff($birthday)->y;

        return view('profile', ['user' => $user,'age' => $age]);
    }


    public function logout()
    {
        $session = session();

        if ($session->has('user_id')) {
            $user_id = $session->get('user_id');

            $session->remove(['user_id']);

            $session->destroy();
        } else {

            echo 'No user ID found in the session.';
        }


        return redirect()->to('');
    }


    private function isUserLoggedIn()
    {
        $session = session();
        return $session->has('user_id');
    }

}
