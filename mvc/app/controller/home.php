<?php

//home class which inherits from controller class
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
        session_start();
        if(isset($_POST['submit']))
        {
            $result =$this->user->check_user($_POST);
            if($result == 'TRUE')
            {
                $this->view('home/index');
            }
            else
            {
                $this->view('home/index');
            }
        }
        else
        {
            $this->view('home/login');
        }
    }



    public function signup()
    {
        if(isset($_POST['submit']))
        {
            session_start();

            $result = $this->user->check_user($_POST);
            if($result == 'TRUE')
            {
                $_SESSION['m'] = 'User already exist!';
                unset($_SESSION['submit']);
                $this->view('home/index');
            }
            else
            {
                $result = $this->user->enter_data($_POST);
                $this->view('home/index');
            }
        }
        else
        {
            session_start();
            $this->view('home/signup');
        }
    }
}

?>
