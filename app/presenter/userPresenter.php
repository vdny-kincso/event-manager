<?php 
require_once __DIR__ . '/../model/User.php';

class userPresenter {

    public function register(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $userModel = new User();

            $success = $userModel->register($email, $pass, $name);

            if ($success){
                // header('Location:index.php?page=login');
                echo '<script>window.location.href = "index.php?oldal=login";</script>';
                exit;
            } else{
                echo "Error: something went wrong during registartion";
            }
        }

        require_once __DIR__ . '/../views/register.php';
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $userModel = new User();

            $loggedUser = $userModel->login($email,$pass);

            if ($loggedUser){
                $_SESSION['user_id'] = $loggedUser['id'];
                $_SESSION['user_name'] = $loggedUser['fullname'];

                echo '<script>window.location.href = "index.php";</script>';
                exit;
            }else{
                echo "<p style='color:red; text-align:center;'>Wrong password!</p>";
            }
        }

        require_once __DIR__ . '/../views/login.php';
    }

    public function logout(){
        $_SESSION = [];

        session_destroy();

        echo '<script>window.location.href = "index.php?oldal=login";</script>';
        exit;
    }

}
