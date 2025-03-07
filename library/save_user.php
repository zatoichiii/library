
<?php
session_start();
include 'config.php'; 

if (isset($_POST['submit'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    

    $stmt = $pdo->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->execute([$login]);
    
    if ($stmt->rowCount() > 0) {
        header("Location: register.php?error=Пользователь с таким логином уже существует");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
    
    if ($stmt->execute([$login, $hashedPassword])) {
        $_SESSION['user'] = $login;
        header("Location: index.php");
        exit();
    } else {
        header("Location: register.php?error=Ошибка при регистрации");
        exit();
    }
}