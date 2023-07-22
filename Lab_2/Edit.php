
<?php
$errors = array();
$first_name = '';
$last_name = '';
$email = '';
$address = '';
$country = '';
$gender = '';
$skills = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input here and populate $errors array if necessary

    if (empty($errors)) {
        $username = $_POST['username'];
        $data = file_get_contents('customer.txt');
        $data = str_replace(
            "Username:$username\n",
            "First Name:{$_POST['first-name']}\n"
            . "Last Name:{$_POST['last-name']}\n"
            . "Email:{$_POST['email']}\n"
            . "Address:{$_POST['address']}\n"
            . "Country:{$_POST['country']}\n"
            . "Gender:{$_POST['gender']}\n"
            . "Skills:" . implode(',', $_POST['skills']) . "\n"
            . "Username:{$_POST['username']}\n"
            . "Department:{$_POST['department']}\n",
            $data
        );
        file_put_contents('customer.txt', $data);
        ob_start();
        header('Location: Table.php');
        ob_end_flush();
        exit;
    }
} else {
    $username = $_GET['username'];
    $skills = array();
    $data = file('customer.txt');
    foreach ($data as $line) {
        if (strpos($line, "Username:$username") !== false) {
            $first_name = trim(str_replace('First Name:', '', $line));
            $last_name = trim(str_replace('Last Name:', '', fgets($data)));
            $email = trim(str_replace('Email:', '', fgets($data)));
            $address = trim(str_replace('Address:', '', fgets($data)));
            $country = trim(str_replace('Country:', '', fgets($data)));
            $gender = trim(str_replace('Gender:', '', fgets($data)));
            $skills = explode(',', trim(str_replace('Skills:', '', fgets($data))));
            $department = trim(str_replace('Department:', '', fgets($data)));
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer Record</title>
    <style>
        .address-field {
            width: 300px;
            height: 150px;
            resize: vertical;
            overflow-y: scroll;
        }
        .red{
            color: red;
        }
    </style>
</head>
<body>
<h2>Edit Customer Record</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="hidden" name="username" value="<?php echo $username; ?>">
    <label for="first-name" >First name</label>
    <input type="text" id="first-name" name="first-name" value="<?php echo htmlspecialchars($first_name); ?>">
    <div class="red">
        <?php
        if (isset($errors['first-name'])) {
            echo $errors['first-name'];
        }
        ?>
    </div>
    <br><br>
    <label for="last-name">Last name:</label>
    <input type="text" id="last-name" name="last-name" value="<?php echo htmlspecialchars($last_name); ?>">
    <div class="red">
        <?php
        if (isset($errors['last-name'])) {
            echo $errors['last-name'];
        }
        ?>
    </div>
    <br><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <div class="red">
        <?php
        if (isset($errors['email'])) {
            echo $errors['email'];
        }
        ?>
    </div>
    <br><br>

    <label for="address">Address:</label><br>
    <textarea id="address" name="address" class="address-field"><?php echo htmlspecialchars($address); ?></textarea><br><br>

    <label for="country">Country:</label>
    <select id="country" name="country">
        <option value="">Select Country</option>
        <option value="EG"<?php if ($country == 'EG') echo ' selected'; ?>>Egypt</option>
        <option value="USA"<?php if ($country == 'USA') echo ' selected'; ?>>USA</option>
        <option value="Canada"<?php if ($country == 'Canada') echo ' selected'; ?>>Canada</option>
        <option value="UK"<?php if ($country == 'UK') echo ' selected'; ?>>UK</option>
    </select><br><br>

    <label for="gender">Gender:</label>
    <input type="radio" id="male" name="gender" value="male"<?php if ($gender == 'male') echo ' checked'; ?>>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female"<?php if ($gender == 'female') echo ' checked'; ?>>
    <label for="female">Female</label><br><br>

    <label for="skills">Skills:</label><br>
    <input type="checkbox" id="php" name="skills[]" value="PHP"<?php if (in_array('PHP', $skills)) echo ' checked'; ?>>
    <label for="php">PHP</label>
    <input type="checkbox" id="mysql" name="skills[]" value="MySQL"<?php if (in_array('MySQL', $skills)) echo ' checked'; ?>>
    <label for="mysql">MySQL</label>
    <input type="checkbox" id="java" name="skills[]" value="Java"<?php if (in_array('Java', $skills)) echo ' checked'; ?>>
    <label for="java">Java</label>
    <input type="checkbox" id="C++" name="skills[]" value="C++"<?php if (in_array('C++', $skills)) echo ' checked'; ?>>
    <label for="C++">C++</label>
    <br><br>

    <label for="new-department">Department:</label>
    <input type="text" id="new-department" name="department"><br><br>

    <input type="submit" value="Update">
</form>
</body>
</html>