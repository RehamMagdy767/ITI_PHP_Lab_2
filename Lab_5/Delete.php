<!DOCTYPE html>
<html>
<head>
	<title>My PHP Page</title>
</head>
<link rel="stylesheet" href="Style.css">
<body>
<?php
include 'Database.php';

$db = new Database("localhost", "root", "PHP0123$", "Lab_db");
$db->connect();

$name = $_GET["Name"];
if ($db->delete("User", $name)) {
	echo "<h1 style='text-align: center ;color:brown'>Record deleted successfully</h1>";
} else {
	echo "<h1 style='text-align: center ;color:brown'>Error deleting record</h1>";
}
?>
</body>
</html>

