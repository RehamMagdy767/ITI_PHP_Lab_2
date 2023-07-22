<?php
if (!isset($_GET['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_GET['username'];

$file = file('customer.txt');
$index = -1;

foreach ($file as $i => $line) {
    if (preg_match("/^Username: $username$/", $line)) {
        $index = $i;
        break;
    }
}

if ($index >= 0) {
    $recordIndex = floor($index / 9);
    $numLines = 9;
    array_splice($file, $recordIndex * $numLines, $numLines);
    file_put_contents('customer.txt', implode('', $file));
}
echo "Record deleted successfully";
header('Location: index.php');
exit();
?>