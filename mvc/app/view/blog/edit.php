<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit</title>
  <link rel="stylesheet" type="text/css" href="/css/blog/edit.css">
</head>
<body>
    <div class='navbar'>
        <img src='../Images/logo-f.png'>
        <ul>
            <li><a href="/home/index">Home</a></li>
            <li><a href="/blog/index">Blog</a></li>
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
        <form method="POST" action=<?php echo "/blog/update/".$data['Id'];?>>
            <textarea name="post" rows=4><?php echo $data['Post'];?></textarea><br><br>
            <input type="submit" name="submit" value="Update">
            <button><a href=<?php echo "/blog/delete/".$data['Id'];?>>Delete</a>
            </button>
            <button><a href="/blog/index">Cancel</a></button>
        </form>
    </div>
</body>
</html>
