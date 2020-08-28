<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $stmt = $conn->prepare('SELECT * FROM Miaohsien_categories WHERE is_deleted IS NULL ORDER BY created_at DESC');
  $result = $stmt->execute();
  
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  
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
  <?php include_once('front_head.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>分類專區</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">  
      <div class="post">
        <?php if ($username) { ?>
          <a class="add_category" href="admin_categories.php">管理分類</a> 
        <? } ?>  
        <?php foreach($result as $row)  {?>
          <div class="admin-category">
            <div class="admin-post__title">
              <?php echo escape($row['name']) ?>
            </div>
          </div>
          <?php 
            $stmt = $conn->prepare(
              "SELECT A.id AS id, A.title AS title FROM Miaohsien_articles AS A LEFT JOIN Miaohsien_categories AS C ON A.category_id = C.id
              WHERE C.name = ? && A.is_deleted IS NULL
              ORDER BY A.created_at DESC 
              ");
            $stmt->bind_param('s', $row['name']);
            $result_article = $stmt->execute();
            $result_article = $stmt->get_result();
          ?>
          <?php while ($row_article = $result_article->fetch_assoc()) {?>
            <div class="post__info"><a href="article.php?id=<?php echo escape($row_article['id']) ?>"><?php echo escape($row_article['title']) ?></a></div>
          <? } ?>  
        <? } ?>  
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>