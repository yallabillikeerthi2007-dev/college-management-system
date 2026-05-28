<?php
include 'db.php'; // database connection

// Insert multiple admin records
$sql = "INSERT INTO admin (username, password) VALUES
        ('Sarojini', 'CM404'),
        ('Gayathri', 'CM402'),
        ('MohanaTirumala', 'CM406'),
        ('NrasimhaMurthy','CM401'),
        ('Suresh','CM403'),
        ('GirishReddy','CM405')";

if (mysqli_query($con, $sql)) {
    echo "Admin details inserted successfully!";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
