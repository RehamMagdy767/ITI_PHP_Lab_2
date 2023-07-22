<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Records</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .edit-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        body{
         background-color: antiquewhite;
        }
        .edit-button:hover
         {
            background-color: #3e8e41;

         }
        .delete-button {
            background-color: #f44336;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .delete-button:hover
        {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h2>Customer Records</h2>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Skills</th>
                <th>Username</th>
                <th>Department</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $file = fopen('customer.txt', 'r');
            while (!feof($file)) 
            {
                $line = fgets($file);
                if ($line)
                 {
                    $first_name = trim(str_replace('First Name:', '', $line));
                    $last_name = trim(str_replace('Last Name:', '', fgets($file)));
                    $email = trim(str_replace('Email:', '', fgets($file)));
                    $address = trim(str_replace('Address:', '', fgets($file)));
                    $country = trim(str_replace('Country:', '', fgets($file)));
                    $gender = trim(str_replace('Gender:', '', fgets($file)));
                    $skills = trim(str_replace('Skills:', '', fgets($file)));
                    $username = trim(str_replace('Username:', '', fgets($file)));
                    $department = trim(str_replace('Department:', '', fgets($file)));

                    echo "<tr>";
                    echo "<td>$first_name</td>";
                    echo "<td>$last_name</td>";
                    echo "<td>$email</td>";
                    echo "<td>$address</td>";
                    echo "<td>$country</td>";
                    echo "<td>$gender</td>";
                    echo "<td>$skills</td>";
                    echo "<td>$username</td>";
                    echo "<td>$department</td>";
                    echo "<td><a href='Edit.php?username=$username&first_name=$first_name&last_name=$last_name&email=$email&address=$address&country=$country&gender=$gender&skills=$skills&department=$department'><button class='edit-button'>Edit</button></a></td>";
                    echo "<td><a href='Delete.php?username=$username'><button class='delete-button'>Delete</button></a></td>";
                    echo "</tr>";
                }
            }
            fclose($file);
            ?>
        </tbody>
    </table>
</body>
</html>