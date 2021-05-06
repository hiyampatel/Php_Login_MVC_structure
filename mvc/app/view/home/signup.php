<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up </h1>
    <form method="POST" action="signup">
        Name: <input type="text" name="name" required><br><br>
        Username: <input type="text" name="username" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="signup"><br><br>
    </form>
    <div>
        <p>OR</p>
        <p>Have an account.  <a href="/home/login">Login</a></p>
    </div>
</body>
</html>
