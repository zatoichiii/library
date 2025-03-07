<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
require_once 'config.php';
require_once 'header.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT 
            b.id,
            b.title,
            b.written,
            CONCAT(a.surname, ' ', a.name) AS author,
            g.name AS genre
          FROM book b
          JOIN author a ON b.id_author = a.id_author
          JOIN genre g ON b.id_genre = g.id_genre
          WHERE b.title LIKE :search 
             OR a.name LIKE :search 
             OR a.surname LIKE :search 
             OR g.name LIKE :search
          ORDER BY b.written DESC";

$stmt = $pdo->prepare($query);
$stmt->execute([':search' => "%$search%"]);

if ($stmt->rowCount() > 0) {
?>
    <h2 class="mb-4">Список книг</h2>
    <table class="table table-striped table-hover book-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Год</th>
                <th>Автор</th>
                <th>Жанр</th>
                <th>Взаимодействие</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $stmt->fetch()): ?>
                <tr style="cursor: pointer;" onclick="window.location='book-details.php?id=<?= $row['id'] ?>'">
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['written']) ?></td>
                    <td><?= htmlspecialchars($row['author']) ?></td>
                    <td><?= htmlspecialchars($row['genre']) ?></td>
                    <td>
                        <a href="edit-book.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Редактировать</a>
                        <a href="delete-book.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить книгу?')">Удалить</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php
} else {
    echo '<div class="alert alert-info">Нет данных о книгах</div>';
}

require_once 'footer.php';
?>