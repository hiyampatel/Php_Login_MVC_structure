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

    //delete the
    public function delete($id)
    {
        $this->user_post->delete_post($id);
        header('Location: /blog/index');

    }

    //Redirecting to add page
    public function add()
    {
        $this->view('blog/add');
    }

    //Adding the post
    public function add_post()
    {
        session_start();
        $data = $this->user_post->add_post($_POST);
        if($data == 'F')
        {
            $this->view('blog/add');
        }
        else
        {
            $this->view('blog/index', $data);
        }
    }

    //  Log out from a session
    public function logout()
    {
        session_start();
        unset($_SESSION['submit']);
        unset($_SESSION['m']);
        header('Location: /home/index');
    }

    //for fetching and displaying all post
    public function post($id)
    {
        if(empty($id))
        {
            $data = $this->user_post->post_all();
            $this->view('blog/post', $data);
        }
        else
        {
            $data = $this->user_post->get_data($id);
            $this->view('blog/show', $data);
        }
    }

}

?>
