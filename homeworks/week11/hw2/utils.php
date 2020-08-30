<?php
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
  function getUserFromUsername($username) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM Miaohsien_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
  }

?>