<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  unset($_SESSION['user_type']);
  header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h2>Home Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p>You are logged in as <strong><?php echo $_SESSION['user_type']; ?></strong></p>

      <?php if ($_SESSION['user_type'] == 'admin') : ?>
        <p>Admin specific content goes here</p>
        <p><a href="admin_page.php">Admin Dashboard</a></p>
      <?php elseif ($_SESSION['user_type'] == 'pengurus') : ?>
        <p>Pengurus specific content goes here</p>
        <p><a href="pengurus_page.php">Pengurus Dashboard</a></p>
      <?php elseif ($_SESSION['user_type'] == 'pelanggan') : ?>
        <p>Pelanggan specific content goes here</p>
        <p><a href="pelanggan_page.php">Pelanggan Dashboard</a></p>
      <?php endif; ?>

      <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>

</body>
</html>
