<?php
  function generateTokens() {
    $s = '';
    for ($i=0; $i < 16; $i++) { 
      $s .= chr(rand(65,90));
    }
    return $s;
  }
  function getUserFromUsername($username) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM Miaohsien_users WHERE username= ?");
    $stmt->bind_param("s", $username);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row; // username, nickname, role
  }
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
  // $action:  update, delete, create
  function hasPermission($user, $action, $comment) {
    if ($user["role"] === "ADMIN") {
      return true;
    }
    if ($user["role"] === "NORMAL") {
      if ($action === 'create') return true;
      return $comment['username'] === $user["username"];
    }
    if ($user["role"] === "BANNED") {
      return $action !== 'create';
    }
  } 
  function isAdmin($user) {
    return $user["role"] === "ADMIN";
  }
?>