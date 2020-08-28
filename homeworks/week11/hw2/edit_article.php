<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_permission.php');

  $id = $_GET['id'];
  $stmt = $conn->prepare('SELECT * FROM Miaohsien_articles WHERE id = ? ORDER BY created_at DESC');
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();

  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $stmt_category = $conn->prepare('SELECT * FROM Miaohsien_categories WHERE is_deleted IS NULL ORDER BY created_at DESC');
  $stmt_category->execute();
  $result_category = $stmt_category->get_result();

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
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_edit_article.php" method="POST">
          <div class="edit-post__title">
            編輯文章：
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
            <input class="edit-post__input" name="title" placeholder="請輸入文章標題" value="<?php echo escape($row['title'])?>"/>
          </div>
          <div class="edit-post__input-wrapper">
            分類：<select name="category_id">
              <?php 
                while ($row_category = $result_category->fetch_assoc()) {
                  $id = $row_category['id'];
                  $name = escape($row_category['name']);
                  $is_checked = $row['category_id'] === $id ? "selected" : "";
                  echo "<option value='$id' $is_checked>$name</option>";
                }
              ?>
            </select>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name="content"><?php echo escape($row['content']) ?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
            <input type="hidden" name="id" value="<?php echo escape($row['id']) ?>">
            <input type="hidden" name="page" value="<?php echo escape($_SERVER['HTTP_REFERER']) ?>">
            <input class="edit-post__btn" type="submit" value="送出">
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Miaohsien's Blog All Rights Reserved.</footer>
</body>
</html>