<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $content = $_POST['content'];

  if (empty($content)) {
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }
  $user = getUserFromUsername($_SESSION['username']);
  $nickname = $user['nickname'];

  $stmt = $conn->prepare(
    "INSERT INTO Miaohsien_comments(content, nickname) VALUES( ?, ?)");
  $stmt->bind_param('ss', $content, $nickname);
  
  $result = $stmt->execute();
  
  if ($result) {
    header('Location: ./index.php');
  } else {
    echo 'Fail:' . $conn->error;
  }
  
?>