<?php

class Home extends Controller
{

    private $user;

    public function  __construct()
    {
        $this->user = $this->model('User');
    }



    public function index($name)
    {
        $this->view('home/index');
    }

    public function login()
    {
        if(isset($_POST['submit']))
        {
            $result =$this->user->check_user($_POST);
            if($result === True)
            {
                $this->view('home/index');
            }
            else
            {
                $this->view('home/index', ['m'=>'User does not exist!']);
            }

        }
        else
        {
            session_start();
            $this->view('home/login');
        }
    }



    public function signup()
    {
        if(isset($_POST['submit']))
        {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['submit'] = $_POST['submit'];

            $this->user->check_user($_POST);

            $this->view('home/index');

        }
        else
        {
            session_start();
            $this->view('home/signup');
        }
    }
}

?>
