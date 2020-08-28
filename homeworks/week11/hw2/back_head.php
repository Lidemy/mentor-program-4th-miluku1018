<?php
  require_once('utils.php');
  require_once('conn.php');
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  } 
?>
<nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Miaohsien's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="list.php">文章列表</a></li>
          <li><a href="categories.php">管理分類</a></li>
          <li><a href="about.php">關於我</a></li>
        </div>
        <div>
        <?php if (!$username) { ?>
            <li><a href="login.php">登入</a></li>
          <?php } else { ?>
            <h2>Hi, <?php echo escape($user['username']) ?></h2>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="add_article.php">新增文章</a></li>
            <li><a href="logout.php">登出</a></li>
          <?php } ?>
        </div>
      </ul>
    </div>
  </nav>