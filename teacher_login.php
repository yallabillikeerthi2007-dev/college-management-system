<?php
session_start();

/* CHECK LOGIN */

if(isset($_SESSION["teacher_logged_in"]))
{
    header("Location: teacher_dashboard.php");
    exit();
}

include "db_connect.php";

$error = "";

/* LOGIN PROCESS */

if(isset($_POST["login"]))
{
    $teacher_id=$_POST["teacher_id"];
    $password=$_POST["password"];

    $result=mysqli_query($conn,
    "SELECT * FROM students
     WHERE student_id='$student_id'");

    $row=mysqli_fetch_assoc($result);

    if($row)
    {
        if(trim($password)==trim($row["password"]))
        {
            $_SESSION["teacher_logged_in"]=true;

            $_SESSION["teacher_id"]=
            $row["teacher_id"];

            $_SESSION["teacher_name"]=
            $row["name"];

            $_SESSION["teacher_dept"]=
            $row["dept"];

            header("Location: teacher_dashboard.php");

            exit();
        }
        else
        {
            $error="Wrong Password!";
        }
    }
    else
    {
        $error="Teacher ID Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Teacher Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(to right,#4facfe,#00f2fe);
}

/* LOGIN BOX */

.login-box{
    width:400px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
    animation:fadeIn 1s ease;
}

/* ICON */

.icon{
    width:90px;
    height:90px;
    background:#0d47c7;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:40px;
    color:white;
    margin-bottom:20px;
}

/* HEADING */

h2{
    color:#0d47c7;
    font-size:32px;
    margin-bottom:10px;
}

.subtitle{
    color:#666;
    margin-bottom:25px;
    font-size:15px;
}

/* INPUTS */

.input-box{
    margin-bottom:18px;
    text-align:left;
}

label{
    display:block;
    margin-bottom:8px;
    color:#333;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:10px;
    font-size:15px;
    outline:none;
    transition:0.3s;
}

input:focus{
    border-color:#0d47c7;
    box-shadow:0 0 8px rgba(13,71,199,0.2);
}

/* BUTTON */

button{
    width:100%;
    padding:13px;
    background:#16a34a;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
    margin-top:10px;
}

button:hover{
    background:#15803d;
    transform:scale(1.02);
}

/* ERROR */

.error{
    background:#ffe5e5;
    color:red;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    font-size:14px;
}

/* BACK LINK */

.back-link{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:#0d47c7;
    font-weight:bold;
}

.back-link:hover{
    text-decoration:underline;
}

/* ANIMATION */

@keyframes fadeIn{

    from{
        opacity:0;
        transform:translateY(-20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

/* MOBILE */

@media(max-width:500px){

.login-box{
    width:90%;
    padding:25px;
}

h2{
    font-size:26px;
}

}

</style>

</head>

<body>

<div class="login-box">

    <!-- ICON -->

    <div class="icon">
       
    </div>

    <!-- TITLE -->

    <h2>Teacher Login</h2>

    <p class="subtitle">
        Login to access your dashboard
    </p>

    <!-- ERROR -->

    <?php
    if($error!="")
    {
        echo "<div class='error'>$error</div>";
    }
    ?>

    <!-- LOGIN FORM -->

    <form method="POST">

        <div class="input-box">

            <label>Teacher ID</label>

            <input type="text"
                   name="teacher_id"
                   placeholder="Enter Teacher ID"
                   required>

        </div>

        <div class="input-box">

            <label>Password</label>

            <input type="password"
                   name="password"
                   placeholder="Enter Password"
                   required>

        </div>

        <button type="submit"
                name="login">

            Login

        </button>

    </form>

    <!-- BACK -->

    <a href="teacher_index.php"
       class="back-link">

       ← Back to Teacher Module

    </a>

</div>

</body>
</html>