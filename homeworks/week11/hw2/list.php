<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;
  $stmt = $conn->prepare(
    "SELECT A.id AS id,  A.title AS title, A.content AS content, A.created_at AS created_at,  C.name AS `name` FROM Miaohsien_articles AS A LEFT JOIN Miaohsien_categories AS C ON A.category_id = C.id
    WHERE A.is_deleted IS NULL
    ORDER BY A.created_at DESC 
    LIMIT ?
    OFFSET ?
    ");
  $stmt->bind_param('ii', $items_per_page, $offset);  
  $result = $stmt->execute();
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
  <?php include_once('front_head.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>文章列表</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <?php while ($row = $result->fetch_assoc()) {?>
        <article class="post">
          <div class="post__header">
            <div class="post__title"><?php echo escape($row['title']) ?></div>
            <div class="post__actions">
              <?php if ($username) {?>
                <a class="post__action" href="edit_article.php?id=<?php echo escape($row['id']) ?>">編輯</a>
              <?php } ?>
            </div>
          </div>
          <div class="category">分類：<?php echo escape($row['name']) ?></div>
          <div class="post__info">
          <?php echo $row['created_at'] ?>
          </div>
          <div class="post__content"><?php echo escape($row['content']) ?>
          </div>
        </article>
      <?php } ?>
      <?php
      $stmt = $conn->prepare("SELECT count(id) AS count FROM Miaohsien_articles WHERE is_deleted IS NULL");
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
    ?>
    <div class="page-info">
      <span>第 <?php echo $page ?> 頁 / 共 <?php echo $total_page ?> 頁</span>
    </div>
    <div class="paginator">
      <?php if ($page != 1) { ?>
        <a href="list.php?page=1">首頁</a>  
        <a href="list.php?page=<?php echo $page - 1 ?>">上一頁</a>
      <?php } ?>
      <?php if ($page != $total_page) { ?>
        <a href="list.php?page=<?php echo $page + 1 ?>">下一頁</a>
        <a href="list.php?page=<?php echo $total_page ?>">最後一頁</a>  
      <?php } ?>
    </div>
  </div>
  <footer>Copyright © 2020 Miaohsien's Blog All Rights Reserved.</footer>
</body>
</html>