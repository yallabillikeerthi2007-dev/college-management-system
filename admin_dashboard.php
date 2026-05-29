<html>
<head>
<title>Student Module</title>

<style>

body
{
margin:0;
font-family:Arial,sans-serif;
background:#f2f2f2;
}

/* Header */

.header
{
background:#004aad;
color:white;
padding:15px 30px;
display:flex;
align-items:center;
justify-content:space-between;
}

.header-left
{
display:flex;
align-items:center;
gap:15px;
}

.header-left img
{
width:60px;
height:60px;
border-radius:50%;
background:white;
padding:5px;
}

.header-left h1
{
margin:0;
font-size:24px;
}

header-right
{
text-align:right;
font-size:14px;
line-height:20px;
}

/* Form */

form
{
width:500px;
margin:30px auto;
background:white;
padding:25px;
border-radius:12px;
box-shadow:0px 0px 10px rgba(0,0,0,0.2);
min-height:500px;
}

label
{
font-weight:bold;
display:block;
margin-top:10px;
}

input[type="text"],
select
{
width:95%;
padding:10px;
margin-top:5px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:8px;
font-size:15px;
}

/* Radio */

.gender,
.dept
{
width:auto;
margin-right:10px;
}

/* Photo */

.photo-field
{
margin-top:5px;
margin-bottom:15px;
}

.photo-field input
{
margin-top:5px;
width:95%;
}

/* Buttons */

#add
{
border:none;
padding:10px 20px;
background:green;
color:white;
font-size:16px;
border-radius:8px;
cursor:pointer;
font-weight:bold;
}

#add:hover
{
background:darkgreen;
}

#reset
{
background:#004aad;
color:white;
border:none;
padding:10px 20px;
font-size:16px;
border-radius:8px;
cursor:pointer;
margin-left:10px;
}

#reset:hover
{
background:#003580;
}

/* Search */

.searchbox
{
width:300px;
margin:20px auto;
text-align:center;
}

#search
{
width:100%;
padding:10px;
border-radius:8px;
border:1px solid #ccc;
}

/* Table */

table
{
width:95%;
margin:auto;
background:white;
border-collapse:collapse;
box-shadow:0px 0px 10px rgba(0,0,0,0.2);
border-radius:10px;
overflow:hidden;
}

th
{
background:#004aad;
color:white;
padding:12px;
font-size:14px;
}

td
{
text-align:center;
padding:10px;
border-bottom:1px solid #ddd;
}

/* Delete */

.delete
{
border:none;
background:red;
color:white;
padding:6px 10px;
border-radius:6px;
cursor:pointer;
margin:2px;
font-size:14px;
}

.delete:hover
{
background:darkred;
}

/* Edit */

.edit
{
border:none;
background:orange;
color:white;
padding:6px 10px;
border-radius:6px;
cursor:pointer;
margin:2px;
font-size:14px;
}

.edit:hover
{
background:darkorange;
}

/* Logout */

.logout-btn
{
padding:12px 25px;
background:indigo;
color:white;
border:none;
border-radius:10px;
cursor:pointer;
font-size:16px;
font-weight:bold;
}

.logout-btn:hover
{
background:red;
}

</style>

<script>

function AddStudent()
{
let sname=document.getElementById('nm').value;

let sid=document.getElementById('n').value;

let sg=document.getElementsByName('gender');

let gender="";

for(let k=0;k<sg.length;k++)
{
if(sg[k].checked)
{
gender=sg[k].value;
}
}

let r=document.getElementsByName('dept');

let dept="";

for(let i=0;i<r.length;i++)
{
if(r[i].checked)
{
dept=r[i].value;
}
}

let syear=document.getElementById('y').value;

let sphno=document.getElementById('pn').value;

if(sname=='' || sid=='' || gender=='' || dept=='' || syear=='' || sphno=='')
{
alert("Fill complete details in the form");

return false;
}

if(sphno.length!=10)
{
alert("Phone number should contain 10 digits");

return false;
}

return true;
}

document.addEventListener("DOMContentLoaded",function()
{
let search=document.getElementById("search");

search.addEventListener("keyup",function()
{
let filter=search.value.toLowerCase();

let rows=document.querySelectorAll("#tbody tr");

rows.forEach(function(row)
{
let text=row.textContent.toLowerCase();

if(text.indexOf(filter)>-1)
{
row.style.display="";
}

else
{
row.style.display="none";
}
});
});
});

</script>

</head>

<body>

<div class="header">
GOVT POLYTECHNIC ANAKAPALLI
</div>

<form method="POST"
action="insertion.php"
enctype="multipart/form-data">

<label>Name</label>

<input type="text"
name="stname"
id="nm">

<label>Id</label>

<input type="text"
name="id"
id="n">

<label>Gender</label><br>

<input type="radio"
name="gender"
value="Male"
class="gender">Male

<input type="radio"
name="gender"
value="Female"
class="gender">Female

<input type="radio"
name="gender"
value="Other"
class="gender">Other

<br><br>

<label>Department</label><br>

<input type="radio"
name="dept"
value="CME"
class="dept">CME

<input type="radio"
name="dept"
value="ECE"
class="dept">ECE

<br><br>

<label>Year</label>

<select id="y" name="y">

<option value="">--Select Year--</option>

<option>2022-2025</option>
<option>2023-2026</option>
<option>2024-2027</option>
<option>2025-2028</option>
<option>2026-2029</option>

</select>

<label>Phone Number</label>

<input type="text"
name="phno"
id="pn">

<div class="photo-field">

<label>Photo</label>

<input type="file"
name="photo">

</div>

<center>

<button type="submit"
id="add"
onclick="return AddStudent()">

Add

</button>

<input type="reset"
id="reset"
value="Reset">

</center>

</form>

<div class="searchbox">

<input type="text"
name="search"
id="search"
placeholder="Search student details">

</div>

<table border="1">

<thead>

<tr>

<th>Name</th>
<th>Id</th>
<th>Gender</th>
<th>Dept</th>
<th>Year</th>
<th>Phone No</th>
<th>Functions</th>

</tr>

</thead>

<tbody id="tbody">

<?php include 'fetching.php'; ?>

</tbody>

</table>

<br><br>

<center>

<a href="logout.php">

<button type="button"
class="logout-btn">

Logout

</button>

</a>

</center>

</body>
</html>