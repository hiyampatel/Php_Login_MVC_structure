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

        //password length
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

        $sql = 'INSERT INTO Login_Detail(Name, Username, Email, Password) VALUES (?,?,?,?)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $post_data['name'], $post_data['username'], $post_data['email'], $post_data['password']);
        $stmt->execute();

        if($stmt->execute() === True)
        {
            $_SESSION['m'] = 'Sucessfully created account.';
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

}

?>
