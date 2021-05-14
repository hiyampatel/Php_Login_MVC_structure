<?php

//Class to alter and retrive data from post modle
class Post extends Database
{

    //function to add new data and display it with other data
    public function add_post($post_data)
    {
        session_start();

        $sql = "INSERT INTO Post_Data(User_Id, Post, Date_Time) VALUES(?,?, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $_SESSION['Id'], $post_data['blogpost']);
        $stmt->execute();

        $data = $this->display_post($_SESSION['Id']);

        return $data;
    }

    //function to display post data of the table
    public function display_post($id = '')
    {
        $sql = "SELECT * FROM Post_Data WHERE User_Id=? ORDER BY Date_Time DESC";

        //echo $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result();

        if($data->num_rows > 0)
        {
            return $data;
        }
        else
        {
            return 'No Posts';
        }
    }

    //getting the data using post id
    public function get_data($id)
    {
        $sql = "SELECT P.Id, L.Username, P.Post, P.Date_Time, P.Edit_Time FROM Post_Data AS P, Login_Detail AS L WHERE P.User_Id = L.Id AND P.Id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id[0]);
        $stmt->execute();
        $data = $stmt->get_result();
        $row = $data->fetch_assoc();

        return $row;
    }

    //Update the post and time of update
    public function update_post($post_data, $id)
    {
        if(!isset($post_data['post']))
        {
            return ;
        }

        $sql = "UPDATE Post_Data SET Post=? Edit_Time=NOW() WHERE Id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $post_data['Post'], $id[0]);
        $stmt->execute();
        return ;
    }


    //Delete the post
    public function delete_post($id)
    {
        //fetching the post data
        $sql = "SELECT * FROM Post_Data WHERE Id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id[0]);
        $stmt->execute();
        $data = $stmt->get_result();
        $row = $data->fetch_assoc();

        //getting the url of post images if any
        $dom = new domDocument;
        $dom->loadHTML($row['Post']);
        $dom->preserveWhiteSpace = false;
        $images = $dom->getElementsByTagName('img');

        //deleting the post images from the folder
        foreach ($images as $image)
        {
            $src = $image->getAttribute('src');
            $src = ltrim($src, '/../..');
            if (file_exists(__DIR__.'/../../public/'.$src))
            {
                unlink(__DIR__.'/../../public/'.$src);
            }
        }

        //deleting post data
        $sql = "DELETE FROM Post_Data WHERE Id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id[0]);
        $stmt->execute();
        return ;
    }

    //displaying all post
    public function post_all()
    {
        $sql = "SELECT P.Id, L.Username, P.Post, P.Date_Time, P.Edit_Time FROM Post_Data AS P, Login_Detail AS L WHERE P.User_Id = L.Id ORDER BY P.Date_Time DESC";

        $data = $this->conn->query($sql);

        if($data->num_rows > 0)
        {
            return $data;
        }
        else
        {
            return 'No Posts';
        }
    }

}

?>
