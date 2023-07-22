<?php
$errors=array();

if(isset($_GET['errors']))
{
    $errors=json_decode($_GET['errors'],true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
      body{
         background-color: antiquewhite;
      }
    .address-field {
      width: 300px;
      height: 150px;
      resize: vertical;
      overflow-y: scroll;
    }
    .red{
        color: red;
    }
    .b {
    background-color: #333;
    border: 1px;;
    color: white;
    padding: 10px 16px;
    text-align: center;
    text-decoration:solid;
    display: inline-block;
    font-size: 10px;
    margin: 2px 1px;
    cursor: pointer;
    border-radius: 4px;
  }
    </style>
</head>
<body>
 <h2>Registration Form</h2>
 <form action="Home.php" method="POST">

    <label for="first-name" >First name</label>
    <input type="text" id="first-name" name="first-name">
    <div class="red">
    <?php
     if(isset($errors['first-name']))
     {
        echo $errors['first-name'];
     }
    ?>
    </div>
    <br><br>
    <label for="last-name">Last name:</label>
    <input type="text" id="last-name" name="last-name">
    <div class="red">
    <?php
     if(isset($errors['last-name']))
     {
        echo $errors['last-name'];
     }
    ?>
    </div>
    <br><br>
    <label>Email:</label><br>
	<input type="email" name="email">
    <div class="red">
    <?php
     if(isset($errors['email']))
     {
        echo $errors['email'];
     }
    ?>
    </div>
    <br><br>

    <label for="address">Address:</label><br>
    <textarea id="address" name="address" class="address-field"></textarea><br><br>

    <label for="country">Country:</label>
    <select id="country" name="country">
      <option value="">Select Country</option>
      <option value="EG">Egypt</option>
      <option value="USA">USA</option>
      <option value="Canada">Canada</option>
      <option value="UK">UK</option>
    </select><br><br>

    <label for="gender">Gender:</label>
    <input type="radio" id="male" name="gender" value="male">
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label>
    <div class="red">
    <?php
     if(isset($errors['gender']))
     {
        echo $errors['gender'];
     }
    ?>
    </div>
    <br><br>

    <label for="skills">Skills:</label><br>
    <input type="checkbox" id="php" name="skills[]" value="PHP">
    <label forphp>PHP</label><br>
    <input type="checkbox" id="mysql" name="skills[]" value="MySQL">
    <label for="mysql">MySQL</label><br>
    <input type="checkbox" id="java" name="skills[]" value="Java">
    <label for="java">Java</label><br>
    <input type="checkbox" id="c++" name="skills[]" value="C++">
    <label forcpp>C++</label><br><br>

    <label for="username">Username</label>
    <input type="text" id="username" name="username">    
    <div class="red">
    <?php
     if(isset($errors['username']))
     {
        echo $errors['username'];
     }
    ?>
    </div>
    <br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>

    <label for="department">Department:</label>
    <input type="text" id="department" name="department"><br><br>

    <label for="code">Code:</label>
    <input type="text" id="code" name="code"><br><br>

    <input type="reset" value="Restart" class="b">
    <input type="submit" value="Submit" class="b">
  </form>
  <button onclick="window.location.href='Table.php'" class="b">Show table</button>
</body>
</html>