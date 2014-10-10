<?php

namespace App\Controllers;

use GoogleAuthenticator\GoogleAuthenticator;

class User extends AbstractController
{

    public function index()
    {
        $this->verifyUser();
        $this->view->users = $this->getUsers();

        $this->render('index');
    }

    public function activate()
    {
        $this->verifyUser();
        $users = $this->getUsers();
        $googleAuth = new GoogleAuthenticator($users[$_SESSION['auth']]['secretKey']);
        $applicationName = $_SESSION['auth'];
        $googleAuth->setIssuer('Demo Google Authenticator');

        if (isset($_POST['code']) && isset($_POST['secretKey'])) {
            $googleAuth->setSecretKey($_POST['secretKey']);
            if ($googleAuth->verifyCode($_POST['code'])) {
                $users[$_SESSION['auth']]['usingGoogleAuth'] = true;
                $users[$_SESSION['auth']]['secretKey'] = $googleAuth->getSecretKey();
                $this->setUsers($users);

            }
        }

        $this->view->secretKey = $googleAuth->getSecretKey();
        $this->view->qrCode = $googleAuth->getQRCodeUrl($applicationName);
        $this->view->usingGoogleAuth = $users[$_SESSION['auth']]['usingGoogleAuth'];
        $this->render('activate');
    }

    public function create()
    {
        if (!empty($_POST['name'])) {
            //create the user at the SESSION
            $users = $this->getUsers();
            $users[$_POST['email']] = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'usingGoogleAuth' => false,
                'secretKey' => null,
            );

            $this->setUsers($users);
            $_SESSION['auth'] = $_POST['email'];
            $_SESSION['isAuth'] = true;
        }

        $this->render('create');
    }

    public function logout()
    {
        $_SESSION['auth'] = '';
        $_SESSION['isAuth'] = false;
        header("Location: /");
        die();
    }

    public function login()
    {
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $users = $this->getUsers();
            if(
                array_key_exists($email, $users)
                && $users[$email]['password'] == $_POST['password']
            ){
                $_SESSION['isAuth'] = true;
                $_SESSION['auth'] = $email;
                header("Location: /user");
                die();
            }
            $this->view->error = true;
        }
        $this->render('login');
    }

    private function getUsers()
    {
        if (isset($_SESSION['users'])) {
            return $_SESSION['users'];
        } else {
            return array();
        }
    }

    private function setUsers(array $users)
    {
        $_SESSION['users'] = $users;
    }

    private function verifyUser()
    {
        if (!isset($_SESSION['isAuth']) || !$_SESSION['isAuth']) {
            header("Location: /");
            die();
        }
    }
}
