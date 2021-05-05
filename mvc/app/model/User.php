<?php

//Class to alter data for User model
class User extends Database
{
    protected $name;
    protected $username;
    protected $email;
    protected $password;

    //Check if User data is present or not
    public function check_user($post_data)
    {
        $sql = 'SELECT * FROM Login_Detail WHERE Username = "'.$post_data['username'].'"';

        $data = $this->conn->query($sql);

        if($data->num_rows > 0)
        {
            $row = $data->fetch_assoc();

            if((($post_data['submit'] == 'login') and ($post_data['password'] == $row['Password']) and ($post_data['username'] == $row['Username'])) or ($post_data['submit'] == 'signup'))
            {

                foreach ($row as $key => $value)
                {
                    $_SESSION[$key] = $value;
                }
                $_SESSION['submit'] = $post_data['submit'];
                return 'TRUE';
            }
            else
            {
                $_SESSION['m'] = 'Not valid password or username';
                return 'False';
            }
        }
        $_SESSION['m'] = 'User does not exist!';
        return 'False';
    }


    //Enters the User data into Login_Detail table
    public function enter_data($post_data)
    {
        $sql = 'INSERT INTO Login_Detail(Name, Username, Email, Password) VALUES ("'.$post_data['name'].'", "'.$post_data['username'].'", "'.$post_data['email'].'", "'.$post_data['password'].'")';

        if($this->conn->query($sql) === True)
        {
            $_SESSION['m'] = 'Sucessfully created account.';
            return 'TRUE';
        }
        else
        {
            $_SESSION['m'] = "Couldn't create account!";
            return 'TRUE';
        }

    }
}

?>
