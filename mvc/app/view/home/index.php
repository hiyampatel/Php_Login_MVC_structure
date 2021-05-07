<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
</head>
<body>
    <?php

        if(isset($_SESSION['submit']))
        {
            header('Location: /blog/index');
        }
        else
        {
            echo "<div class='navbar'>
                    <img src='/Images/logo-f.png'>";
            if(isset($_SESSION['Username']))
            {
                echo "<ul><li><a href='/home/login'>Login</a></li><li><a href='/home/signup'>Sign Up</a></li></ul>";
            }
            else
            {
                echo "<ul><li><a href='/home/login'>Login</a></li><li><a href='/home/signup'>Sign Up</a></li></ul>";
            }
            echo "</div>";
            echo "<div class='aboutus'>
                    <div class='head'>
                        <div class='inner'>
                        <br>
                            <h1>Create & Save your <br>Ideas & Thought</h1>
                        </div>
                    </div>
                    <div class='main'>
                        <h1 class='aboutus-head'>About Us</h1>
                        <p>Blog is a site that allows you to save your personal ideas and thoughts into one place. You can post them onto your personal account. Fast and easy way to create store and see the post you created.</p><br>
                    </div>
                  </div>";
            echo "<div class='footer'>
                    Thank you for visiting our site!
                  </div>";

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
