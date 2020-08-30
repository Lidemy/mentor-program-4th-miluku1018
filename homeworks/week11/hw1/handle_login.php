<?php
  session_start();
  require_once('conn.php');

  if (empty(trim($_POST['username'])) || trim(empty($_POST['password']))) {
    header('Location: login.php?errCode=1');
    die();
  } elseif  (!ctype_alnum($_POST['username'])) {
    header('Location: login.php?errCode=3');
    die();
  }  

  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM Miaohsien_users WHERE username = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();
  
  if (!$result) {
    die($conn->error);
  } 
  // 查不到使用者
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    header('Location: login.php?errCode=2');
    exit();
  } 
  // 有查到使用者
  
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    // 登入成功
    /*
      1. 產生 session id (token)
      2. 把 username 寫入檔案
      3. set-cookie: session-id
    */
    $_SESSION['username'] = $username;
    header('Location: index.php');
  }else {
    header('Location: login.php?errCode=2');
  }
?>