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
            $msg = "Error";
            if ($code === '1') {
              $msg = '資料不齊全';
            }elseif ($code === '2') {
              $msg = '帳號已被註冊';
            }elseif ($code === '3') {
              $msg = '帳號與暱稱必需為英文或數字';
            }
            echo '<h2 class="error">錯誤：'. $msg .'</h2>';
          }
        ?>
      </div>
      <div class="link">
        <a href="index.php">回留言板</a>
        <a href="login.php">登入</a>
      </div>
    </div>
    <h3>註冊帳號</h3>
    <form method="POST" action="handle_register.php">
      <div class="form-desc">
        <div class="nickname">暱稱：<input type="text" name="nickname"></div>
        <div class="username">帳號：<input type="text" name="username"></div>
        <div class="password">密碼：<input type="password" name="password"></div>
        <input type="submit" value="送出">
      </div>
    </form>
  </div>
</body>
</html>