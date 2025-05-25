<?php
session_start();
require 'src/components/phplogic/function.php';;

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$user = loginUser($username, $password);

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: index.php");
    exit();
} else {
    echo "<script>alert('Username atau password salah!'); window.location.href='loginpage.php';</script>";
    exit();
}
?>
