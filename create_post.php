
create_post.php
<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $content, $image]);

    header("Location: index.php");
    exit;
}
?>


