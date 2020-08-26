<?php
  require_once('conn.php');

  if (empty($_POST['name'])) {
    header('Location: add_category.php?errCode=1');
    die();
  }
  $name = $_POST['name'];

  $sql = "INSERT INTO Miaohsien_categories(`name`) VALUES(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $name);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header('Location: categories.php');
?>