<?php

class User extends Database
{
    protected $name;
    protected $username;
    protected $email;
    protected $password;

    public function check_user($post_data)
    {
        $sql = 'SELECT * FROM Login_Detail WHERE Username = "'.$post_data['username'].'"';

        $data = $this->conn->query($sql);

        if($data->num_rows > 0)
        {
            $row = $data->fetch_assoc();
            foreach ($row as $key => $value)
            {
                $_SESSION[$key] = $value;
            }
            return True;
        }

        return False;
    }

    public function enter_data($post_data)
    {

    }
}

?>
