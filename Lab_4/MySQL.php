<?php
    $servername = "localhost";
    $username = "root";
    $password = "RM123$";
    $dbname='Lab_db';
    $mysqli= new  mysqli ($servername,$username,$password,$dbname);

    // $sql =" create table User(
    // Name varchar(30) primary key,
    // Email varchar(30) not null,
    // Password varchar(15) not null,
    // ConfirmPassword varchar(15) not null,
    // RoomNumber varchar(15) not null,
    // ProfilePicture varchar(100) not null);";
    
    // if ($mysqli->query($sql) === TRUE) {
    //     echo "Table created successfully";
    // } else {
    //     echo "Error creating table: " . $mysqli->error;
    // }
    
?>  
