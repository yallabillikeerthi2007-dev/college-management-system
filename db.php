<?php
$con = mysqli_connect("localhost", "root", "", "college_db");

if(!$con){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>