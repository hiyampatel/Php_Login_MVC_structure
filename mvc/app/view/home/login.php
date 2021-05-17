<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type='text/css' href="/css/home/login.css">
</head>
<body>
    <div class="main-login">
        <h1>Login</h1><hr><br>
        <form method="POST" action="login">
            Username: <input type="text" name="username" required><br><br>
            Password: <input type="password" name="password" required><br><br><br>
            <input type="submit" name="submit" value="Login"><br><br>
        </form>
        <?php
            if(isset($_SESSION['m']))
            {
                echo "<div class='msg'><b>".$_SESSION['m']."</b></div>";
                session_destroy();
            }
        ?>
        <div>
            <p>OR<br><br>Signup to create an account.
            <a href="/home/signup"><b>Signup</b></a></p>
            <p>Go to Home page. <b><a href="/home/index">Home</a></b></p>
        </div>
    </div>
</body>
</html>
