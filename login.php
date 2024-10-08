<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php'); 
    exit();
}

$username = "aidil";
$password = "1234";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $ambil_username = $_POST['username'];
    $ambil_password = $_POST['password'];

    if ($ambil_username == $username && $ambil_password == $password) {
        $_SESSION['username'] = $ambil_username;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body> 
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
