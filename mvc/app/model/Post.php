<?php

//Class to alter and retrive data from post modle
class Post extends Database
{

    //function to add new data and display it with other data
    public function add_post($post_data)
    {
        session_start();

        $sql = "INSERT INTO Post_Data(User_Id, Post, Date_Time) VALUES(".$_SESSION['Id'].", '".$post_data['blogpost']."', NOW())";

        if($this->conn->query($sql) === True)
        {
            echo 'Sucessfully created';
        }
        else
        {
            echo 'Couldn\'t add the post';
        }

        $data = $this->display_post($_SESSION['Id']);

        return $data;
    }

    //function to display post data of the table
    public function display_post($id = '')
    {
        $sql = "SELECT * FROM Post_Data WHERE User_Id=".$id." ORDER BY Date_Time DESC";

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

    //getting the data using post id
    public function get_data($id)
    {
        $sql = "SELECT * FROM Post_Data WHERE Id=".$id[0];

        $data = $this->conn->query($sql);
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

        $sql = "UPDATE Post_Data SET Post='".$post_data['post']."', Edit_Time=NOW() WHERE Id=".$id[0];

        $this->conn->query($sql);
        return ;
    }

}

?>
