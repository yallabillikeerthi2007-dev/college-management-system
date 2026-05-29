<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost","root","","college_management");

if(!$con)
{
    die("Database connection failed");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $role = $_POST['role'];

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $pin   = trim($_POST['pin']);

    /* ---------------- ADMIN LOGIN ---------------- */
    if($role == "admin")
    {
        $sql = "SELECT * FROM students
                WHERE role='admin'
                AND LOWER(username)=LOWER('$username')
                AND LOWER(password)=LOWER('$password')";
    }

    /* ---------------- STUDENT LOGIN ---------------- */
    else
    {
        $sql = "SELECT * FROM students
                WHERE role='student'
                AND LOWER(username)=LOWER('$username')
                AND LOWER(password)=LOWER('$password')
                AND LOWER(pin)=LOWER('$pin')";
    }

    $result = mysqli_query($con,$sql);

    if($result && mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['pin'] = $row['pin'];

        /* Redirect */
        if($role == "admin")
        {
            header("Location: admin_dashboard.php");
        }
        else
        {
            header("Location: student_dashboard.php");
        }

        exit();
    }
    else
    {
        echo "<script>
        alert('Invalid Login Details');
        window.location='index.php';
        </script>";
    }
}
?>