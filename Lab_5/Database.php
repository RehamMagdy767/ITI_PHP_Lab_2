<?php

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $mysqli;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function insert($table, $columns, $values) {
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        if ($this->mysqli->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function select($table)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM $table");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    
    public function select_2($table,$namee)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM $table WHERE Name ='$namee'");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function update($table, $n, $columns, $values, $image)
    {
        $sql = "UPDATE $table SET ";
        for ($i = 0; $i < count($columns); $i++) 
        {
            if ($columns[$i] == 'ProfilePicture') 
            {
                if (!empty($image['name'])) 
                {
                    $imgName = $image['name'];
                    $imgTmpName = $image['tmp_name'];
                    $ext = pathinfo($imgName)['extension'];
                    $imgNewName = "images/" . time() . ".$ext";
                    if (in_array($ext, array('png', 'jpg', 'jpeg'))) 
                    {
                        move_uploaded_file($imgTmpName, $imgNewName);
                        $sql .= "$columns[$i] = '$imgNewName'";
                    }
                }
                else 
                {
                    // If $image is empty, update the record with the existing profile picture value
                    $sql .= "$columns[$i] = '$values[$i]'";
                }
            } 
            else 
            {
                $sql .= "$columns[$i] = '$values[$i]'";
            }
            if ($i < count($columns) - 1) 
            {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE Name = '$n'";
        if ($this->mysqli->query($sql) === TRUE) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function delete($table, $name) {
        $sql = "DELETE FROM $table WHERE Name = '$name'";
        if ($this->mysqli->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

?>