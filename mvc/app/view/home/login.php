<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type='text/css' href="/css/login.css">
</head>
<body>
    <div class="main-login">
        <h1>Login</h1>
        <form method="POST" action="login">
            Username: <input type="text" name="username" required><br><br>
            Password: <input type="password" name="password" required><br><br><br>
            <input type="submit" name="submit" value="Login"><br><br>
        </form>
        <div>
            <p>OR<br>Signup to create an account.
            <a href="/home/signup"><b>Signup</b></a></p>
        </div>
    </div>
    <?php
        if(isset($_SESSION['m']))
        {
            echo "<div class='msg'>".$_SESSION['m']."</div>";
            session_destroy();
        }
    ?>
</body>
</html>
