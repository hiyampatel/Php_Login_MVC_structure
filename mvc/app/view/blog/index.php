<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/blog/blog.css">
</head>
<body>
    <div class='navbar'>
        <img src='/Images/logo-f.png'>
        <ul>
            <li><a href="/home/index">Home</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="/blog/logout">Logout</a></li>
        </ul>
    </div>
    <div class='head'>
        <div class='inner'>
        <br>
            <h1>Creating & Viewing<br> Posts</h1>
        </div>
    </div>

    <div class="content">
        <div class="post-list">
            <?php
                if($data != 'No Posts')
                {
                    while($row = $data->fetch_assoc())
                    {
                        echo "<div class='list-item'>";
                        $date = $row['Date_Time'];
                        echo "<p><b>".$row['Post']."</b></p><p>".$row['Date_Time']."</p>";
                        echo "<button><a href='edit/".$row['Id']."'>Edit</a></button>";
                        echo "<button><a href='/blog/delete/".$row['Id']."'>Delete</a></button>";
                        if($row['Edit_Time'] != NULL)
                        {
                            echo "(Edited: ".$row['Edit_Time'].")<br>";
                        }
                        echo "</div>";
                    }
                }
                else
                {
                    echo $data. "<hr>";
                }
            ?>
        </div>
    </div>
    <div class="bottom">
        <div class="add-form">
            <form method="post" action="post">
                Add Post:<br>
                <textarea name="blogpost" rows=2 required></textarea><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
