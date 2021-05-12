<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="/css/home/login.css">
    <script src="https://kit.fontawesome.com/e07bdb484e.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if(isset($_SESSION['m']))
        {
            echo "<div class='msg'>".$_SESSION['m']."</div>";
            session_destroy();
        }
    ?>
    <div class="main-signup">
        <h1>Sign Up </h1>
        <form method="POST" action="signup" enctype="multipart/form-data">
            Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name" required><br><br>
            Username: <input type="text" name="username" required><br><br>
            Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="email" required><br><br>
            &nbsp;&nbsp;&nbsp;Photo: &nbsp;&nbsp;<input type="file" name="file"><br><br>
            Password: <input type="password" name="password" required><br><br><br>
            <input type="submit" name="submit" value="Sign Up"><br>
        </form>
        <div>
            <p>OR</p>
            <p>Have an account.  <a href="/home/login">Login</a></p>
            <p>Go to Home page.  <a href="/home/index">Home</a></p>
        </div>
    </div>
</body>
</html>
