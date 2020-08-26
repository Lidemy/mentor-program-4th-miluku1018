<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_GET['id']) ||
    empty($_GET['role'])
  ) {
    die('資料不齊全');
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $id = $_GET['id'];
  $role = $_GET['role'];

  if (!$user || $user['role'] !== 'ADMIN') {
    header('Location: admin.php');
    exit;
  }

  $stmt = $conn->prepare("UPDATE Miaohsien_users SET `role` = ? WHERE id = ?");
  $stmt->bind_param('si', $role, $id);
  $result = $stmt->execute();
  
  if (!$result) {
    die($conn->error);
  }

  header('Location: admin.php');


?>