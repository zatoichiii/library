<?php
session_start();
include 'config.php'; 

if (isset($_POST['submit'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]); 
    $user = $stmt->fetch();  

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['login'];
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=Неверный логин или пароль");
        exit();
    }
}
?>