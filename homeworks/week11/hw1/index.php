<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  /*
    1. 從 cookie 裡面讀取 PHPSESSID(token)
    2. 從檔案裡面讀取 session id 的內容
    3. 放到 $_SESSION
  */
  $username = NULL;
  $user = NULL;
  $user['role'] = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  // items_per_page = limit
  $items_per_page = 10;
  $offset = ($page - 1) * $items_per_page;

  $stmt = $conn->prepare(
    "SELECT C.id AS id, C.content AS content, C.created_at AS created_at, U.nickname AS nickname, U.username AS username, U.role AS role
    FROM Miaohsien_comments AS C LEFT JOIN Miaohsien_users AS U ON (C.username = U.username) 
    WHERE C.is_deleted IS NULL
    ORDER BY C.id DESC
    LIMIT ? OFFSET ?"
  );
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute();

  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
?>
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
            }
            echo '<h2 class="error">錯誤：'. $msg .'</h2>';
          }
        ?>
      </div>
      <div class="link">
        <?php if(!$username) { ?>
          <a href="register.php">註冊</a>
          <a href="login.php">登入</a>
        <?php } else { ?>
          <h3 class='nickname'>您好，<?php echo $user['nickname'] ?></h3>
          <input type="button" class="new-nickname" value="編輯暱稱">
          <?php if ($user && $user['role'] === "ADMIN") { ?>
            <a href="admin.php">管理後台</a>
          <?php } ?>  
          <a href="logout.php">登出</a>
          <form class="hide update-nickname" method="POST" action="update_user.php" >
            <textarea name="nickname" placeholder="請輸入新的暱稱"></textarea>
            <input type="submit" value="修改">
          </form>
        <?php } ?>  
      </div>
    </div>
    <form method="POST" action="handle_add_post.php">
      <textarea name="content" cols="30" rows="5" placeholder="請輸入留言"></textarea>
      <?php if($username && !hasPermission($user, 'create', NULL)) { ?>
        <h3>你已經被停權</h3>
      <?php } elseif($username) { ?>
        <input type="submit" value="送出">
      <?php } else { ?>  
        <h3 class='login-warning'>請先登入帳號，方能留言</h3>
      <?php } ?>
    </form>
    <section class="comments">
      <?php while ($row = $result->fetch_assoc()) {?>
        <div class="card">
          <div class="avatar"></div>
          <div class="desc">
            <div class="user-info">
              <div class="nickname">
                <?php echo escape($row['nickname']) ?>
                (@<?php echo escape($row['username']) ?>)
              </div>
            <div class="comment-time"><?php echo escape($row['created_at']) ?></div>
            <div class="status">
            <?php if (hasPermission($user, 'update', $row)) { ?>
              <a href="edit_comment.php?id=<?php echo $row['id'] ?>">編輯</a>
              <a href="delete_comment.php?id=<?php echo $row['id'] ?>">刪除</a>
            <?php } ?>   
            </div>
          </div>
            <div class="messages"><?php echo escape($row['content']) ?></div>
          </div>
        </div>
      <?php } ?>
    </section>
    <div class="board-hr"></div>
    <?php
      $stmt = $conn->prepare('SELECT count(id) AS count FROM Miaohsien_comments WHERE is_deleted IS NULL');
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
    ?>
    <div class="page-info">
      <span>總共有 <?php echo $count ?> 筆留言，頁數：</span>
      <span><?php echo $page ?> / <?php echo $total_page ?></span>
    </div>
    <div class="paginator">
      <?php if($page != 1) { ?>
        <a href="index.php?page=1">首頁</a>
        <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
      <?php } ?>
      <?php if($page != $total_page) { ?>
        <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
        <a href="index.php?page=<?php echo $total_page ?>">最後一頁</a>
      <?php } ?>
    </div>
  </div>
  <script>
    var btn = document.querySelector('.new-nickname');
    btn.addEventListener('click', function(){
      var form = document.querySelector('.update-nickname');
      form.classList.toggle('hide');
    })
  </script>
</body>
</html>