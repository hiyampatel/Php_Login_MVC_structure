<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['Username'] ?></title>

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
        <img src='/Images/logo-f.png'>
        <i class="fas fa-bars toggle"></i>
        <?php
            if(isset($_SESSION['submit']))
            {
                echo "<ul class=''>
                        <li><a href='/home/index' >Home</a></li>
                        <li><a href='/blog/index'>Blog</a></li>
                        <li><a href='/blog/post' >All Post</a></li>
                        <li><a href='/blog/add'>Add Post</a></li>
                        <li><a href='/home/aboutus'>About Us</a></li>
                        <li><a href='/blog/logout'>Logout</a></li>
                      </ul>";
            }
            else
            {
                echo "<ul class=''>
                        <li><a href='/home/index' >Home</a></li>
                        <li><a href='/blog/post'>All Post</a></li>
                        <li><a href='/home/login'>Login</a></li>
                        <li><a href='/home/signup'>Sign Up</a></li>
                      </ul>";
            }
        ?>
    </div>
    <div class='head1'>
        <div class='inner'>
        <br>
            <h1>Update your Profile</h1>
        </div>
    </div>

    <div class="content">
        <div class="user">
            <form method="POST" action="userinfo" enctype="multipart/form-data">
                Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name" value="<?php echo $_SESSION['Name']?>" required><br><br>
                Username: <input type="text" name="username" value="<?php echo $_SESSION['Username']?>" required><br><br>
                Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="email" value="<?php echo $_SESSION['Email']?>" required><br><br>
                Profile Picture:  <input type="file" name="file">
                <?php
                    if($_SESSION['Photo']==NULL)
                    {
                        echo "<div class='user-pic'><img src='../../../Images/profile.png'></div>";
                    }
                    else
                    {
                        echo '<div class="user-pic"><img src="../../..'.$_SESSION['Photo'].'"></div>';
                    }
                ?><br>
                <input type="submit" name="submit" value="Change"><br>
            </form>
            <?php
                if(isset($_SESSION['m']))
                {
                    echo $_SESSION['m'];
                    unset($_SESSION['m']);
                }
            ?>
        </div>
    </div>


</body>
</html>
