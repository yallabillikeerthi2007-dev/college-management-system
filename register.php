<?php

include 'dbl.php';

if(isset($_POST['register'])){

    $username = trim($_POST['username']);

    $pin = trim($_POST['pin']);

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    if(empty($username) || empty($email) || empty($password) || empty($pin)|| empty($dept)){

        echo "Please fill all fields";

    }

        $check = $conn->prepare("SELECT * FROM students WHERE username=?");

        $check->bind_param("s", $username);

        $check->execute();

        $result = $check->get_result();

        if($result->num_rows > 0){

            die("Username already exists");

        }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO students(username,email,password,pin,name) VALUES(?,?,?,?,?)");

            $stmt->bind_param("sssss", $username, $email, $hashed_password,$pin,$username);

            if($stmt->execute()){

                header("Location: loginpage.html");

                exit();

            }else{

                die("Registration Failed");
            }
        }
?>