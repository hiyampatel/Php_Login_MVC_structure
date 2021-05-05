<?php

//Controller class for the home pages
class Home extends Controller
{

    private $user;

    //Creating a model instance
    public function  __construct()
    {
        $this->user = $this->model('User');
    }

    //Calling main index page
    public function index($name)
    {
        $this->view('home/index');
    }


    //Handle the Login functionality
    //If redirected after form submission then check for user data into database and redirect to home page
    //Else display Login page
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


    //Handle the Signup functionality
    //If redirected after form submission then check for user data into database and store the details if user not found
    //Else display SignUp page
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
