<?php
  require_once('conn.php');
  // 回覆的 response格式是 json 格式的資料
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_GET['site_key'])) {
    $json = array(
      "ok" => false,
      "message" => "Please add site-key in url"
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  $site_key = $_GET['site_key'];
 
  $sql = 
  "SELECT * FROM discussions WHERE site_key = ? " . 
  (empty($_GET['before']) ? "" : "and id < ?") . 
  " ORDER BY id DESC LIMIT 5";

  $stmt = $conn->prepare($sql);
  if (empty($_GET['before'])) {
    $stmt->bind_param('s', $site_key);
  } else {
    $stmt->bind_param('si', $site_key, $_GET['before']);
  }
  $result = $stmt->execute();

  if (!$result){
    $json = array(
      "ok" => false,
      "message" => $conn->error
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  $result = $stmt->get_result();
  $discussions = array();
  while ($row = $result->fetch_assoc()) {
    array_push($discussions, array(
      "id" => $row['id'],
      "content" => $row['content'],
      "nickname" => $row['nickname'],
      "created_at" => $row['created_at']
    ));
  };

  // 成功, 以下為物件
  $json = array(
    "ok" => true,
    "discussions" => $discussions
  );
  $response = json_encode($json);
  echo $response;
?>
