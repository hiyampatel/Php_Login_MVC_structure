<?php

//Class to alter and retrive data from post modle
class Post extends Database
{

    //function to add new data and display it with other data
    public function add_post($post_data)
    {
        session_start();

        $img_path = '';
        if($_FILES['file']['type'] != NULL)
        {
            $type = $_FILES["file"]["type"];
            $ext = explode('.', $_FILES["file"]['name']);
            $img_path = '/Images/Posts/'.$_SESSION['Username']."_".$_SESSION['cnt_img'].'.'.$ext[1];
            if(preg_match("/Image/i", $type) == 0)
            {
                $_SESSION['m'] = 'Not an image file!';
                return 'F';
            }
            else
            {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__.'/../../public'.$img_path)===False)
                {
                    $_SESSION['m'] = 'Could not upload profile image. Try again.';
                    return 'F';
                }
            }
        }
        else
        {
            $img_path = NULL;
        }
        $_SESSION['cnt_img']+=1;

        $sql = "INSERT INTO Post_Data(User_Id, Post, Date_Time, Title, Image) VALUES(?,?, NOW(),?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isss", $_SESSION['Id'], $post_data['blogpost'], $post_data['title'], $img_path);
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
        $sql = "SELECT P.Id, L.Username, P.Post, P.Date_Time, P.Edit_Time, P.Title, P.Image FROM Post_Data AS P, Login_Detail AS L WHERE P.User_Id = L.Id AND P.Id=?";

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

        session_start();

        $img_path = '';
        if($_FILES['file']['type'] != NULL)
        {
            $sql = "SELECT Image FROM Post_Data WHERE Id=?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id[0]);
            $stmt->execute();
            $data = $stmt->get_result();
            $row = $data->fetch_assoc();

            if($row['Image'] == NULL)
            {
                $ext = explode('.', $_FILES["file"]['name']);
                $img_path = '/Images/Posts/'.$_SESSION['Username']."_".$_SESSION['cnt_img'].'.'.$ext[1];
            }
            else
            {
                $img_path = $row['Image'];
            }

            $type = $_FILES["file"]["type"];
            if(preg_match("/Image/i", $type) == 0)
            {
                $_SESSION['m'] = 'Not an image file!';
                return 'F';
            }
            else
            {
                if (file_exists(__DIR__.'/../../public'.$img_path))
                {
                    unlink(__DIR__.'/../../public'.$img_path);
                }
                if (move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__.'/../../public'.$img_path)===False)
                {
                    $_SESSION['m'] = 'Could not upload profile image. Try again.';
                    return 'F';
                }
            }
        }

        $sql = "UPDATE Post_Data SET Post=?, Edit_Time=NOW(), Title=? WHERE Id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $post_data['post'], $post_data['title'], $id[0]);
        $stmt->execute();
        //return ;
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
        $sql = "SELECT P.Id, L.Username, P.Post, P.Date_Time, P.Edit_Time, P.Title, P.Image FROM Post_Data AS P, Login_Detail AS L WHERE P.User_Id = L.Id ORDER BY P.Date_Time DESC";

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
