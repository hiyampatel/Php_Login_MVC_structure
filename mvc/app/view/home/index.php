<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!--js cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--font awesome-->
    <script src="https://kit.fontawesome.com/e07bdb484e.js" crossorigin="anonymous"></script>

    <!--google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;800&display=swap" rel="stylesheet">

    <!--css and js files-->
    <link rel="stylesheet" type="text/css" href="/css/home/home.css">
    <script src="/js/home.js"></script>
</head>
<body>
    <div class='navbar'>
        <img src='../Images/logo-f.png'>
        <i class="fas fa-bars toggle"></i>
        <?php
            if(isset($_SESSION['submit']))
            {
                echo "<ul class=''>
                        <li><a href='' class='active'>Home</a></li>
                        <li><a href='/blog/index'>Blog</a></li>
                        <li><a href='/blog/logout'>Logout</a></li>
                      </ul>";
            }
            else
            {
                echo "<ul class=''>
                        <li><a href='' class='active'>Home</a></li>
                        <li><a href='/home/login'>Login</a></li>
                        <li><a href='/home/signup'>Sign Up</a></li>
                      </ul>";
            }
        ?>
    </div>

    <div class='aboutus'>
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
    </div>

    <div class='footer'>
        Thank you for visiting our site!
    </div>
</body>
</html>
