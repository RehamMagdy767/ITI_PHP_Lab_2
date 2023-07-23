<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<link rel="stylesheet" href="Style.css">
<body>
  <div class="Lform">
  <h1>Login</h1>
  <div class="Red">
  <?php
  if (isset($_GET['error'])) {
    $error_msg = $_GET['error'];
    echo "<p>Error: $error_msg</p>";
  }
  ?>
  </div> 
  <form method="POST" action="validate.php">
    <label>Email:</label>
    <input type="text" name="email" class="txt"><br>
    <br>

    <label>Password:</label>
    <input type="password" name="password" class="txt"><br>
    <br>
    <button type="submit" class="b">Login</button>
  </form>

</body>
</html>