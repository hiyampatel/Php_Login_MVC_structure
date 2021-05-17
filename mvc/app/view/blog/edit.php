<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

    <!--js cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--font awesome-->
    <script src="https://kit.fontawesome.com/e07bdb484e.js" crossorigin="anonymous"></script>

    <!--ck editor-->
    <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>

    <!--google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;800&display=swap" rel="stylesheet">

    <!--css and js files-->
    <link rel="stylesheet" type="text/css" href="/css/blog/edit.css">
    <script src="/js/home.js"></script>

</head>
<body>
    <div class='navbar'>
        <img src='../../Images/logo-f.png'>
        <i class="fas fa-bars toggle"></i>
        <ul>
            <li><a href="/home/index">Home</a></li>
            <li><a href="/blog/index">Blog</a></li>
            <li><a href="/blog/post">All Post</a></li>
            <li><a href="/blog/add">Add Post</a></li>
            <li><a href="/home/aboutus">About Us</a></li>
            <li><a href="/blog/logout">Logout</a></li>
        </ul>
    </div>
    <div class='head'>
        <div class='inner'>
        <br>
            <h1>Editing Posts</h1>
        </div>
    </div>

    <div class="content">
        <form method="POST" enctype='multipart/form-data' action=<?php echo "/blog/update/".$data['Id'];?>>
            <b>Edit Post Title</b>: <span class="red">*</span>&nbsp;<input type="text" name="title" value='<?php echo $data["Title"];?>' required><br><br>
            <b>Edit Content</b>: <span class="red">*</span><br>
            <textarea id='post' name="post" rows=4><?php echo $data['Post'];?></textarea><br><br>
            <b>Edit Image</b>: <input type="file" name="file"><br><br>
            <?php
                if($data["Image"] == NULL)
                {
                    $image = '/Images/post_img.png';
                }
                else
                {
                    $image = $data['Image'];
                }
            ?>
            <img src='<?php echo "../../..".$image;?>' width='200px' height='200px'><br>
            <input type="submit" name="submit" value="Update">
            <button><a onclick='return confirm("Are you sure you want to delete the post?")' href=<?php echo "/blog/delete/".$data['Id'];?>>Delete</a>
            </button>
            <button><a href="/blog/index">Cancel</a></button>
            <script>
                CKEDITOR.replace('post',{
                    filebrowserUploadUrl: '/vendor/ckeditor/ckeditor/ck_upload.php',
                    filebrowserUploadMethod: 'form'
                });
            </script>
        </form>

    </div>
</body>
</html>
