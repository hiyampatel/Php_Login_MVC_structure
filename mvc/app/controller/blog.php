<?php

//Methods of bloging page
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

    //getting the data of the post and sending it to edit page
    public function edit($name = 1)
    {
        $data = $this->user_post->get_data($name);
        $this->view('blog/edit', $data);
    }

    //update the post
    public function update($id)
    {
        $this->user_post->update_post($_POST, $id);
        header('Location: /blog/index');
    }


    public function delete($id)
    {
        $this->user_post->delete_post($id);
        header('Location: /blog/index');

    }

    public function logout()
    {
        session_start();
        unset($_SESSION['submit']);
        unset($_SESSION['m']);
        header('Location: /home/index');
        //$this->view('home/index');
    }

}

?>
