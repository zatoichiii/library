<?php
require_once 'config.php';
require_once 'header.php';

$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];
$success = false;

$stmt = $pdo->prepare("SELECT * FROM book WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    die('<div class="alert alert-danger">Книга не найдена</div>');
}

$authors = $pdo->query("SELECT * FROM author ORDER BY surname")->fetchAll();
$genres = $pdo->query("SELECT * FROM genre ORDER BY name")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $written = trim($_POST['written']);
    $id_author = (int)$_POST['id_author'];
    $id_genre = (int)$_POST['id_genre'];

    // Валидация
    if (empty($title)) $errors[] = 'Название книги обязательно';
    if (empty($written) || !is_numeric($written)) $errors[] = 'Год должен быть числом';
    if ($id_author <= 0) $errors[] = 'Выберите автора';
    if ($id_genre <= 0) $errors[] = 'Выберите жанр';

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("UPDATE book SET title = ?, written = ?, id_author = ?, id_genre = ? WHERE id = ?");
            $stmt->execute([$title, $written, $id_author, $id_genre, $book_id]);
            $success = true;
            
            $book['title'] = $title;
            $book['written'] = $written;
            $book['id_author'] = $id_author;
            $book['id_genre'] = $id_genre;
        } catch(PDOException $e) {
            $errors[] = "Ошибка при обновлении книги: " . $e->getMessage();
        }
    }
}
?>

<div class="form-section">
    <h2 class="mb-4">Редактировать книгу</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success">Данные книги успешно обновлены!</div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Название книги</label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Год издания</label>
            <input type="number" class="form-control" name="written" value="<?= htmlspecialchars($book['written']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Автор</label>
            <select class="form-select" name="id_author" required>
                <option value="">Выберите автора</option>
                <?php foreach($authors as $author): ?>
                    <option value="<?= $author['id_author'] ?>" <?= $book['id_author'] == $author['id_author'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($author['surname'] . ' ' . $author['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Жанр</label>
            <select class="form-select" name="id_genre" required>
                <option value="">Выберите жанр</option>
                <?php foreach($genres as $genre): ?>
                    <option value="<?= $genre['id_genre'] ?>" <?= $book['id_genre'] == $genre['id_genre'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($genre['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="book-details.php?id=<?= $book_id ?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<?php require_once 'footer.php'; ?>