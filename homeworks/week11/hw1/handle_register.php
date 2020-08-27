<?php
  session_start();
  require_once('conn.php');

  if (trim(empty($_POST['nickname'])) || trim(empty($_POST['username'])) || trim(empty($_POST['password']))) {
    header('Location: register.php?errCode=1');
    die();
  } elseif (!ctype_alnum($_POST['username']) || !ctype_alnum($_POST['nickname'])) {
    header('Location: register.php?errCode=3');
    die();
  }


  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
   // 把密碼轉為 hash 
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO Miaohsien_users(nickname, username, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nickname, $username, $password);
  $result = $stmt->execute();
  
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    }
    die($conn->errno);
  }
  $_SESSION['username'] = $username;
  header('Location: index.php');

  $stmt->close();
  $conn->close();
?>