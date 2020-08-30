<?php
  session_start();
  require_once('check_permission.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <?php include_once('back_head.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>新增分類區</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_add_admin_category.php" method="POST">
          <div class="edit-post__title">
            新增分類：
          </div>
          <?php
          if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            if ($code === '1') {
              $msg = '資料不齊全';
            }
            echo '<h2 class="error">錯誤：'. $msg .'</h2>';
          }
        ?>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" name="name" placeholder="請輸入分類"/>
          </div>
          <div class="edit-post__btn-wrapper">
            <input class="edit-post__btn" type="submit" value="送出">
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Miaohsien's Blog All Rights Reserved.</footer>
</body>
</html>