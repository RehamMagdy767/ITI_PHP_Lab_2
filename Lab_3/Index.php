<?php
$roomNumbers = array(
    '100' => 'Room 100',
    '101' => 'Room 101',
    '102' => 'Room 102',
    '103' => 'Room 103',
    '104' => 'Room 104',
    '105' => 'Room 105',
);
$name = $email = $password = $confirmPassword = $roomNumber = $profilePicture = '';
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required';
    } else {
        $name = $_POST['name'];
    }
    
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    } 
    // $pattern="/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
    // if(!preg_match($pattern,$_POST['email'])){
    //     $errors['email'] = 'Invalid email format';
    //     }
    else {
        $email = $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($_POST['password']) !== 8) {
        $errors['password'] = 'Password must be exactly 8 characters';
    } elseif (!preg_match('/^[a-z0-9_]*$/', $_POST['password'])) {
        $errors['password'] = 'Password can only contain lowercase letters, digits, and underscores';
    } else {
        $password = $_POST['password'];
    }
    
    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = 'Please confirm your password';
    } elseif ($_POST['confirmPassword'] !== $password) {
        $errors['confirmPassword'] = 'Passwords do not match';
    } else {
        $confirmPassword = $_POST['confirmPassword'];
    }
    if (!isset($_POST['roomNumber'])) {
        $errors['roomNumber'] = 'Room number is required';
    } elseif (!array_key_exists($_POST['roomNumber'], $roomNumbers)) {
        $errors['roomNumber'] = 'Invalid room number';
    } else {
        $roomNumber = $_POST['roomNumber'];
    }

    if (isset($_FILES['profilePicture']) and !empty($_FILES['profilePicture']['name']))
     {
        $imgName = $_FILES['profilePicture']['name'];
        $ext = pathinfo($imgName)['extension'];
        $imgTmpName = $_FILES['profilePicture']['tmp_name'];
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileType = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);

        $imgNewName = "images/".time().".".$ext;
        if (!in_array($fileType, $allowedTypes))
        {
            $errors['profilePicture'] = 'Invalid file type';
        } else {
            $profilePicture = $_FILES['profilePicture']['name'];
            move_uploaded_file($imgTmpName, $imgNewName);
        }
    }

    if (empty($errors)) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $roomNumber = $_POST['roomNumber'];
    $profilePicture = $imgNewName;
    
    $file = fopen('users.txt', 'a');
    $all="$name:$email:$password:$confirmPassword:$roomNumber:$profilePicture\n";
    fwrite($file,$all);  
    fclose($file);
    
    $userDataJson = json_encode($userData) . "\n";
    file_put_contents('users.txt', $userDataJson, FILE_APPEND);
    header("Location: Index.php");
    exit;
    }

    
}
?>

<!-- ------------------------------------------------------------------------------------------------------------ -->

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<link rel="stylesheet" href="Style.css">
<body>
    <h2>Registration Form</h2>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <div class="Red">
            <?php if (!empty($errors['name'])): ?>
                <span><?php echo $errors['name']; ?></span>
            <?php endif; ?>
            </div>
        </div>
        <br>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="Red">
            <?php if (!empty($errors['email'])): ?>
                <span><?php echo $errors['email']; ?></span>
            <?php endif; ?>
            </div>
        </div>
        <br>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <div class="Red">
            <?php if (!empty($errors['password'])): ?>
                <span><?php echo $errors['password']; ?></span>
            <?php endif; ?>
            </div>
        </div>
        <br>
        <div>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <div class="Red">
            <?php if (!empty($errors['confirmPassword'])): ?>
                <span><?php echo $errors['confirmPassword']; ?></span>
            <?php endif; ?>
            </div>
        </div>
        <br>
        <div>
            <label for="roomNumber">Room Number:</label>
            <select id="roomNumber" name="roomNumber">
                <option value="" id="defualt">Select a room number</option>
                <?php foreach ($roomNumbers as $value => $label): ?>
                    <option value="<?php echo $value; ?>"<?php if ($roomNumber === $value) echo ' selected'; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="Red">
            <?php if (!empty($errors['roomNumber'])): ?>
                <span><?php echo $errors['roomNumber']; ?></span>
            <?php endif; ?>
            </div>
        </div>
        <br>
        <div>
            <label for="profilePicture">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profilePicture" class="b">
            <div class="Red">
            <?php if (!empty($errors['profilePicture'])): ?>
                <span><?php echo $errors['profilePicture']; ?></span>
            <?php endif; ?>
            </div>
        </div>
        <br>
        <div>
            <input type="submit" name="submit" value="Save" class="b">
            <input type="reset" name="reset" value="Reset" class="b">
        </div>
    </form>
    <button onclick="window.location.href='login.php'" class="b">Login page</button>
</body>
</html>