<?php
include("db.php");

$search = "";
$branch = "";
$year = "";

$query = "SELECT * FROM studs WHERE 1";

$show_back = false;

if(isset($_GET['search_btn']))
{
    $search = $_GET['search'];
    $branch = $_GET['branch'];
    $year = $_GET['year'];

    $show_back = true;

    if($search != "")
    {
        $query .= " AND (
            pin_no LIKE '%$search%'
            OR name LIKE '%$search%'
        )";
    }

    if($branch != "")
    {
        $query .= " AND branch='$branch'";
    }

    if($year != "")
    {
        $query .= " AND year='$year'";
    }
}

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f2f2f2;
}

.header{
    background:#004aad;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.header-left img{
    width:60px;
    height:60px;
    border-radius:50%;
    background:white;
    padding:5px;
}

.header-left h1{
    margin:0;
    font-size:24px;
}

.header-right{
    text-align:right;
    font-size:14px;
}

.top-bar{
    width:95%;
    margin:25px auto;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.search-box{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
}

.add-btn{
    background:green;
    color:white;
    padding:10px 18px;
    border:none;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}

.add-btn:hover{
    background:darkgreen;
}

.container{
    width:95%;
    margin:25px auto;
    background:white;
    padding:15px;
    border-radius:10px;
    box-shadow:0px 0px 10px rgba(0,0,0,0.2);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#004aad;
    color:white;
    padding:12px;
    font-size:14px;
}

td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
    font-size:14px;
}

tr:hover{
    background:#f9f9f9;
}

.btn-view{
    background:green;
    color:white;
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.btn-update{
    background:orange;
    color:white;
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.btn-delete{
    background:red;
    color:white;
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.icons a{
    margin:0 5px;
    font-size:18px;
    text-decoration:none;
}

.call{
    color:blue;
}

.whatsapp{
    color:green;
}

.bottom-logout{
    text-align:center;
    margin:20px auto;
}

.logout-btn{
    background:red;
    color:white;
    padding:12px 25px;
    border-radius:10px;
    text-decoration:none;
    font-size:16px;
    font-weight:bold;
    display:inline-block;
}

.logout-btn:hover{
    background:darkred;
}

</style>

</head>

<body>

<div class="header">

<div class="header-left">

<img src="./college_logo.jpg.jpeg" alt="College Logo">

<h1>GOVT POLYTECHNIC ANAKAPALLI</h1>

</div>

<div class="header-right">

<p>
<i class="fa-solid fa-building"></i>
College Code: <b>AKP24173</b>
</p>

<p style="text-align:center; margin-top:15px;">

📧 Email :

<a href="mailto:polytechnic.government173@gmail.com"
style="text-decoration:none; color:white; font-weight:bold;">

polytechnic.government173@gmail.com

</a>

</p>

</div>

</div>

<div class="top-bar">

<form method="GET" class="search-box">

<!-- SEARCH BOX -->

<div style="position:relative;">

<i class="fa-solid fa-magnifying-glass"
style="
position:absolute;
left:10px;
top:12px;
color:gray;
"></i>

<input type="text"
name="search"
placeholder="Search Pin / Name"
value="<?php echo $search; ?>"
style="
padding:10px 10px 10px 35px;
border-radius:8px;
border:1px solid #ccc;
width:250px;
">
<button type="submit"
name="search_btn"
style="
padding:10px 15px;
border:none;
background:#004aad;
color:white;
border-radius:8px;
cursor:pointer;
">

<i class="fa-solid fa-magnifying-glass"></i> Search

</button>

</div>

<!-- FILTER BUTTON -->

<div style="position:relative; display:inline-block;">

<button type="button"
onclick="toggleFilter()"
style="
padding:10px 15px;
border:none;
background:#004aad;
color:white;
border-radius:8px;
cursor:pointer;
">

<i class="fa-solid fa-filter"></i> Filter

</button>

<div id="filterBox"
style="
display:none;
position:absolute;
top:50px;
left:0;
background:white;
padding:15px;
border-radius:10px;
box-shadow:0px 0px 10px rgba(0,0,0,0.2);
z-index:100;
width:220px;
">

<select name="branch"
style="
width:100%;
padding:10px;
margin-bottom:10px;
border-radius:8px;
">

<option value="">Select Branch</option>

<option value="CME">CME</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MECH">MECH</option>

</select>

<select name="year"
style="
width:100%;
padding:10px;
margin-bottom:10px;
border-radius:8px;
">

<option value="">Select Year</option>

<option value="1st Year">1st Year</option>
<option value="2nd Year">2nd Year</option>
<option value="3rd Year">3rd Year</option>

</select>

<button type="submit"
name="search_btn"
style="
width:100%;
padding:10px;
background:green;
color:white;
border:none;
border-radius:8px;
">

Check

</button>

</div>

</div>

<?php
if($show_back == true)
{
?>

<a href="admin_dashboard.php">

<button type="button"
style="
padding:10px 15px;
border:none;
background:gray;
color:white;
border-radius:8px;
cursor:pointer;
">

<i class="fa-solid fa-arrow-left"></i> Back

</button>

</a>

<?php
}
?>

</form>

<a href="add_student.php">

<button class="add-btn">

<i class="fa-solid fa-user-plus"></i>
Add Student

</button>

</a>

</div>

<div class="container">

<table>

<tr>

<th>S.No</th>
<th>Pin No</th>
<th>Name</th>
<th>Branch</th>
<th>Year</th>
<th>Phone</th>
<th>Total Fee</th>
<th>Paid Fee</th>
<th>Balance Fee</th>
<th>Due Date</th>
<th>View</th>
<th>Update</th>
<th>Delete</th>

</tr>

<?php

$sno = 1;

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

<tr>

<td><?php echo $sno; ?></td>

<td><?php echo $row['pin_no']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['branch']; ?></td>

<td><?php echo $row['year']; ?></td>

<td class="icons">

<?php echo $row['phone']; ?>

<a href="https://wa.me/91<?php echo $row['phone']; ?>"
target="_blank"
class="whatsapp">

<i class="fa-brands fa-whatsapp"></i>

</a>

<a href="tel:<?php echo $row['phone']; ?>"
class="call">

<i class="fa-solid fa-phone"></i>

</a>

</td>

<td><?php echo $row['total_fee']; ?></td>

<td><?php echo $row['paid_fee']; ?></td>

<td><?php echo $row['balance_fee']; ?></td>

<td><?php echo $row['due_date']; ?></td>

<td>

<a href="view_student.php?id=<?php echo $row['id']; ?>">

<button class="btn-view">View</button>

</a>

</td>

<td>

<a href="update_student.php?id=<?php echo $row['id']; ?>">

<button class="btn-update">Update</button>

</a>

</td>

<td>

<a href="delete_student.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this student?');">

<button class="btn-delete">Delete</button>

</a>

</td>

</tr>

<?php
$sno++;
}
}
else
{
?>

<tr>

<td colspan="13"
style="color:red;font-weight:bold;padding:15px;">

No Results Found

</td>

</tr>

<?php
}
?>

</table>

</div>

<div class="bottom-logout">

<a href="logout.php" class="logout-btn">

<i class="fa-solid fa-right-from-bracket"></i>
Logout

</a>

</div>

<script>

function toggleFilter()
{
    var box = document.getElementById("filterBox");

    if(box.style.display == "block")
    {
        box.style.display = "none";
    }
    else
    {
        box.style.display = "block";
    }
}

</script>

</body>
</html>