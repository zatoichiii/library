<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="styleforreg.css">
</head>
<body>
    <div class="form-container">
        <h2>Регистрация</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>
        <form id="registerForm" action="save_user.php" method="POST">
            <div class="form-group">
                <input type="text" name="login" placeholder="Логин" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>
            <button type="submit" name="submit">Зарегистрироваться</button>
        </form>
        <div class="toggle-form">
            Уже есть аккаунт? <a href="login.php">Войти</a>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const login = document.getElementsByName('login')[0].value;
            const password = document.getElementsByName('password')[0].value;
            
            if (login.length < 4) {
                alert('Логин должен содержать минимум 4 символа');
                e.preventDefault();
            }
            
            if (password.length < 6) {
                alert('Пароль должен содержать минимум 6 символов');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>