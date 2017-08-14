<div class="header">
  <div class="header-left">
    <a href="profile.php">
      <div><h2><?= $_SESSION['user_name'] . " " . $_SESSION['user_family']; ?></h2></div>
    </a>
  </div>
  <div class="header-right">
    <h2><a href="?logout">Выйти</a></h2>
  </div>
</div>