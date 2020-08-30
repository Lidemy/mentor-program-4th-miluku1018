<?php
  require_once('conn.php');

  if (empty($_POST['title']) || empty($_POST['content'])) {
    header('Location: add_article.php?errCode=1');
    die();
  }
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category_id = $_POST['category_id'];

  $sql = "INSERT INTO Miaohsien_articles(title, content, category_id) VALUES(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssi', $title, $content, $category_id);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header('Location: admin.php');
?>