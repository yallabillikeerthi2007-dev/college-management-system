<?php
session_start();

$con = mysqli_connect("localhost","root","","college_db");

if(!$con){
    die("Database connection failed");
}

$role     = $_POST['role'];
$username = trim($_POST['username']);
$pinno    = trim($_POST['pinno']);   // password place lo pinno

$sql = "SELECT * FROM users 
        WHERE role='$role'
        AND LOWER(username)=LOWER('$username')
        AND LOWER(pinno)=LOWER('$pinno')";

$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);

    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['pinno'] = $row['pinno'];

    if($row['role'] == "admin"){
        header("Location: admin_dashboard.php");
    } 
    else{
        header("Location: student_dashboard.php");
    }
    exit();
}
else{
    echo "<script>alert('Invalid Login Details'); window.location='index.php';</script>";
}
?>