<?php
  require_once('conn.php');

  if (empty($_POST['title']) || empty($_POST['content'])) {
    header('Location: edit_article.php?errCode=1');
    die();
  }

  $title = $_POST['title'];
  $content = $_POST['content'];
  $category_id = $_POST['category_id'];
  $id = $_POST['id'];

  $sql = "UPDATE Miaohsien_articles SET title = ? , content = ?, category_id = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssii', $title, $content, $category_id, $id);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header('Location: admin.php');
?>