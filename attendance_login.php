<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
$pass=$_POST["password"];
if($pass=="attendance"){
$_SESSION["att_logged_in"]=true;
echo "<script>window.location.href='mark_attendance.php';</script>";
exit();
}else{
//$error="Wrong password!";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Attendance Login</title>
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

.box{
    width:400px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
    animation:fadeIn 1s ease;
}

h2{
    color:#0d47c7;
    font-size:32px;
    margin-bottom:10px;
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

.error{
    background:#ffe5e5;
    color:red;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    font-size:14px;
}

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

@media(max-width:500px){
    .box{
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
<div class="box">
<h2>Attendance Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
<input type="password" name="password" placeholder="Enter Password" required/><br>
<button type="submit">Login</button>
</form>
</div>
</body>
</html>