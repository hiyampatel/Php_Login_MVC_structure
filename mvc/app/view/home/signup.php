<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="/css/home/login.css">
</head>
<body>
    <div class="main-signup">
        <h1>Sign Up </h1>
        <form method="POST" action="signup">
            Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name" required><br><br>
            Username: <input type="text" name="username" required><br><br>
            Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="email" required><br><br>
            Password: <input type="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Sign Up"><br><br>
        </form>
        <div>
            <p>OR</p>
            <p>Have an account.  <a href="/home/login">Login</a></p>
        </div>
    </div><br><br>
    <?php
        if(isset($_SESSION['m']))
        {
            echo "<div class='msg'>".$_SESSION['m']."</div>";
            session_destroy();
        }
    ?>
</body>
</html>
