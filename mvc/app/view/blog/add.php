<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>

    <!--js cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--font awesome-->
    <script src="https://kit.fontawesome.com/e07bdb484e.js" crossorigin="anonymous"></script>

    <!--google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;800&display=swap" rel="stylesheet">

    <!--css and js files-->
    <link rel="stylesheet" type="text/css" href="/css/blog/add.css">
    <script src="/js/home.js"></script>

</head>
<body>
    <div class='navbar'>
        <img src='/Images/logo-f.png'>
        <i class="fas fa-bars toggle"></i>
        <ul class=''>
            <li><a href="/home/index">Home</a></li>
            <li><a href="/home/aboutus">About Us</a></li>
            <li><a href="/blog/index">Blog</a></li>
            <li><a href="" class="active">Add Post</a></li>
            <li><a href="/blog/logout">Logout</a></li>
        </ul>
    </div>
    <div class='head'>
        <div class='inner'>
        <br>
            <h1>Creating new Posts</h1>
        </div>
    </div>
    <div class="content">
        <div class="add-form">
            <form method="post" action="add_post">
                Add Post:<br>
                <textarea name="blogpost" rows=4 required></textarea><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
