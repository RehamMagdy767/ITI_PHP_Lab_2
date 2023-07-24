<?php

include 'MySQL.php';
    $name=$_GET['Name'];
    $stmt=$mysqli->prepare("DELETE FROM User WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    header('location:Table.php');
 
?>

 