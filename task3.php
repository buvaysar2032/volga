<?php
$dsn = 'mysql:unix_socket=/opt/lampp/var/mysql/mysql.sock;dbname=comments;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = trim($_POST['author']);
    $content = trim($_POST['content']);

    if (!empty($author) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO comments (author, content) VALUES (:author, :content)");
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':content', $content);
        $stmt->execute();

        header("Location: task3.php");
        exit();
    } else {
        echo "Пожалуйста, заполните все поля.";
    }
}

$stmt = $pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Комментарии</title>
</head>
<body>
<h1>Список комментариев</h1>

<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?php echo htmlspecialchars($comment['author']); ?>:</strong>
                <?php echo htmlspecialchars($comment['content']); ?>
                <em>(<?php echo $comment['created_at']; ?>)</em>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Пока нет комментариев.</p>
<?php endif; ?>

<h2>Добавить новый комментарий</h2>
<form method="post" action="task3.php">
    <label for="author">Автор:</label><br>
    <input type="text" id="author" name="author" required><br><br>

    <label for="content">Комментарий:</label><br>
    <textarea id="content" name="content" required></textarea><br><br>

    <input type="submit" value="Отправить">
</form>
</body>
</html>