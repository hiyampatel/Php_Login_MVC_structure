<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="/css/home/login.css">
    <script src="https://kit.fontawesome.com/e07bdb484e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-signup">
        <h1>Sign Up </h1><hr><br>
        <form method="POST" action="signup" enctype="multipart/form-data">
            Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name" required><span class="red">*</span><br><br>
            Username: <input type="text" name="username" required><span class="red">*</span><br><br>
            Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="email" required><span class="red">*</span><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Profile Pic: <input type="file" name="file"><br><br>
            Password: <input type="password" name="password" required><span class="red">*</span>
            <div class="password-require">
                &#9679; between 8 to 16 characters<br>
                &#9679; atleast 1 uppercase letter<br>
                &#9679; atleast 1 lowercase letter<br>
                &#9679; atleast 1 digit
            </div>
            <br>
            <input type="submit" name="submit" value="Sign Up"><br>
        </form><br>
        <?php
            if(isset($_SESSION['m']))
            {
                echo "<div class='msg'><b>".$_SESSION['m']."</b></div>";
                session_destroy();
            }
        ?>
        <div>
            <p>OR</p>
            <p>Have an account. <b><a href="/home/login">Login</a></b></p>
            <p>Go to Home page. <b><a href="/home/index">Home</a></b></p>
        </div>
    </div>
</body>
</html>
