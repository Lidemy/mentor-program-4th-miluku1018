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
            } elseif ($code === '2') {
              $msg = '帳號或密碼錯誤';
            }elseif ($code === '3') {
              $msg = '帳號必需為英文或數字';
            }
            echo '<h2 class="error">錯誤：'. $msg .'</h2>';
          }
        ?>
      </div>
      <div class="link">
        <a href="register.php">註冊</a>
        <a href="index.php">回留言板</a>
      </div>
    </div>
    <h3>登入帳號</h3>
    <form method="POST" action="handle_login.php">
      <div class="form-desc">
        <div class="username">帳號：<input type="text" name="username"></div>
        <div class="password">密碼：<input type="password" name="password"></div>
        <input type="submit" value="登入">
      </div>
    </form>
  </div>
</body>
</html>