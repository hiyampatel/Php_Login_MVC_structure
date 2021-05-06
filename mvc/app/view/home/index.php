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
        //if session is set i.e. Successful login
        if(isset($_SESSION['m']))
        {
            echo "<button><a href='login'>Login</a></button><br><button><a href='signup'>Sign Up</a></button>";
            echo "<br><br>".$_SESSION['m'];
            session_destroy();
        }
        else
        {
            echo "<button><a href='home/login'>Login</a></button><br><button><a href='home/signup'>Sign Up</a></button>";
        }

    ?>
</body>
</html>
