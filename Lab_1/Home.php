<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $gender = $_POST["gender"];

    if ($gender == "male") 
    {
        echo "<h2>Thanks Mr. " . $firstName . " " . $lastName . "</h2>";
    } 
    elseif ($gender == "female") {
        echo "<h2>Thanks Miss. " . $firstName . " " . $lastName . "</h2>";
    }

    echo "<h3>Please review your information:</h3>";
    echo "Name: " . $firstName . " " . $lastName . "<br><br>";
    echo "Address: " . $_POST["address"] . "<br><br>";
    echo "Skills: " . implode(", ", $_POST["skills"]) . "<br><br>";
    echo "Department: " . $_POST["department"] . "<br><br>";
}
$expected_code = "ABC123";
$code = $_POST["code"];

if ($code != $expected_code) 
{
    header("Location:index.php");
    exit();
}
?>
