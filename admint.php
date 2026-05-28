<?php
session_start();
include 'dbl.php';

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if($data && password_verify($password, $data['password'])){

        session_regenerate_id(true);

        $_SESSION['admin'] = $username;

        header("Location: admint.php");
        exit();

    } else {

        $error = "Invalid Username or Password";

    }
}

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("Location: admint.php");
    exit();
}

$total_students = 0;
$total_teachers = 0;
$total_fees = 0;
$total_attendance = 0;

if(isset($_SESSION['admin'])){

    // Students
    $res = mysqli_query($conn,
    "SELECT COUNT(*) as total FROM student");

    $row = mysqli_fetch_assoc($res);

    $total_students = $row['total'];



    // Teachers
    $teacher_res = mysqli_query($conn,
    "SELECT COUNT(*) as total FROM teachers");

    $teacher_row = mysqli_fetch_assoc($teacher_res);

    $total_teachers = $teacher_row['total'];


$fees_res = mysqli_query($conn,
"SELECT 
SUM(total_fee) as total_fees,
SUM(due_fee) as total_due,
SUM(balance_fee) as total_paid
FROM  student_fees");

$fees_row = mysqli_fetch_assoc($fees_res);

$total_fees = $fees_row['total_fees']??0;
$total_due = $fees_row['total_due']??0;
$total_paid = $fees_row['total_paid']??0;

    $attendance_res = mysqli_query($conn,"
    SELECT 
    COUNT(CASE WHEN status='Present' THEN 1 END) * 100 / COUNT(*) 
    AS attendance_percentage
    FROM attendance
    ");

    $attendance_row = mysqli_fetch_assoc($attendance_res);

    $total_attendance = round($attendance_row['attendance_percentage']??0);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#eef4ff;
}


#loginPage{
display:flex;
flex-direction:column;
width:100vw;
height:100vh;
background:#e8edf5;
align-items:center;
justify-content:center;
gap:16px;
}
 #loginPage a{
    background: #4f7ef8;
    text-decoration:none;
    color:#fff;
    border:3px solid #4f7ef8;
    border-radius: 7px;
    box-shadow:0 2px 12px #cfd4de;
 }

 #loginPage a:hover{
    background: #fff;
    color: #000000;
    border:3px solid #fff;
 }

.login-card{
background:white;
border-radius:24px;
box-shadow:0 8px 32px rgba(79,126,248,0.13);
padding:44px 40px;
width:100%;
max-width:420px;
}

.login-logo{
text-align:center;
margin-bottom:28px;
}

.login-logo h2{
font-size:18px;
font-weight:700;
color:#1a1a2e;
margin-top:12px;
font-family:'Times New Roman';
}

.login-logo p{
font-size:12px;
color:#888;
margin-top:2px;
}

.login-card h3{
font-size:20px;
font-weight:700;
color:#1a1a2e;
margin-bottom:6px;
}

.login-card p.sub{
font-size:13px;
color:#888;
margin-bottom:28px;
}

.form-group{
margin-bottom:18px;
}

.form-group label{
font-size:13px;
font-weight:500;
color:#444;
display:block;
margin-bottom:6px;
}

.input-wrap{
position:relative;
}

.input-wrap i{
position:absolute;
left:14px;
top:50%;
transform:translateY(-50%);
font-size:18px;
color:#aaa;
}

.form-group input{
width:100%;
padding:12px 14px 12px 42px;
border:1.5px solid #e0e7ff;
border-radius:10px;
outline:none;
font-size:14px;
background:#f7f9ff;
}

.show-pass{
position:absolute;
right:14px;
top:50%;
transform:translateY(-50%);
cursor:pointer;
font-size:18px;
color:#aaa;
}

.error-msg{
color:#e74c3c;
font-size:12px;
margin-top:16px;
text-align:center;
}

.login-btn{
width:100%;
padding:13px;
background:#4f7ef8;
color:white;
border:none;
border-radius:10px;
font-size:15px;
font-weight:600;
cursor:pointer;
margin-top:8px;
}

.login-btn:hover{
background:#3a6be0;
}

#dashboardPage{
min-height:100vh;
}

