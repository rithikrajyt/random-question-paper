<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "randpaper";

// Checking connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql code to create table
$sql = "CREATE TABLE mastercopy (
        id INT(2)  NOT NULL, 
        Question TEXT(1000) NOT NULL,
        Marks INT(2) NOT NULL,
        CO_Number VARCHAR(11) NOT NULL
        )";

if (mysqli_query($conn, $sql)) {
    #echo "Table table created successfully"."<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

# Code to copy the whole data from master to master copy.
$sql1 = "INSERT INTO mastercopy
        SELECT * FROM `master`";
if (mysqli_query($conn, $sql1)) {
    #echo "Table table created successfully"."<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

?>