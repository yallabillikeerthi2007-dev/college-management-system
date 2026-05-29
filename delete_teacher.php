<?php
error_reporting(0);
include "db_connect.php";
$id=$_GET["id"];
mysqli_query($conn,"DELETE FROM teachers WHERE id='$id'");
echo "<script>window.location='add_teacher.php';</script>";
?>