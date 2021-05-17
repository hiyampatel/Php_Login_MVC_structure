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
        $data = $this->user->home_data();
        $this->view('home/index', $data);
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
            if($result == 'T')
            {
                header('Location: /blog/index');
            }
            else
            {
                header('Location: /home/login');
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

            if($result == 'T')
            {
                $_SESSION['m'] = 'User already exist!';
                unset($_SESSION['submit']);
                header('Location: /home/signup');
            }
            else
            {
                $result = $this->user->enter_data($_POST);
                if(isset($_SESSION['m']))
                {
                    header('Location: /home/signup');
                }
                else
                {
                    header('Location: /home/login');
                }
            }
        }
        else
        {
            session_start();
            $this->view('home/signup');
        }
    }

    public function aboutus()
    {
        $this->view('home/aboutus');
    }

    public function userinfo()
    {
        if($_POST['submit'] == 'Change')
        {
            $result = $this->user->user_data($_POST);
            if($result == 'F')
            {
                $this->view('home/userinfo');
            }
            else
            {
                header('Location: /blog/index');
            }
        }
        else
        {
            $this->view('home/userinfo');
        }
    }
}

?>
