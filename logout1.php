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
    font-family: Arial;
    background: #f4f4f4;
}

.box{
    width: 400px;
    background: white;
    margin: 100px auto;
    padding: 40px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}

h1{
    color: red;
}

a{
    text-decoration: none;
    background: #1565c0;
    color: white;
    padding: 12px 25px;
    border-radius: 6px;
    display: inline-block;
    margin-top: 20px;
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