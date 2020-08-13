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

    $sql = sprintf("SELECT * FROM Miaohsien_users WHERE username= '%s'", $username);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row; // username, nickname
  }

?>