<?php

session_start();

$error = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* LOGIN DETAILS */

    if($username == "admin" && $password == "admin123")
    {
        $_SESSION['admin'] = $username;

        header("Location: marksheets.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Login</title>

<style>

body{
    font-family: Arial;
    background: #f4f4f4;
}

.login-box{
    width: 400px;
    background: white;
    margin: 100px auto;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
    text-align: center;
}

h1{
    color: #1565c0;
    margin-bottom: 30px;
}

input{
    width: 90%;
    padding: 15px;
    margin: 10px;
    font-size: 18px;
    border: 2px solid #ddd;
    border-radius: 6px;
}

button{
    background: green;
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 18px;
    border-radius: 6px;
    cursor: pointer;
}

.error{
    color: red;
    margin-bottom: 15px;
}

</style>

</head>

<body>

<div class="login-box">

<h1>Admin Login</h1>

<div class="error">
<?php echo $error; ?>
</div>

<form method="POST">

<input type="text"
       name="username"
       placeholder="Enter Username"
       required>

<input type="password"
       name="password"
       placeholder="Enter Password"
       required>

<br><br>

<button type="submit"
        name="login">
        Login
</button>

</form>

</div>

</body>

</html>