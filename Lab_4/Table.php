<?php
include 'MySQL.php';
$sql = "SELECT * FROM User";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Records</title>
</head>
<link rel="stylesheet" href="Style.css">
<body>
    <h2>Customer Records</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Confirm Password</th>
                <th>Room Number</th>
                <th>Profile Picture</th>
                <th> Edit</th>
                <th>Delete</th>
            </tr> 
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()):   $name=$row['Name'] ; ?>
        <tr>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['Password']; ?></td>
            <td><?php echo $row['ConfirmPassword']; ?></td>
            <td><?php echo $row['RoomNumber']; ?></td>
            <td><img src="<?php echo $row['ProfilePicture'];?>" class="img"></td>
            <td><?php echo "<button style='background-color: green;'><a href='Edit.php?Name=$name'style='text-decoration:none; color:white'>Edit</a></button>"?></td>;
            <td><?php echo "<button style='background-color: red;'><a href='Delete.php?Name=$name'style='text-decoration:none; color:white'>Delete</a></button>"?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <?php
    $stmt->close();
    $mysqli->close();
    ?>
</body>
</html>