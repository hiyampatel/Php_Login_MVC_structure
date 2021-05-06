<?php
session_start();

if(isset($_SESSION['Id']))
{
    echo "Welcome ".$_SESSION['Username'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Blog</title>
</head>
<body>
    <h1>Add Post</h1>
    <form method="post" action="post">
        Post:<br>
        <textarea name="blogpost" rows=4 cols=50 required></textarea><br><br>
        <input type="submit" name="submit">
    </form>
    <h1>Posts</h1>
    <div>
        <?php
            if($data != 'No Posts')
            {
                while($row = $data->fetch_assoc())
                {
                    echo "<p><b>".$row['Post']."</b></p><p>".$row['Date_Time']."</p>";
                    echo "<button><a href='edit/".$row['Id']."'>Edit</a></button>";
                    if($row['Edit_Time'] != NULL)
                    {
                        echo "(Last Edited: ".$row['Edit_Time'].")<br>";
                    }
                    echo "<hr>";
                }
            }
            else
            {
                print_r($data);
            }

        ?>
    </div>
</body>
</html>
