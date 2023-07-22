<?php
function isUnique($value, $filename)
{
    $file = fopen($filename, 'r');
    while (!feof($file)) {
        $line = fgets($file);
        if (strpos($line, $value) !== false) {
            fclose($file);
            return false;
        }
    }
    fclose($file);
    return true;
}

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["first-name"]))
    {
        $errors["first-name"] = "First name is required";
    }
    else
    {
        $firstName = $_POST["first-name"];
    }

    if (empty($_POST["last-name"]))
    {
        $errors["last-name"] = "Last name is required";
    }
    else
    {
        $lastName = $_POST["last-name"];
    }

    if (empty($_POST["email"]))
    {
        $errors["email"] = "Email is required";
    }
    else
    {
        $email = $_POST["email"];
    }

    if (empty($_POST["gender"]))
    {
        $errors["gender"] = "Gender is required";
    }
    else
    {
        $gender = $_POST["gender"];
    }

    $username = $_POST['username'];
    $filename = 'customer.txt';
    if (empty($username))
    {
        $errors["username"] = "Username is required";
    }
    elseif(!isUnique($username, $filename)) {
        $errors["username"] = "Username is already taken";
    }

    $expected_code = "ABC123";
    $code = $_POST["code"];

    if ($code != $expected_code) {
        $errors["code"] = "Invalid code";
    }

    if (!empty($errors))
    {
        $Ferrors=json_encode($errors);
        header("Location: Index.php?errors=$Ferrors");
        exit();
    }

    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $skills = isset($_POST['skills']) ? implode(', ', $_POST['skills']) : '';
    $username = $_POST['username'];
    $department = $_POST['department'];

    $file = fopen('customer.txt', 'a');
    fwrite($file, "First Name: $first_name\n");
    fwrite($file, "Last Name: $last_name\n");
    fwrite($file, "Email: $email\n");
    fwrite($file, "Address: $address\n");
    fwrite($file, "Country: $country\n");
    fwrite($file, "Gender: $gender\n");
    fwrite($file, "Skills: $skills\n");
    fwrite($file, "Username: $username\n");
    fwrite($file, "Department: $department\n");
    fclose($file);

    header("Location: Index.php");
}
