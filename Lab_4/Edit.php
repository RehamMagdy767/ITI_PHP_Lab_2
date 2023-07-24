<?php
include 'MySQL.php';
$name=$_GET['Name'];

$stmt=$mysqli->prepare("select * from  User where Name=?");
$stmt->bind_param("s", $namee);
$stmt->execute();
$result = $stmt->get_result();
echo "<body style='background-color: antiquewhite'><form action='' method='post'>";
echo "<h1 style='text-align: center ;color:brown'>Update Data</h1>";
    if ($result->num_rows > 0)
     {

       while ($row = $result->fetch_assoc()) 
       {
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $confirmPassword = $row['confirmPassword'];
        $roomNumber = $row['roomNumber'];
        $profilePicture = $row['profilePicture'];
           
        echo "Name:<input type='text' name='name' value='$name'><br><br><br>";

        echo "Email:<input type='text' name='Email' value='$email'><br><br><br>";
        echo "Password:<input type='password' name='Password' value='$password'><br><br><br>";
        echo "Confirm Password: <input type='password' name='confirm_Password' value='$confirmPassword'><br><br><br>";
        echo "Room Number:<input type='text' name='RoomNum' value='$roomNumber'><br><br><br>";
        echo "Profile Picture:<input type='file' name='image'value='$profilePicture'><br><br><br>";
        echo "<button type='submit' name='b' style='background-color:brown; height: 30px; '><a style='text-decoration:none; color:black; margin:20px'>Submit</a></button>";
         
       }
        echo "</form>";
        echo "</body>";
   } 
  
if(isset($_POST['b']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $roomNumber = $_POST['roomNumber'];
    $profilePicture = $imgNewName;
    
    $stmt = $mysqli->prepare("UPDATE User SET Email=?, Password=?, ConfirmPassword=?, RoomNumber=?, Ext=?, ProfilePicture=? WHERE Name=?");
    $stmt->bind_param("sssssss", $Email, $password, $confirmPassword, $roomNumber,$profilePicture,$namee);
    $stmt->execute();
    header('location:Table.php');
} 

?>