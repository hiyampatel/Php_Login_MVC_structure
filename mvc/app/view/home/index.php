<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

    <?php
    if(isset($_SESSION['submit']))
    {
        echo 'Welcome '.$_SESSION['Username'];
    }
    else
    {
        session_start();
        if(isset($_SESSION['m']))
        {
            echo "<button><a href='login'>Login</a></button><br><button><a href='signup'>Sign Up</a></button>";
            echo "<br><br>".$_SESSION['m'];
        }
        else
        {
            echo "<button><a href='home/login'>Login</a></button><br><button><a href='home/signup'>Sign Up</a></button>";
        }
        session_destroy();

    }

    ?>
</body>
</html>
