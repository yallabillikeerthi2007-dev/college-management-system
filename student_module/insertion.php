<?php
include 'db.php';

$name = $_POST['stname'] ?? '';
$id = $_POST['id'] ?? '';
$gen = $_POST['gender'] ?? '';
$dep = $_POST['dept'] ?? 'Not Selected';
$year = $_POST['y'] ?? '';
$phno = $_POST['phno'] ?? '';
$photo = $_FILES['photo']['name'] ?? '';

move_uploaded_file($_FILES['photo']['tmp_name'],"images/".$photo);

$sql = "INSERT INTO student(Id, Name, Gender, Department, Year, Phno, Photo)
        VALUES('$id','$name','$gen','$dep','$year','$phno','$photo')";

if(mysqli_query($con,$sql))
  {
     header("Location: admin_dashboard.php");
     exit;
  }
else
  {
     die("Values are not inserted : ".mysqli_error($con));
  }

   ?>