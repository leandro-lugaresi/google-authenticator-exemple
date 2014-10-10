<?php

namespace App\Controllers;

class User extends AbstractController
{

    public function index()
    {
        if (!isset($_SESSION['isAuth']) || !$_SESSION['isAuth']) {
            header("Location: /");
            die();
        }
        if (isset($_SESSION['users'])) {
            $this->view->users = $_SESSION['users'];
        } else {
            $this->view->users = array();
        }

        $this->render('index');
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
                && $users[$email]['password'] == $_POST['password'])
            {
                $_SESSION['isAuth'] = true;
                $_SESSION['auth'] => $email;
                header("Location: /user");
                die();
            }
        }
        $this->render('login');
    }

    private function getUsers()
    {
        if (isset($_SESSION['users'])) {
            return $_SESSION['users'];
        } else {
            return = array();
        }
    }

    private function setUsers(array $users)
    {
        $_SESSION['users'] = $users;
    }
}