.sidebar{
width:250px;
min-height: 100vh;
background:#fff;
position:fixed;
top:0;
left:0;
overflow:hidden;
box-shadow:2px 0 10px rgba(0,0,0,0.08);
}

.logo{
display:flex;
align-items:center;
gap:12px;
padding:20px 16px;
border-bottom:1px solid #f0f0f0;
}

.logo img{
width:40px;
height:40px;
border-radius:10px;
}

.logo-text{
font-size:12px;
font-weight:700;
color:#1a1a2e;
line-height:1.4;
font-family:'Times New Roman';
}

.menu{
list-style:none;
padding:12px 0;
}

.menu a{
text-decoration:none;
display:block;
}

.menu li a{
display:flex;
align-items:center;
gap:12px;
color:inherit;
text-decoration:none;
width:100%;
}

.menu li{
display:flex;
align-items:center;
gap:12px;
padding:12px 18px;
margin:2px 8px;
border-radius:10px;
cursor:pointer;
transition:0.2s;
color:#666;
font-size:14px;
}

.menu li:hover,
.menu li.active{
background:#4f7ef8;
color:#fff;
}

.main{
margin-left:250px;
padding:24px;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:28px;
}

.profile{
display:flex;
align-items:center;
gap:12px;
}

.profile img{
width:42px;
height:42px;
border-radius:50%;
border:2px solid #4f7ef8;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-bottom:28px;
}

.card{
padding:24px;
border-radius:18px;
box-shadow:0 2px 12px rgba(0,0,0,0.07);
display:flex;
align-items:center;
gap:16px;
}

.card-icon{
width:60px;
height:60px;
border-radius:14px;
display:flex;
align-items:center;
justify-content:center;
font-size:26px;
}

.card-info h2{
font-size:28px;
font-weight:700;
color:#1a1a2e;
}

.card-info p{
font-size:13px;
color:#666;
margin-top:2px;
}

.logout-btn{
background:#ff4d4d;
color:white;
padding:10px 16px;
border-radius:8px;
text-decoration:none;
font-size:13px;
}

@media(max-width:768px){

body{
overflow-x:hidden;
background:#eef4ff;
}

.sidebar{
width:80px;
height:100vh;
position:fixed;
left:0;
top:0;
z-index:1000;
overflow-y:auto;
}

.logo{
justify-content:center;
padding:16px 0;
}

.logo img{
width:42px;
height:42px;
}

.logo-text{
display:none;
}

.menu{
padding:10px 0;
}

.menu li{
padding:14px 0;
margin:6px 0;
justify-content:center;
}

.menu li a{
display:flex;
align-items:center;
justify-content:center;
width:100%;
}

.menu li span{
display:none;
}

.menu li i{
font-size:22px;
}

.main{
margin-left:80px;
width:calc(100% - 80px);
padding:14px;
}

.topbar{
flex-direction:column;
align-items:flex-start;
gap:10px;
margin-bottom:20px;
}

.topbar h2{
font-size:22px;
}

.cards{
display:grid;
grid-template-columns:1fr;
gap:16px;
width:100%;
}

.card{
width:100%;
padding:18px;
border-radius:18px;
}

.card-icon{
width:55px;
height:55px;
font-size:22px;
}

.card-info h2{
font-size:24px;
}

.profile img{
width:40px;
height:40px;
}

}

</style>
</head>
<body>

