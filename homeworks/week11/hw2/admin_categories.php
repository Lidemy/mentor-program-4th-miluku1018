<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_permission.php');

  $stmt = $conn->prepare('SELECT * FROM Miaohsien_categories WHERE is_deleted IS NULL ORDER BY created_at DESC');
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
  <?php include_once('back_head.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>分類專區</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="post">
        <a class="add_category" href="add_admin_category.php">新增分類</a>
        <a class="add_category" href="categories.php">返回分類專區</a>
        <?php while ($row = $result->fetch_assoc())  {?>
          <div class="admin-category">
            <div class="admin-post__title">
              <?php echo escape($row['name']) ?>
            </div>
            <div class="admin-post__info">
              <div class="admin-post__created-at">
              <?php echo escape($row['created_at']) ?>
              </div>
              <a class="admin-post__btn" href="edit_admin_categories.php?id=<?php echo escape($row['id']) ?>">
                編輯
              </a>
              <a class="admin-post__btn" href="handle_delete_admin_categories.php?id=<?php echo escape($row['id']) ?>">
                刪除
              </a>
            </div>
          </div>   
        <? } ?>  
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>