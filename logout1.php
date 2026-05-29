<?php

session_start();

session_unset();

session_destroy();

?>

<!DOCTYPE html>
<html>

<head>

<title>Logout</title>

<style>

body{
    margin:0;
    padding:0;
    font-family: Arial;
    background: linear-gradient(135deg,#0d47a1,#42a5f5);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    width:420px;
    background:white;
    padding:40px;
    text-align:center;
    border-radius:20px;
    box-shadow:0px 5px 20px rgba(0,0,0,0.3);
}

h1{
    color:#e53935;
    margin-bottom:15px;
}

p{
    color:#555;
    font-size:18px;
}

a{
    text-decoration:none;
    background:linear-gradient(to right,#1565c0,#1e88e5);
    color:white;
    padding:14px 30px;
    border-radius:8px;
    display:inline-block;
    margin-top:25px;
    font-size:18px;
    transition:0.3s;
}

a:hover{
    background:linear-gradient(to right,#0d47a1,#1565c0);
    transform:scale(1.03);
}

</style>

</head>

<body>

<div class="box">

<h1>Logged Out Successfully</h1>

<p>Session Closed</p>

<a href="login1.php">
Login Again
</a>

</div>

</body>

</html>