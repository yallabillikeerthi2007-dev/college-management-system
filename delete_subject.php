<?php
error_reporting(0);
include "db_connect.php";
$id=$_GET["id"];
mysqli_query($conn,"DELETE FROM subjects WHERE id='$id'");
echo "<script>window.location='assign_subject.php';</script>";
?>