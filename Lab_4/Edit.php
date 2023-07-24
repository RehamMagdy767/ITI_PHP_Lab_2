<?php
include 'MySQL.php';

if(isset($_GET['Name']))
{
    $name = $_GET['Name'];

    $stmt = $mysqli->prepare("SELECT * FROM User WHERE Name=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<body style='background-color: antiquewhite'>";
    echo "<form action='' method='post'>";
    echo "<h1 style='text-align: center; color: brown'>Update Data</h1>";

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) 
        {
            $name = $row['Name'];
            $email = $row['Email'];
            $password = $row['Password'];
            $confirmPassword = $row['ConfirmPassword'];
            $roomNumber = $row['RoomNumber'];
            $profilePicture = $row['ProfilePicture'];
           
            echo "Name:<input type='text' name='name' value='$name'><br><br><br>";
            echo "Email:<input type='text' name='email' value='$email'><br><br><br>";
            echo "Password:<input type='password' name='password' value='$password'><br><br><br>";
            echo "Confirm Password: <input type='password' name='confirmPassword' value='$confirmPassword'><br><br><br>";
            echo "Room Number:<input type='text' name='roomNumber' value='$roomNumber'><br><br><br>";
            echo "Profile Picture:<input type='file' name='image'><br><br><br>";
            echo "<button type='submit' name='submit' style='background-color: brown; height: 30px;'><a style='text-decoration:none; color:black; margin:20px'>Submit</a></button>";
        }
    } 

    echo "</form>";
    echo "</body>";
}

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $roomNumber = $_POST['roomNumber'];
    
    // check if a file was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // get the name of the uploaded file
        $imgName = $_FILES['image']['name'];
        
        // generate a unique name for the uploaded file
        $imgNewName = uniqid() . '_' . $imgName;
        
        // move the uploaded file to the target directory
        move_uploaded_file($_FILES['image']['tmp_name'], 'upload/' . $imgNewName);
    } else {
        // no file was uploaded, use the existing profile picture name
        $imgNewName = $_POST['profilePicture'];
    }
    
    // update the user data in the database
    $stmt = $mysqli->prepare("UPDATE User SET Email=?, Password=?, ConfirmPassword=?, RoomNumber=?, ProfilePicture=? WHERE Name=?");
    $stmt->bind_param("ssssss", $email, $password, $confirmPassword, $roomNumber, $imgNewName, $name);
    $stmt->execute();
    
    // redirect to the table page
    header('location:Table.php');
}
?>