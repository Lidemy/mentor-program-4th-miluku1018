<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['nickname'])) {
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }

  $username = $_SESSION['username'];
  $nickname = $_POST['nickname'];

  $stmt = $conn->prepare("UPDATE Miaohsien_users SET nickname = ? WHERE username = ?");
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();
  
  if (!$result) {
    die($conn->error);
  }

  header('Location: index.php');
?>