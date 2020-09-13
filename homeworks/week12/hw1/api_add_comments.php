<?php
  require_once('conn.php');
  // 回覆的 response格式是 json 格式的資料
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_POST['content']) || 
      empty($_POST['nickname']) || 
      empty($_POST['site_key'])) {
    $json = array(
      "ok" => false,
      "message" => "Please input missing fields"
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  $content = $_POST['content'];
  $nickname = $_POST['nickname'];
  $site_key = $_POST['site_key'];

  $sql = "INSERT INTO discussions(content, nickname, site_key) VALUES(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $content, $nickname, $site_key);
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
  // 成功, 以下為物件
  $json = array(
    "ok" => true,
    "message" => "Success"
  );
  $response = json_encode($json);
  echo $response;
?>