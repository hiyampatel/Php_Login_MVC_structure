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
}

?>
