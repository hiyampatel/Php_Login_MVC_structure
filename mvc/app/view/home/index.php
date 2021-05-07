<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <?php

        if(isset($_SESSION['submit']))
        {
            header('Location: /blog/index');
        }
        else
        {
            echo "<h1>Blogging Site</h1>";
            echo "<button><a href='/home/login'>Login</a></button><br><button><a href='/home/signup'>Sign Up</a></button>";

            //if session is set i.e. Successful login
            if(isset($_SESSION['m']))
            {
                echo "<br><br>".$_SESSION['m'];
                session_destroy();
            }
        }

    ?>
</body>
</html>
