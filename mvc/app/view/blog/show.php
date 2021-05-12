<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Blog #".$data['Id'] ?></title>

    <!--js cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--font awesome-->
    <script src="https://kit.fontawesome.com/e07bdb484e.js" crossorigin="anonymous"></script>

    <!--google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;800&display=swap" rel="stylesheet">

    <!--css and js files-->
    <link rel="stylesheet" type="text/css" href="/css/blog/blog.css">
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
            <h1>Post</h1>
        </div>
    </div>

    <div class="content-all">
        <div class="post-list-all">
            <?php
                echo "<div class='list-item'>
                    <p>Username: <b>".$data['Username']."</b></p>
                    <p>Post: <br>".$data['Post']."</p>";
                $date = explode(" ", $data['Date_Time']);
                echo "<p>Post Date: ".$date[0]."</p>";
                echo "<p>Post Time: ".$date[1]."</p>";
                if($data['Edit_Time'] != NULL)
                {
                    echo "<p>Edited: ".$data['Edit_Time']."</p>";
                }
                echo "</div>";
            ?>
        </div>
    </div>

</body>
</html>
