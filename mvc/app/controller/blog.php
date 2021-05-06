<?php

Class Blog extends Controller
{
    protected $user_post;

    //Creating a model instance
    public function  __construct()
    {
        $this->user_post = $this->model('Post');
    }

    //Directing to main blog page
    public function index()
    {
        session_start();
        $data = $this->user_post->display_post($_SESSION['Id']);
        $this->view('blog/index', $data);
    }

    //Adding the post
    public function post()
    {
        $data = $this->user_post->add_post($_POST);
        $this->view('blog/index', $data);
    }

}

?>
