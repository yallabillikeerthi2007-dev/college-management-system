<?php
include 'db.php';

$id = $_POST['id']; 

$dt = "DELETE FROM student WHERE Id='$id'";

if (mysqli_query($con, $dt)) {
    header("Location: admin_dashboard.php");
    exit;
} else {
    die("Record not deleted: " . mysqli_error($con));
}

mysqli_close($con);
?>
