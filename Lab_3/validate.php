<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $errors = array();
  if (empty($email)) {
    $errors[] = 'Email is required';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
  }

  if (empty($password)) {
    $errors[] = 'Password is required';
  }

  if (empty($errors)) {
    $users = file('users.txt');
    $username = '';
    foreach ($users as $user) {
      $fields = explode(':', $user);
      if (trim($fields[1]) == $email && trim($fields[2]) == $password) {
        $username = trim($fields[0]);
        break;
      }
    }

    if (!empty($username)) {
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;

      header('Location: welcome.php');
      exit;
    } else {
      header('Location: login.php?error=Invalid email or password');
      exit;
    }
  } else {
    $error_msg = implode(',', $errors);
    header("Location: login.php?error=$error_msg");
    exit;
  }
} else {
  header('Location: login.php');
  exit;
}