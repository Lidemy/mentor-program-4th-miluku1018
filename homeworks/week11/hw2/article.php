<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $id = $_GET['id'];
 
  $stmt = $conn->prepare(
    "SELECT A.id AS id,  A.title AS title, A.content AS content, A.created_at AS created_at,  C.name AS `name` FROM Miaohsien_articles AS A LEFT JOIN Miaohsien_categories AS C ON A.category_id = C.id
    WHERE A.id = ?
    ");
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
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
      <h1>文章</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div class="post__title"><?php echo escape($row['title']) ?></div>
        </div>
        <div class="category">分類：<?php echo escape($row['name']) ?></div>
        <div class="post__info">
        <?php echo escape($row['created_at']) ?>
        </div>
        <div class="post__content"><?php echo escape($row['content']) ?>
        </div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Miaohsien's Blog All Rights Reserved.</footer>
</body>
</html>