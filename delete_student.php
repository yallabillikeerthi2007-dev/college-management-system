<?php
error_reporting(0);
include "db_connect.php";
$sno=$GET["id"];
mysqli_query($conn,"delete from students where sno='$sno'");
echo "<script>window.location='add_students.php';</script>";
?>