<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
</head>
<link rel="stylesheet" href="Style.css">
<body>
  <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
  <p>You have successfully logged in.</p>
  <button onclick="window.location.href='logout.php'" class="b">Logout</button>
</body>
</html>