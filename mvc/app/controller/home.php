<?php

//Controller class for the home pages
class Home extends Controller
{
    //Method to get the name from object of User model
    //Sending the data to be views
    public function index($name)
    {
        $user = $this->model('User');
        $user->name = $name[0];

        $this->view('home/index', ['name'=>$user->name]);
    }
}

?>
