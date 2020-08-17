<?php
  ini_set('display_errors','1');
  error_reporting(E_ALL);

  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    header('Location: login.php?errCode=1');
    die();
  } elseif (!ctype_alnum($username)) {
    header('Location: login.php?errCode=3');
    die();
  }

  $stmt = $conn->prepare(
    "SELECT * FROM Miaohsien_users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();

  $result = $stmt->get_result();
  $account_data = $result->fetch_assoc();

  if (!$result) {
    die($conn->error);
  } 

  if (password_verify($password, $account_data['password'])) {
    $_SESSION['username'] = $username;
    header('Location: index.php');
  } else {
    header('Location: login.php?errCode=2');
  }
?>