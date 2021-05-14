<?php

//Class to alter data for User model
class User extends Database
{
    //Check if User data is present or not
    public function check_user($post_data)
    {
        session_start();
        $sql = 'SELECT * FROM Login_Detail WHERE Username = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $post_data['username']);
        $stmt->execute();
        $data = $stmt->get_result();

        if($data->num_rows > 0)
        {
            $row = $data->fetch_assoc();

            if((($post_data['submit'] == 'Login') and ($post_data['password'] == $row['Password']) and ($post_data['username'] == $row['Username'])) or ($post_data['submit'] == 'Sign Up'))
            {
                foreach ($row as $key => $value)
                {
                    $_SESSION[$key] = $value;
                }
                $_SESSION['submit'] = $post_data['submit'];
                return 'T';
            }
            else
            {
                $_SESSION['m'] = 'Not valid password or username';
                return 'F';
            }
        }
        $_SESSION['m'] = 'User does not exist!';
        return 'F';
    }


    //Enters the User data into Login_Detail table
    public function enter_data($post_data)
    {
        //validating name
        $name = trim($post_data['name']);
        $name = stripslashes($name);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
        {
            $_SESSION['m'] = "Only letters and white space allowed in name";
            return 'F';
        }

        //password length and constarins
        if((strlen($post_data['password'])<8))
        {
            $_SESSION['m'] = 'Password must be more than 8 characters';
            return 'F';
        }
        if((strlen($post_data['password'])>16))
        {
            $_SESSION['m'] = 'Password must be less than 16 characters';
            return 'F';
        }
        if(!preg_match("/(?=\S*[\d])/", $post_data['password']))
        {
            $_SESSION['m'] = 'Password must have 1 digit.';
            return 'F';
        }
        if(!preg_match("/(?=\S*[a-z])/", $post_data['password']))
        {
            $_SESSION['m'] = 'Password must have 1 lowercase letter.';
            return 'F';
        }
        if(!preg_match("/(?=\S*[A-Z])/", $post_data['password']))
        {
            $_SESSION['m'] = 'Password must have 1 uppercase letter.';
            return 'F';
        }

        //email validation
        $email = trim($post_data['email']);
        $email = stripslashes($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['m'] = "Invalid email format";
            return 'F';
        }

        if($this->email_validate($email) == 'False')
        {
            $_SESSION['m'] = 'Invalid email';
            return 'F';
        }

        //check for image and upload it to Images/Profile folder
        $position = 'Images/' .  basename($_FILES["file"]["name"]);
        $type = $_FILES["file"]["type"];
        $img_path = '/Images/Profile/'.$post_data['username'].'.jpg';
        if(!empty($_FILES["file"]))
        {
            if(preg_match("/Image/i", $type) == 0)
            {
                $_SESSION['m'] = 'Not an image file!';
                return 'F';
            }
            else
            {
                if (copy($_FILES["file"]["tmp_name"], __DIR__.'/../../public'.$img_path)===False)
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



        $sql = 'INSERT INTO Login_Detail(Name, Username, Email, Password, Photo) VALUES (?,?,?,?,?)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $post_data['name'], $post_data['username'], $post_data['email'], $post_data['password'], $img_path);

        if($stmt->execute() === True)
        {
            unset($_SESSION['m']);
            return 'T';
        }
        else
        {
            $_SESSION['m'] = "Couldn't create account!";
            return 'F';
        }

    }

    //Check if email id is valid or not using mailboxlayer api
    private function email_validate($email)
    {
        // set API Access Key
        $access_key = 'c04ea3282ac1e7b313328f517f79fa6d';

        // set email address
        $email_address = $email;

        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email_address.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $validationResult = json_decode($json, true);

        if($validationResult['smtp_check'] != '1')
        {
            return 'False';
        }
        return 'True';

    }

    //display data onto home page
    public function home_data()
    {
        $sql = "SELECT P.Id, L.Username, P.Post, P.Date_Time, P.Edit_Time FROM Post_Data AS P, Login_Detail AS L WHERE P.User_Id = L.Id ORDER BY P.Date_Time DESC LIMIT 10";

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

    //For updating the user info or profile photo
    public function user_data($post_data)
    {
        session_start();
        $sql = "UPDATE Login_Detail SET Name=?, Username=?, Email=? WHERE Username=?";

        //setting file path and changing the profile photo
        //deleting the old photo if exist by same name
        //saving new photo with same name
        $type = $_FILES["file"]["type"];
        $img_path = '/Images/Profile/'.$post_data['username'].'.jpg';
        if($_FILES['file']['type'] != NULL)
        {
            if(preg_match("/Image/i", $type) == 0)
            {
                $_SESSION['m'] = 'Not an image file!';
                return 'F';
            }
            else
            {
                //if photo with same name exist then delete it
                if (file_exists(__DIR__.'/../../public'.$img_path))
                {
                    unlink(__DIR__.'/../../public'.$img_path);
                }
                //if old photo with old username exist
                if (file_exists(__DIR__.'/../../public'.$_SESSION['Photo']))
                {
                    unlink(__DIR__.'/../../public'.$img_path);
                    $_SESSION['Photo'] = $img_path;
                }

                if (move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__.'/../../public'.$img_path)===False)
                {
                    $_SESSION['m'] = 'Could not upload profile image. Try again.';
                    return 'F';
                }
            }
            $_SESSION['Name'] = $post_data['name'];
            $_SESSION['Username'] = $post_data['username'];
            $_SESSION['Email'] = $post_data['email'];

        }

        //updating the new user info into database
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $post_data['name'], $post_data['username'], $post_data['email'], $post_data['username']);
        $stmt->execute();
        return 'T';
    }

}

?>
