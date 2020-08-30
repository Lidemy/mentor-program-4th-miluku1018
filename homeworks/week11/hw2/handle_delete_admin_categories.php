<?php
  require_once('conn.php');

  $id = $_GET['id'];
  $is_deleted = $_POST['is_deleted'];

  $sql = "UPDATE Miaohsien_categories SET is_deleted = 1 WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header('Location: admin_categories.php');
?>