<?php
require_once 'config.php';
require_once 'header.php';

$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$success = false;

$stmt = $pdo->prepare("SELECT * FROM book WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    die('<div class="alert alert-danger">Книга не найдена</div>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("DELETE FROM book WHERE id = ?");
        $stmt->execute([$book_id]);
        $success = true;
    } catch(PDOException $e) {
        die('<div class="alert alert-danger">Ошибка при удалении: ' . $e->getMessage() . '</div>');
    }
}
?>

<div class="container mt-4">
    <?php if ($success): ?>
        <div class="alert alert-success">Книга успешно удалена!</div>
        <a href="index.php" class="btn btn-secondary">Вернуться к списку</a>
    <?php else: ?>
        <h2>Удаление книги</h2>
        <div class="alert alert-warning">
            Вы уверены, что хотите удалить книгу <strong>"<?= htmlspecialchars($book['title']) ?>"</strong>?
        </div>
        
        <form method="post">
            <button type="submit" class="btn btn-danger">Да, удалить</button>
            <a href="book-details.php?id=<?= $book_id ?>" class="btn btn-secondary">Отмена</a>
        </form>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>