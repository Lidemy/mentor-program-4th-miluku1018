<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $limit = '5';
  $offset = '0';
  $stmt = $conn->prepare(
    "SELECT A.id AS id,  A.title AS title, A.content AS content, A.created_at AS created_at,  C.name AS `name` FROM Miaohsien_articles AS A LEFT JOIN Miaohsien_categories AS C ON A.category_id = C.id
    WHERE A.is_deleted IS NULL
    ORDER BY A.created_at DESC 
    LIMIT ?
    OFFSET ?
    ");
  $stmt->bind_param('ii', $limit, $offset);
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
        <?php
          if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            if ($code === '1') {
              $msg = '資料不齊全';
            }
            echo '<h2 class="error">錯誤：'. $msg .'</h2>';
          }
        ?>
        <div>
          <?php if (!$username) { ?>
            <li><a href="login.php">登入</a></li>
          <?php } else { ?>
            <h2>Hi, <?php echo $user['username']?></h2>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="logout.php">登出</a></li>
          <?php } ?>
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
    <div class="posts">
      <?php while ($row = $result->fetch_assoc()) {?>
        <article class="post">
          <div class="post__header">
            <div><?php echo $row['title'] ?></div>
            <div class="post__actions">
              <?php if ($username) {?>
                <a class="post__action" href="edit_article.php?id=<?php echo escape($row['id']) ?>">編輯</a>
              <?php } ?>
            </div>
          </div>
          <div class="category">分類：<?php echo $row['name'] ?></div>
          <div class="post__info">
          <?php echo $row['created_at'] ?>
          </div>
          <div class="post__content"><?php echo $row['content'] ?>
          </div>
          <a class="btn-read-more" href="blog.html">READ MORE</a>
        </article>
      <?php } ?>
    </div>
  </div>
  <footer>Copyright © 2020 Miaohsien's Blog All Rights Reserved.</footer>
</body>
</html>