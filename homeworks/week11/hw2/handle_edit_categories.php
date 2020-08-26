<?php
  require_once('conn.php');

  if (empty($_POST['name'])) {
    header('Location: edit_categories.php?errCode=1');
    die();
  }
  $name = $_POST['name'];
  $id = $_POST['id'];

  $sql = "UPDATE Miaohsien_categories SET `name` = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $name, $id);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header('Location: categories.php');
?>