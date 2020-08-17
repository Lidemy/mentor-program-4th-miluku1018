<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $sql = sprintf("SELECT * FROM Miaohsien_comments ORDER BY created_at DESC");
  $result = $conn->query($sql);
  if (!$result) {
    die('Error:' . $conn->error);
  }
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
        <h1>留言板</h1>
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
          <a href="register.php">註冊</a>
          <a href="login.php">登入</a>
        <?php } else { ?>
          <h3 class='username'>您好，<?php echo $username ?></h3>
          <a href="logout.php">登出</a>
        <?php } ?>  
      </div>
    </div>
    <form method="POST" action="handle_add_post.php">
      <textarea name="content" cols="30" rows="5" placeholder="請輸入留言"></textarea>
      <?php if($username) { ?>
        <input type="submit" value="送出">
        <?php } else { ?>  
          <h3 class='login-warning'>請先登入帳號，方能留言</h3>
        <?php } ?>
    </form>
    <section class="comments">
      <?php while ($row = $result->fetch_assoc()) {?>
        <?php $content = htmlspecialchars($row['content'], ENT_QUOTES, 'utf-8');?>
        <div class="card">
          <div class="avatar"></div>
          <div class="desc">
            <div class="user-info">
              <div class="nickname"><?php echo $row['nickname'] ?></div>
            <div class="comment-time"><?php echo $row['created_at'] ?></div>
          </div>
            <div class="messages"><?php echo $content ?></div>
          </div>
        </div>
      <?php } ?>
    </section>
  </div>
</body>
</html>