<?php
  session_start();
  require_once('conn.php');

  if (empty($_POST['username']) || empty($_POST['password'])) {
    header('Location: login.php?errCode=1');
    die();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM Miaohsien_users WHERE username = ?");
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();

  // 登入失敗
  if (!$result) {
    die('Error:' . $conn->error);
  }

  $result = $stmt->get_result();

  // 有找到使用者
  if ($result->num_rows === 0) {
    header('Location: login.php?errCode=2');
    exit;
  }

  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    // 登入成功
    $_SESSION['username'] = $username;
    header('Location: index.php'); 
  } else {
    header('Location: login.php?errCode=2');
  }

?>