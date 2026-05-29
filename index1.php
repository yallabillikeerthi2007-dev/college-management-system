<!DOCTYPE html>
<html>

<head>

<title>College Attendance System</title>

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

/* MAIN BOX */

.container{
    width:450px;
    background:white;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 8px 25px rgba(0,0,0,0.25);
    animation:fadeIn 1s ease;
}

/* LOGO */

.logo{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#0d47c7;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    font-size:38px;
    font-weight:bold;
    margin-bottom:20px;
}

/* HEADING */

h2{
    color:#0d47c7;
    font-size:32px;
    margin-bottom:10px;
    text-transform:uppercase;
}

p{
    color:#666;
    font-size:16px;
    margin-bottom:35px;
}

/* BUTTONS */

.btn{
    display:block;
    width:100%;
    text-decoration:none;
    padding:15px;
    margin-top:18px;
    border-radius:12px;
    font-size:17px;
    font-weight:bold;
    color:white;
    transition:0.3s;
}

/* BUTTON COLORS */

.mark-btn{
    background:#0d47c7;
}

.mark-btn:hover{
    background:#08389c;
    transform:scale(1.03);
}

.report-btn{
    background:#16a34a;
}

.report-btn:hover{
    background:#15803d;
    transform:scale(1.03);
}

/* FOOTER */

.footer{
    margin-top:25px;
    font-size:13px;
    color:gray;
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

.container{
    width:90%;
    padding:25px;
}

h2{
    font-size:25px;
}

.btn{
    font-size:15px;
}

}

</style>

</head>

<body>

<div class="container">

    <!-- LOGO -->

    <div class="logo">
        A
    </div>

    <!-- TITLE -->

    <h2>College Attendance System</h2>

    <p>
        Smart Attendance Management Portal
    </p>

    <!-- BUTTONS -->

    <a href="attendance_login.php" class="btn mark-btn">
        Mark Attendance
    </a>

    <a href="attendance_report.php" class="btn report-btn">
        View Attendance Report
    </a>

    <!-- FOOTER -->

    <div class="footer">
        Govt Polytechnic Anakapalli
    </div>

</div>

</body>
</html>