<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="../action/login_process.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
    
        <button name="login" type="submit" id="loginButton">Login</button>
    </form>
    
    <p>Don't have an account? <a href="../login/register.php">Register here</a></p>
</body>
</html>