<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $stmt = $conn->prepare("SELECT * FROM Miaohsien_users ORDER BY created_at DESC");
  $result = $stmt->execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }

  $result = $stmt->get_result();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normalize.css">
  <title>MyBoard</title>
</head>
<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
  </header>
  <div class="container">
    <div class="nav">
      <div class="title">
        <h1>後台留言板</h1>
        <a href="index.php">前台留言板</a>
        <?php
          if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            $msg = 'Error';
            if ($code === '1') {
              $msg = '資料不齊全';
            }
            echo '<h2 class="error">錯誤：'. $msg .'</h2>';
          }
        ?>
      </div>
      <div class="link">
        <?php if(!$username) { ?>
          <a href="login.php">登入</a>
        <?php } else { ?>
          <h3 class='username'>您好，<?php echo $user['nickname'] ?> </h3>
          <a href="logout.php">登出</a>
        <?php } ?>  
      </div>
    </div>
    <section class="user-list">
      <table border="2" width="500">
        <caption>使用者列表</caption>
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Role</th>
            <th scope="col">Nickname</th>
            <th scope="col">Username</th>
            <th scope="col">調整身份</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) {?>
            <tr>
              <td><?php echo escape($row['id']) ?></td>
              <td><?php echo escape($row['role']) ?></td>
              <td><?php echo escape($row['nickname']) ?></td>
              <td><?php echo escape($row['username']) ?></td>
              <td>
                <a href="handle_update_role.php?role=ADMIN&id=<?php echo escape($row['id']); ?>">管理員</a>
                <a href="handle_update_role.php?role=NORMAL&id=<?php echo escape($row['id']); ?>">使用者</a>
                <a href="handle_update_role.php?role=BANNED&id=<?php echo escape($row['id']); ?>">停權</a>
              </td>
            </tr>
          <?php } ?>  
        </tbody>
      </table>
    </section>
  </div>
</body>
</html>