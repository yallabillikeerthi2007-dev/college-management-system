<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include 'dbl.php';

if(isset($_POST['login'])){

    $username = trim($_POST['username']);

    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){

        die("Please fill all fields");

    }

    $stmt = $conn->prepare("SELECT * FROM students WHERE username=?");

    if(!$stmt){

        die("Query Failed");
    }

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])){

            $_SESSION['student_logged_in'] = true;

            $_SESSION['student_username'] = $row['username'];

            $_SESSION['student_pin'] = $row['pin'];

            $_SESSION['student_name'] = $row['name'];

            header("Location: dashboard.php");

            exit();

        }else{

            die("Wrong Password");
        }

    }else{

        die("Student Not Found");
    }

}else{

    die("Invalid Request");
}
?>