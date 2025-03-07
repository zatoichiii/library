<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Библиотека</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="i (2).webp" type="image/x-icon">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Библиотека</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="add-book.php">Добавить книгу</a>
                    </li>
                </ul>
                <form class="d-flex" action="index.php" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Поиск книг..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Найти</button>
                </form>
                <div class="navbar-nav">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="navbar-text mx-2">Пользователь (<?= htmlspecialchars($_SESSION['user']) ?>)</span>
                        <a class="nav-link" href="logout.php">Выйти</a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">Войти</a>
                        <a class="nav-link" href="register.php">Регистрация</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-4">