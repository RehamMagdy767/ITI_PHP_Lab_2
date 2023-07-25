<?php
include 'Database.php';
$n = $_GET['Name'];
$db = new Database("localhost", "root", "PHP0123$", "Lab_db");
$return = $db->connect();
$result = $db->select_2("User", $n);
echo "<body style='background-color: antiquewhite'>";
echo "<form action='' method='post' enctype='multipart/form-data'>";
echo "<h1 style='text-align: center ;color:brown'>Update Data </h1>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['Name'];
        $email = $row['Email'];
        $password = $row['Password'];
        $confirmPassword = $row['ConfirmPassword'];
        $roomNumber = $row['RoomNumber'];
        $profilePicture = $row['ProfilePicture'];

        $passwordError = $confirmPasswordError = '';
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $existingPassword = $_POST['existingPassword'];
            if ($password != $confirmPassword || $password != $existingPassword) {
                $confirmPasswordError = 'Password and Confirm Password do not match, or do not match existing password.';
            }
            $pattern = '/^[a-z0-9_]{1,8}$/';
            if (!preg_match($pattern, $password)) {
                $passwordError = 'Password must be only lowercase letters, digits, and underscores, and no more than 8 characters long.';
            }
        }

        echo "Name:<input type='text' name='name' value='$name'><br><br><br>";
        echo "Email:<input type='text' name='email' value='$email'><br><br><br>";
        echo "Password:<input type='password' name='password' pattern='[a-z0-9_]{1,8}' title='Password must be only lowercase letters, digits, and underscores, and no more than 8 characters long.'value='$password' required";
        if (!empty($passwordError)) {
            echo " style='border-color: red'";
        }
        echo "><br>";
        if (!empty($passwordError)) {
            echo "<span style='color: red'>$passwordError</span><br>";
        }
        echo "<br>";
        echo "Confirm Password: <input type='password' name='confirmPassword' pattern='[a-z0-9_]{1,8}' title='Password must be only lowercase letters, digits, and underscores, and no more than 8 characters long.' value='$confirmPassword' required";
        if (!empty($confirmPasswordError)) {
            echo " style='border-color: red'";
        }
        echo "><br>";
        if (!empty($confirmPasswordError)) {
            echo "<span style='color: red'>$confirmPasswordError</span><br>";
        }
        echo "<br>";
        echo "Room Number:<input type='text' name='roomNumber' value='$roomNumber'><br><br><br>";
        echo "Profile Picture:<input type='file' name='image'><br><br>";
        if (!empty($profilePicture)) {
            echo "Current Profile Picture: $profilePicture<br><br>";
            echo "<input type='hidden' name='profilePicture' value='$profilePicture'>";
        } else {
            // Set $profilePicture to the existing value retrieved from the database
            echo "<input type='hidden' name='profilePicture' value='{$row['ProfilePicture']}'>";
        }

        echo "<input type='hidden' name='existingPassword' value='$password'>";

        echo "<button type='submit' name='submit' style='background-color: brown; height: 30px;'><a style='text-decoration:none; color:black; margin:20px'>Submit</a></button>";
    }
}

echo "</form>";
echo "</body>";


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $roomNumber = $_POST['roomNumber'];
    $profilePicture = $_FILES['image'];

    $passwordError = $confirmPasswordError = '';
    $existingPassword = $_POST['existingPassword'];
    if ($password != $confirmPassword || $password != $existingPassword) {
        $confirmPasswordError = 'Password and Confirm Password do not match, or do not match existing password.';
    }
    $pattern = '/^[a-z0-9_]{1,8}$/';
    if (!preg_match($pattern, $password)) {
        $passwordError = 'Password must be only lowercase letters, digits, and underscores, and no more than 8 characters long.';
    }

    $columns = array("Name", "Email", "Password", "ConfirmPassword", "RoomNumber", "ProfilePicture");
    $values = array($name, $email, $password, $confirmPassword, $roomNumber, $_POST['profilePicture']);
    if (!empty($passwordError) || !empty($confirmPasswordError)) {
        echo "<script>alert('$passwordError $confirmPasswordError');</script>";
    } else {
        if ($db->update("User", $n, $columns, $values, $profilePicture)) {
            echo "<script>window.location.href='Table.php';</script>";
        } else {
            echo "<h1 style='text-align: center ;color:brown'>Error updating record</h1>";

        }
    }
}
?>