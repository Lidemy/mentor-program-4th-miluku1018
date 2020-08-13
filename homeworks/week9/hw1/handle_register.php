<?php
  require_once('conn.php');

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($nickname) || empty($username) || empty($password)) {
    header('Location: register.php?errCode=1');
    die();
  } elseif (!ctype_alnum($username)) {
    header('Location: register.php?errCode=3');
    die();
  }

   // 把密碼轉為 hash 
  $hash_pw = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO Miaohsien_users(nickname, username, `password`) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nickname, $username, $hash_pw);
  $result = $stmt->execute();
  
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    }
    die($conn->errno);
  }
  header('Location: login.php');

  $stmt->close();
  $conn->close();
?>