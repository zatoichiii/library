<?php
require_once 'config.php';
require_once 'header.php';

$authors = $pdo->query("SELECT * FROM author ORDER BY surname")->fetchAll();
$genres = $pdo->query("SELECT * FROM genre ORDER BY name")->fetchAll();

$errors = [];
$success = false;

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
            $stmt = $pdo->prepare("INSERT INTO book (title, written, id_author, id_genre) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $written, $id_author, $id_genre]);
            $success = true;
            $_POST = []; 
        } catch(PDOException $e) {
            $errors[] = "Ошибка при добавлении книги: " . $e->getMessage();
        }
    }
}
?>

<div class="form-section">
    <h2 class="mb-4">Добавить новую книгу</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success">Книга успешно добавлена!</div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Название книги</label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Год издания</label>
            <input type="number" class="form-control" name="written" value="<?= htmlspecialchars($_POST['written'] ?? '') ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Автор</label>
            <select class="form-select" name="id_author" required>
                <option value="">Выберите автора</option>
                <?php foreach($authors as $author): ?>
                    <option value="<?= $author['id_author'] ?>" <?= ($_POST['id_author'] ?? '') == $author['id_author'] ? 'selected' : '' ?>>
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
                    <option value="<?= $genre['id_genre'] ?>" <?= ($_POST['id_genre'] ?? '') == $genre['id_genre'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($genre['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Добавить книгу</button>
    </form>
</div>

<?php require_once 'footer.php'; ?>