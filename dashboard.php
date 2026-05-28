<?php

session_start();

include 'dbl.php';

if(!isset($_SESSION['student_pin'])){

    header("Location: loginpage.html");
    exit();
}

$pin = $_SESSION['student_pin'];

$stmt = $conn->prepare("SELECT * FROM students WHERE pin=?");

$stmt->bind_param("s", $pin);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $row = $result->fetch_assoc();
    $cgpa = $row['cgpa'];
$fees = $row['fees'];
    $branch = $row['branch'];
$year = $row['year'];
$semesterMap = [
    1 => "first_year",
    3 => "sem3",
    4 => "sem4",
    5 => "sem5",
    6 => "sem6"
];

$semester = isset($_GET['sem']) ? (int)$_GET['sem'] : 1;

if (!isset($semesterMap[$semester])) {
    $semester = 1;
}
$allowed = [1,3,4,5,6];

if(!in_array($semester, $allowed)){
    $semester = 1;
}

$subjects = [];
$marks = [];

$res_stmt = $conn->prepare("
    SELECT * 
    FROM result
    WHERE pin = ? 
    AND branch = ? 
    AND semester = ?
");

$res_stmt->bind_param("ssi", $pin, $branch, $semester);

$res_stmt->execute();

$res_result = $res_stmt->get_result();

if($res_result->num_rows > 0){

    $r = $res_result->fetch_assoc();

    $subjects = [
        $r['sub1_name'],
        $r['sub2_name'],
        $r['sub3_name'],
        $r['sub4_name'],
        $r['sub5_name']
    ];

    $marks = [
        $r['sub1'],
        $r['sub2'],
        $r['sub3'],
        $r['sub4'],
        $r['sub5']
    ];
}
if(empty($subjects)){
    $subjects = ["No Subjects"];
    $marks = [0];
}
    $att_stmt = $conn->prepare("
    SELECT 
        DATE(date) as d,
        status
    FROM attendance
    WHERE student_id=?
    ORDER BY date DESC
    LIMIT 30
");

$att_stmt->bind_param("s", $pin);
$att_stmt->execute();
$att_res = $att_stmt->get_result();

$total = 0;
$present = 0;

$dates = [];
$presentCount = [];

while($a = $att_res->fetch_assoc()){
    $dates[] = $a['d'];

    if($a['status'] == 'Present'){
        $presentCount[] = 1;
        $present++;
    } else {
        $presentCount[] = 0;
    }

    $total++;
}

$attendancePercent = ($total > 0) ? round(($present / $total) * 100, 2) : 0;

}else{

    session_destroy();

    header("Location: loginpage.html");
    exit();
}

$notifications = [];

if($attendancePercent < 60){
    $notifications[] = [
        "type" => "danger",
        "icon" => "bx-error",
        "title" => "Attendance Alert",
        "msg" => "Low attendance detected (" .$attendancePercent  . "%). Improve immediately."
    ];
}
elseif($attendancePercent < 75){
    $notifications[] = [
        "type" => "warning",
        "icon" => "bx-warning",
        "title" => "Attendance Alert",
        "msg" => "Attendance is average (" . $attendancePercent . "%). Try to improve."
    ];
}
else{
    $notifications[] = [
        "type" => "success",
        "icon" => "bx-check-circle",
        "title" => "Attendance Alert",
        "msg" => "Good attendance (" . $attendancePercent . "%). Keep it up!"
    ];
}

if($cgpa  >= 9){
    $notifications[] = [
        "type" => "success",
        "icon" => "bx-trophy",
        "title" => "Academic Performance",
        "msg" => "Excellent CGPA! Outstanding performance."
    ];
}
elseif($cgpa >= 7){
    $notifications[] = [
        "type" => "info",
        "icon" => "bx-happy",
        "title" => "Academic Performance",
        "msg" => "Good CGPA. You are doing well."
    ];
}
else{
    $notifications[] = [
        "type" => "danger",
        "icon" => "bx-trending-down",
        "title" => "Academic Performance",
        "msg" => "CGPA needs improvement. Focus on studies."
    ];
}

if($fees > 0){
    $notifications[] = [
        "type" => "warning",
        "icon" => "bx-wallet",
         "title" => "Fee Status",
        "msg" => "Fee pending: ₹" . $row['fees']
    ];
} else {
    $notifications[] = [
        "type" => "success",
        "icon" => "bx-check-shield",
         "title" => "Fee Status",
        "msg" => "All fees cleared successfully."
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    display:flex;
    background:#e8edf5;
    min-height:100vh;
    overflow-x:hidden;
}

.sidebar{
    width:260px;
    height:100vh;
    background:#fff;
    position:fixed;
    top:0;
    left:0;
    overflow:hidden;
    box-shadow:2px 0 10px rgba(0,0,0,0.08);
}

.sidebar.collapsed{
    width:70px;
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
}

.sidebar.collapsed .logo-text{
    display:none;
}

.menu{
    list-style:none;
    padding:12px 0;
}

.menu a{
    text-decoration:none;
    display:block;
}

.menu li{
    display:flex;
    align-items:center;
    gap:12px;
    padding:14px 18px;
    margin:6px 10px;
    border-radius:12px;
    cursor:pointer;
    transition:0.3s;
    color:#666;
    font-size:16px;
    white-space:nowrap;
}

.menu li:hover,
.menu li.active{
    background:#4f7ef8;
    color:#fff;
}

.menu li i{
    font-size:22px;
    min-width:25px;
}

.sidebar.collapsed .menu span{
    display:none;
}

.sidebar.collapsed .menu li{
    justify-content:center;
}

.main{
    margin-left:250px;
    width:calc(100% - 250px);
    padding:24px;
    transition:0.3s ease;
}

.main.expanded{
    margin-left:70px;
    width:calc(100% - 70px);
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
}

.topbar-left{
    display:flex;
    align-items:center;
    gap:16px;
}

.toggle-btn{
    background:#fff;
    border:none;
    width:38px;
    height:38px;
    border-radius:10px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    font-size:20px;
}

.search-box input{
    padding:10px 16px;
    border:none;
    border-radius:10px;
    outline:none;
    background:white;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
    width:260px;
}

.profile{
    display:flex;
    align-items:center;
    gap:12px;
}

.profile-name{
    font-weight:600;
    font-size:14px;
}

.profile img{
    width:42px;
    height:42px;
    border-radius:50%;
    border:2px solid #4f7ef8;
}

.cards{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-bottom:28px;
}

.card{
    padding:20px;
    border-radius:18px;
    box-shadow:0 2px 12px rgba(0,0,0,0.07);
    display:flex;
    align-items:center;
    gap:16px;
    transition:0.3s ease;
}

.card:hover{
    transform:translateY(-5px);
}

.card-info h2{
    font-size:22px;
    font-weight:700;
    color:#1a1a2e;
}

.card-info p{
    font-size:13px;
    color:#888;
}

.circle-wrap{
    position:relative;
    width:70px;
    height:70px;
}

.circle-wrap svg{
    transform:rotate(-90deg);
}

.circle-bg{
    fill:none;
    stroke:#eef2ff;
}

.circle-fg{
    fill:none;
    stroke-linecap:round;
}

.circle-label{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    font-size:11px;
    font-weight:700;
}

.graph-box{
    background:white;
    padding:22px;
    border-radius:18px;
    box-shadow:0 2px 12px rgba(0,0,0,0.07);
    margin-bottom:28px;
}

.graph-box h3{
    margin-bottom:16px;
}

.marks-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:12px;
    margin-top:20px;
}

.subject-card{
    background:#f7f9ff;
    border-radius:14px;
    padding:14px 10px;
    text-align:center;
}

.subject-mark{
    font-size:20px;
    font-weight:700;
    margin-top:5px;
}

.subject-name{
    font-size:12px;
    color:#666;
}

.notice-box{
    background:white;
    padding:22px;
    border-radius:18px;
    box-shadow:0 2px 12px rgba(0,0,0,0.07);
}

.notice-box h3{
    margin-bottom:16px;
}

.notices{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
}

.notice{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 14px;
    border-radius:12px;
    margin-bottom:10px;
    font-size:13px;
    font-weight:500;
}

.notice i{
    font-size:18px;
}

.success{
    background:#e7f9ee;
    border-left:4px solid #1db06a;
    color:#1a7f4b;
}

.warning{
    background:#fff4e5;
    border-left:4px solid #f0900a;
    color:#a86400;
}

.danger{
    background:#ffeaea;
    border-left:4px solid #ff4d4d;
    color:#b30000;
}

.info{
    background:#eaf2ff;
    border-left:4px solid #4f7ef8;
    color:#1f4fbf;
}

@media(max-width:900px){

    .cards{
        grid-template-columns:1fr 1fr;
    }

    .marks-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .notices{
        grid-template-columns:1fr;
    }
}

@media(max-width:768px){

    .sidebar{
        width:70px;
    }

    .main{
        margin-left:70px;
        width:calc(100% - 70px);
        padding:15px;
    }

    .cards{
        grid-template-columns:1fr;
    }

    .marks-grid{
        grid-template-columns:1fr 1fr;
    }

    .search-box input{ 
        width:150px;
    }

    .logo-text{
        display:none;
    }

    .menu span{
        display:none;
    }

    .menu li{
        justify-content:center;
    }
}

</style>

</head>

<body>

<div class="sidebar" id="sidebar">

    <div class="logo">

        <img src="./logo1.png" alt="Logo">

        <div class="logo-text">
            Government Polytechnic<br>
            Anakapalle
        </div>

    </div>

    <ul class="menu">

        <a href="dashboard.php">
            <li class="active">
                <i class='bx bxs-dashboard'></i>
                <span>Dashboard</span>
            </li>
        </a>

        <a href="admint.php">
            <li>
               <i class='bx bx-shield-quarter'></i>
                <span>Admin</span>
            </li>
        </a>

        <a href="login.html">
            <li>
                <i class='bx bxs-graduation'></i>
                <span>Student</span>
            </li>
        </a>

         <a href="teacher_index.php">
            <li>
                <i class='bx bx-chalkboard'></i>
                <span>Teachers</span>
            </li>
        </a>

        <a href="index1.php">
            <li>
                <i class='bx bx-calendar-star'></i>
                <span>Attendance</span>
            </li>
        </a>

        <a href="index.php">
            <li>
                <i class='bx bx-wallet'></i>
                <span>Fees</span>
            </li>
        </a>

        <a href="login1.php">
            <li>
                <i class='bx bx-bar-chart-square'></i>
                <span>Results</span>
            </li>
        </a>

        <a href="profile.php">
            <li>  
                <i class='bx bx-user-circle'></i>
                <span>Profile</span>
            </li>
        </a>

        <a href="logout.php">
            <li>
                <i class='bx bx-log-out'></i>
                <span>Logout</span>
            </li>
        </a>

    </ul>

</div>

<div class="main" id="main">

    <div class="topbar">

        <div class="topbar-left">

            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class='bx bx-menu'></i>
            </button>

            <div class="search-box">
                <input type="text" placeholder="Search here...">
            </div>

        </div>

        <div class="profile">

            <div class="profile-name">

                <?php echo htmlspecialchars($row['name']); ?>

            </div>

            <a href="profile.php">

              <?php
              $profilePic = (!empty($row['profile_pic']) && file_exists($row['profile_pic']))
              ? htmlspecialchars($row['profile_pic'])
              : 'default.png';
              ?>

               <img src="<?php echo $profilePic; ?>" alt="Profile">  

            </a>

        </div>

    </div>

    <div class="cards">

        <div class="card" style="background:linear-gradient(135deg,#e8f0fe,#c2d4fc);">

            <div class="circle-wrap">

                <svg width="70" height="70">

                    <circle class="circle-bg" cx="35" cy="35" r="28" stroke-width="6"></circle>

                    <circle class="circle-fg" cx="35" cy="35" r="28"
                    stroke-width="6"
                    stroke="#4f7ef8"
                    stroke-dasharray="175.93"
                    stroke-dashoffset="26.39"></circle>

                </svg>

                <div class="circle-label" style="color:#4f7ef8;">

                    <?php echo $attendancePercent; ?>%

                </div>

            </div>

            <div class="card-info">

                <h2><?php echo $attendancePercent; ?>%</h2>

                <p>Attendance</p>

            </div>

        </div>

        <div class="card" style="background:linear-gradient(135deg,#e6f9f0,#b2ecd4);">

            <div class="circle-wrap">

                <svg width="70" height="70">

                    <circle class="circle-bg" cx="35" cy="35" r="28" stroke-width="6"></circle>

                    <circle class="circle-fg" cx="35" cy="35" r="28"
                    stroke-width="6"
                    stroke="#1db06a"
                    stroke-dasharray="175.93"
                    stroke-dashoffset="22.87"></circle>

                </svg>

                <div class="circle-label" style="color:#1db06a;">

                    <?php echo htmlspecialchars($row['cgpa']); ?>

                </div>

            </div>

            <div class="card-info">

                <h2><?php echo htmlspecialchars($row['cgpa']); ?></h2>

                <p>CGPA</p>

            </div>

        </div>

        <div class="card" style="background:linear-gradient(135deg,#fff4e6,#ffd9a8);">

            <div class="circle-wrap">

                <svg width="70" height="70">

                    <circle class="circle-bg" cx="35" cy="35" r="28" stroke-width="6"></circle>

                    <circle class="circle-fg" cx="35" cy="35" r="28"
                    stroke-width="6"
                    stroke="#f0900a"
                    stroke-dasharray="175.93"
                    stroke-dashoffset="35.19"></circle>

                </svg>

                <div class="circle-label" style="color:#f0900a;">

                ₹<?php echo htmlspecialchars($row['fees']); ?>

                </div>

            </div>

            <div class="card-info">

                <h2>₹<?php echo htmlspecialchars($row['fees']); ?></h2>

                <p>pending fees</p>

            </div>

        </div>

    </div>

    <div class="graph-box">

        <h3>Student Marks Overview</h3>

        <form method="GET" style="margin-bottom:20px;">
    <label style="font-weight:600;">Select Semester:</label>

    <select name="sem" onchange="this.form.submit()"
        style="padding:8px 12px; border-radius:8px; border:1px solid #ccc; margin-left:10px;">

        <option value="1" <?php if($semester==1) echo "selected"; ?>>
            First Year
        </option>

        <option value="3" <?php if($semester==3) echo "selected"; ?>>
            Semester 3
        </option>

        <option value="4" <?php if($semester==4) echo "selected"; ?>>
            Semester 4
        </option>

        <option value="5" <?php if($semester==5) echo "selected"; ?>>
            Semester 5
        </option>

        <option value="6" <?php if($semester==6) echo "selected"; ?>>
            Semester 6
        </option>

    </select>
</form>
        <canvas id="marksChart" height="30"></canvas>

      <?php if(count($subjects) > 0){ ?>

<div class="marks-grid">

<?php for($i=0; $i<count($subjects); $i++){ ?>
    <div class="subject-card">
        <div class="subject-mark"><?php echo $marks[$i]; ?></div>
        <div class="subject-name"><?php echo $subjects[$i]; ?></div>
    </div>
<?php } ?>

</div>

<?php } else { ?>

<p>No marks uploaded yet.</p>

<?php } ?>  
</div>


    <div class="graph-box">
    <h3>Attendance Overview</h3>
    <canvas id="attendanceChart"></canvas>
</div>
<div class="notice-box">
    <h3>🔔 Notifications</h3>

    <?php foreach($notifications as $n){ ?>
    <div class="notice <?php echo $n['type']; ?>">

        <i class='bx <?php echo $n['icon']; ?>'></i>

        <div>
            <div style="font-weight:600; font-size:13px;">
                <?php echo $n['title']; ?>
            </div>
            <div style="font-size:12px; opacity:0.85;">
                <?php echo $n['msg']; ?>
            </div>
        </div>

    </div>
<?php } ?>

</div>

<script>

function toggleSidebar(){

    document.getElementById('sidebar').classList.toggle('collapsed');

    document.getElementById('main').classList.toggle('expanded');
}

const ctx = document.getElementById('marksChart').getContext('2d');

new Chart(ctx,{

    type:'line',

    data:{

        labels: <?php echo json_encode($subjects); ?>,

         datasets:[{
            label:'Marks',
            data: <?php echo json_encode($marks); ?>,
            borderColor:'#4f7ef8',
            backgroundColor:'rgba(79,126,248,0.08)',
            borderWidth:2.5,
            pointBackgroundColor:'#4f7ef8',
            pointRadius:5,
            fill:true,
            tension:0.4

        }]
    },

    options:{

        responsive:true,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{

            y:{
                min:0,
                max:100
            }
        }
    }
});


const att = document.getElementById('attendanceChart').getContext('2d');

new Chart(att, {
    type: 'line',
    data: {
        labels: <?php echo json_encode(array_reverse($dates)); ?>,
        datasets: [{
            label: 'Attendance',
            data: <?php echo json_encode(array_reverse($presentCount)); ?>,
            borderColor: '#1db06a',
            backgroundColor: 'rgba(29,176,106,0.2)',
            fill: true,
            tension: 0.3,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                min: 0,
                max:1,
                ticks:{
    callback:function(value){
        return value == 1 ? 'Present' : 'Absent';
     }
                }
        }
}
   
    }
});

</script>
<div style="text-align:center; margin-top:30px; color:#888; font-size:13px;">
    © 2026 Government Polytechnic Anakapalle
</div>

</body>

</html>