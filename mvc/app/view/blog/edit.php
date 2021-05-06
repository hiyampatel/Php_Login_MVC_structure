<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="POST" action=<?php echo "/blog/update/".$data['Id'];?>>
        Post:<br>
        <textarea name="post" rows=4 cols=50><?php echo $data['Post'];?></textarea><br>
        <input type="submit" name="submit" value="Update">
        <button><a href="/blog/index">Cancel</a></button>
    </form>
</body>
</html>