<?php if(!isset($_SESSION['admin'])){ ?>

<div id="loginPage">

<div class="login-card">

<div class="login-logo">
<h2>Government Polytechnic<br>Anakapalle</h2>
<p>Admin Portal</p>
</div>

<h3>Welcome Back 👋</h3>
<p class="sub">Sign in to your admin account</p>

<form method="POST">

<div class="form-group">
<label>Username</label>

<div class="input-wrap">
<i class='bx bx-user'></i>

<input type="text"
name="username"
placeholder="Enter admin username"
required>

</div>
</div>

<div class="form-group">

<label>Password</label>

<div class="input-wrap">

<i class='bx bx-lock'></i>

<input type="password"
name="password"
id="password"
placeholder="Enter password"
required>

<i class='bx bx-hide show-pass'
id="togglePass"
onclick="togglePassword()"></i>
</div>
</div>

<?php
if($error != ""){
echo "<p class='error-msg'>$error</p>";
}
?>
<button type="submit"
name="login"
class="login-btn">
Login
</button>

</form>
</div>
<a href="dashboard.php" class="back-btn">&larr; Back to dashboard</a>
</div>
<?php } else { ?>

<div id="dashboardPage">

<div class="sidebar">
    

<div class="logo">
<img src="logo1.png">
<div class="logo-text">
Government<br>
Polytechnic,<br>
Anakapalle
</div>
</div>
<ul class="menu">

<li class="active">
<a href="dashboard.php">
<i class='bx bxs-dashboard'></i>
<span>Dashboard</span>
</a>
</li>

<li>
<a href="admint.php">
<i class='bx bx-shield-quarter'></i>
<span>Admin</span>
</a>
</li>

<li>
<a href="login.html">
<i class='bx bxs-graduation'></i>
<span>Students</span>
</a>
</li>

<li>
<a href="teacher_index.php">
<i class='bx bx-chalkboard'></i>
<span>Teachers</span>
</a>
</li>

<li>
<a href="index1.php">
<i class='bx bx-calendar-star'></i>
<span>Attendance</span>
</a>
</li>
<li>
<a href="index.php">
<i class='bx bx-wallet'></i>
<span>Fees</span>
</a>
</li>

<li>
<a href="login1.php">
<i class='bx bx-bar-chart-square'></i>
<span>Results</span>
</a>
</li>

<li>
<a href="profile.php">
<i class='bx bx-user-circle'></i>
<span>Profile</span>
</a>
</li>

<li>
<a href="admint.php?logout=true">
<i class='bx bx-log-out'></i>
<span>Logout</span>
</a>
</li>

</ul>

</div>

<div class="main">

<div class="topbar">

<h2>
Welcome,
<?php echo $_SESSION['admin']; ?>
</h2>

<div class="profile">

<img src="admin.png" alt="Admin Profile">

</div>

</div>

<div class="cards">

<div class="card"
style="background:linear-gradient(135deg,#e8f0fe,#c2d4fc);">

<div class="card-icon"
style="background:#4f7ef8;">
<i class='bx bxs-graduation'
style="color:white;"></i>
</div>

<div class="card-info">
<h2><?php echo $total_students; ?></h2>
<p>Total Students</p>
</div>

</div>

<div class="card"
style="background:linear-gradient(135deg,#e6f9f0,#b2ecd4);">

<div class="card-icon"
style="background:#1db06a;">
<i class='bx bx-chalkboard'
style="color:white;"></i>
</div>

<div class="card-info">
<h2><?php echo $total_teachers; ?></h2>
<p>Total Teachers</p>
</div>

</div>

<div class="card"
style="background:linear-gradient(135deg,#fff4e6,#ffd59e);">

<div class="card-icon"
style="background:#ff9800;">

<i class='bx bx-wallet'
style="color:white;"></i>

</div>

<div class="card-info">
    <h2>₹<?php echo number_format($total_fees); ?></h2>
    <p>Total Fees</p>

    <h2 style="margin-top:10px;">₹<?php echo number_format($total_paid); ?></h2>
    <p>Fees Paid</p>

    <h2 style="margin-top:10px;">₹<?php echo number_format($total_due); ?></h2>
    <p>Fees Pending</p>
</div>

</div>
<div class="card"
style="background:linear-gradient(135deg,#f3e8ff,#d7b8ff);">

<div class="card-icon"
style="background:#9c27b0;">

<i class='bx bx-calendar-check'
style="color:white;"></i>

</div>

<div class="card-info">
<h2><?php echo $total_attendance; ?>%</h2>
<p>Attendance</p>
</div>

</div>
</div>

</div>
</div>

<?php } ?>

<script>

function togglePassword(){

const input = document.getElementById('password');

const icon = document.getElementById('togglePass');

if(input.type === 'password'){

input.type = 'text';

icon.className = 'bx bx-show show-pass';

}
else{

input.type = 'password';

icon.className = 'bx bx-hide show-pass';

}

}

</script>

</body>
</html>