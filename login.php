<?php
include 'db.php';
$role   = $_POST['role'];
$uname  = $_POST['uname'];
$pass   = $_POST['password'];

// ADMIN LOGIN
if ($role == "Admin") {
    $sql = "SELECT * FROM admin WHERE username='$uname' AND password='$pass'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Invalid Admin Details";
    }
}

// STUDENT LOGIN
else if ($role == "Student") {
    $sql = "SELECT * FROM students WHERE Name='$uname' AND Id='$pass'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: student_dashboard.php?id=$pass");
        exit;
    } else {
        echo "Invalid Student Details";
    }
}

mysqli_close($con);
?>
