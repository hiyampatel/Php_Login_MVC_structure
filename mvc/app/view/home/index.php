<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

    <?php
    if(isset($_SESSION['submit']))
    {
        echo 'Welcome '.$_SESSION['username'];
    }
    else
    {
        echo "<button><a href='home/login'>Login</a></button><br><button><a href='home/signup'>Sign Up</a></button>";
        echo "<br><br>".$data['m'];
    }

    ?>
</body>
</html>
