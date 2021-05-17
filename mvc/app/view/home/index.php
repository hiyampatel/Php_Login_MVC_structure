<?php
session_start();
include(__DIR__.'/../../core/Google.php');


$code = explode('=', $_GET['url']);
if(isset($code[1]))
{
    $token = $google_client->fetchAccessTokenWithAuthCode($code);

    //To check for error
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Getting user profile data from google
        $data = $google_service->userinfo->get();
    }
}

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
                        <li><a href='#' class='active'>Home</a></li>
                        <li><a href='/blog/index'>Blog</a></li>
                        <li><a href='/blog/post'>All Post</a></li>
                        <li><a href='/blog/add'>Add Post</a></li>
                        <li><a href='/home/aboutus'>About Us</a></li>
                        <li><a href='/blog/logout'>Logout</a></li>
                      </ul>";
            }
            else
            {
                echo "<ul class=''>
                        <li><a href='#' class='active'>Home</a></li>
                        <li><a href='/blog/post'>All Post</a></li>
                        <li><a href='/home/login'>Login</a></li>
                        <li><a href='/home/signup'>Sign Up</a></li>
                      </ul>";
            }
        ?>
    </div>

    <div class='head'>
        <div class='inner'>
        <br>
            <h1>Explore what others<br> are up to...</h1>
        </div>
    </div>

    <div class="content">
        <h1>Latest 10 Posts</h1>
        <div class="post-list">
            <?php
                if($data != 'No Posts')
                {
                    while($row = $data->fetch_assoc())
                    {
                        echo "<a href='/blog/post/".$row['Id']."'><div class='list-item'>";
                        echo "<div class='text_post'>";
                        echo "<p>@".$row['Username']."</p>";
                        echo "<h2>".$row['Title']."</h2>";
                        echo "<p>".$row['Post']."</p><p>".$row['Date_Time'];
                        if($row['Edit_Time'] != NULL)
                        {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Edited: ".$row['Edit_Time'].")";
                        }
                        echo "</p></div>
                            <div class='img_post'>";
                        if($row['Image'] == NULL)
                        {
                            echo "<img src='../../../Images/post_img.png'>";
                        }
                        else
                        {
                            echo "<img src='../../..".$row['Image']."'>";
                        }
                        echo "</div></div></a>";
                    }
                }
                else
                {
                    echo $data. "<hr>";
                }
            ?>
        </div>
    </div>

    <div class='footer'>
        Thank you for visiting our site!
    </div>
</body>
</html>
