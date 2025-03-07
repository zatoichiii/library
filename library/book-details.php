<?php
require_once 'config.php';
require_once 'header.php';

$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Получаем основную информацию о книге из БД
$stmt = $pdo->prepare("SELECT 
        b.*,
        CONCAT(a.surname, ' ', a.name) AS author,
        g.name AS genre
    FROM book b
    JOIN author a ON b.id_author = a.id_author
    JOIN genre g ON b.id_genre = g.id_genre
    WHERE b.id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    die('<div class="alert alert-danger">Книга не найдена</div>');
}

function getBookDetails($title, $author) {
    $api_url = 'https://www.googleapis.com/books/v1/volumes?q=';
    $query = urlencode("intitle:$title+inauthor:$author");
    $url = $api_url . $query . '&langRestrict=ru&maxResults=1';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
    
    if (empty($data['items'])) return [
        'description' => 'Описание отсутствует',
        'image' => 'https://via.placeholder.com/200x300?text=No+Cover',
        'pages' => 'неизвестно',
        'rating' => 'нет оценок'
    ];
    
    $volume = $data['items'][0]['volumeInfo'];
    return [
        'description' => $volume['description'] ?? 'Описание отсутствует',
        'image' => $volume['imageLinks']['thumbnail'] ?? 'https://via.placeholder.com/200x300?text=No+Cover',
        'pages' => $volume['pageCount'] ?? 'неизвестно',
        'rating' => $volume['averageRating'] ?? 'нет оценок'
    ];
}

$details = getBookDetails($book['title'], $book['author']);

?>
<div class="book-details">
    <div class="row">
        <div class="col-md-4">
            <img src="<?= $details['image'] ?>" 
                 alt="Обложка книги <?= htmlspecialchars($book['title']) ?>" 
                 class="img-fluid mb-3"
                 style="width: 250px;">
        </div>
        <div class="col-md-8">
            <h1><?= htmlspecialchars($book['title'] ?? '') ?></h1>
            <h3 class="text-muted"><?= htmlspecialchars($book['author'] ?? '') ?></h3>
            
            <div class="book-info mt-4">
                <p><strong>Год издания:</strong> <?= htmlspecialchars($book['written'] ?? '') ?></p>
                <p><strong>Жанр:</strong> <?= htmlspecialchars($book['genre'] ?? '') ?></p>
                <p><strong>Количество страниц:</strong> <?= htmlspecialchars($details['pages'] ?? 'неизвестно') ?></p>
                <p><strong>Рейтинг:</strong> <?= htmlspecialchars($details['rating'] ?? 'нет оценок') ?></p>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <h4>Описание</h4>
        <p class="text-justify"><?= nl2br(htmlspecialchars($details['description'] ?? 'Описание временно отсутствует')) ?></p>
        </div>
    
        <div class="mt-4">
            <a href="edit-book.php?id=<?= $book_id ?>" class="btn btn-warning">Редактировать</a>
            <a href="delete-book.php?id=<?= $book_id ?>" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
            <a href="index.php" class="btn btn-secondary">← Назад к списку</a>
        </div>
</div>

<?php require_once 'footer.php'; ?>