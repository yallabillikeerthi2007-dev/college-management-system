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
    margin:0;
    padding:0;
    font-family: Arial;
    background: linear-gradient(135deg,#0d47a1,#42a5f5);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-box{
    width:400px;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0px 5px 20px rgba(0,0,0,0.3);
    text-align:center;
}

h1{
    color:#0d47a1;
    margin-bottom:30px;
}

input{
    width:100%;
    padding:15px;
    margin-top:15px;
    font-size:16px;
    border:2px solid #90caf9;
    border-radius:8px;
    outline:none;
    box-sizing:border-box;
}

input:focus{
    border-color:#1565c0;
    box-shadow:0px 0px 8px rgba(21,101,192,0.4);
}

button{
    width:100%;
    padding:15px;
    margin-top:25px;
    background:linear-gradient(to right,#1565c0,#1e88e5);
    color:white;
    border:none;
    font-size:18px;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:linear-gradient(to right,#0d47a1,#1565c0);
    transform:scale(1.02);
}

.error{
    color:red;
    margin-top:15px;
    font-weight:bold;
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