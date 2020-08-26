<?php
  require_once('conn.php');

  $stmt = $conn->prepare('SELECT * FROM Miaohsien_categories WHERE is_deleted IS NULL');
  $result = $stmt->execute();

  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
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
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Miaohsien's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="list.php">文章列表</a></li>
          <li><a href="categories.php">分類專區</a></li>
          <li><a href="about.php">關於我</a></li>
        </div>
        <div>
          <li><a href="admin.php">管理後台</a></li>
          <li><a href="logout.php">登出</a></li>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_add_article.php" method="POST">
          <div class="edit-post__title">
            發表文章：
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
            <input class="edit-post__input" name="title" placeholder="請輸入文章標題"/>
          </div>
          <div class="edit-post__input-wrapper">
            分類：<select name="category_id">
              <?php 
                while ($row = $result->fetch_assoc()) {
                  $id = $row['id'];
                  $name = $row['name'];
                  echo "<option value='$id' selected>$name</option>";
                }
              ?>
            </select>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name="content"></textarea>
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