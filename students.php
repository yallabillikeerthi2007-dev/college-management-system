```php
<?php

session_start();

/* LOGIN CHECK */

if(!isset($_SESSION['admin']))
{
    header("Location: login1.php");
    exit();
}

/* DATABASE CONNECTION */

$conn = new mysqli("localhost", "root", "", "college_management");

if($conn->connect_error)
{
    die("Connection Failed : " . $conn->connect_error);
}

/* CLEAR RESULTS */

if(isset($_POST['clear']))
{
    $conn->query("TRUNCATE TABLE result");
}

/* ADD RESULT */

if(isset($_POST['add']))
{
    $name       = $_POST['name'];
    $pin        = $_POST['pin'];
    $year       = $_POST['year'];
    $semester   = $_POST['semester'];
    $branch     = $_POST['branch'];

    $sub1_name  = $_POST['sub1_name'];
    $sub2_name  = $_POST['sub2_name'];
    $sub3_name  = $_POST['sub3_name'];
    $sub4_name  = $_POST['sub4_name'];
    $sub5_name  = $_POST['sub5_name'];

    $sub1 = $_POST['sub1'];
    $sub2 = $_POST['sub2'];
    $sub3 = $_POST['sub3'];
    $sub4 = $_POST['sub4'];
    $sub5 = $_POST['sub5'];

    $total = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;

    $percentage = ($total / 500) * 100;

    /* GRADE */

    if($percentage >= 90)
    {
        $grade = "A+";
    }
    elseif($percentage >= 75)
    {
        $grade = "A";
    }
    elseif($percentage >= 60)
    {
        $grade = "B";
    }
    elseif($percentage >= 40)
    {
        $grade = "C";
    }
    else
    {
        $grade = "Fail";
    }

    /* RESULT */

    if(
        $sub1 >= 35 &&
        $sub2 >= 35 &&
        $sub3 >= 35 &&
        $sub4 >= 35 &&
        $sub5 >= 35
    )
    {
        $result = "Pass";
    }
    else
    {
        $result = "Fail";
    }

    /* INSERT */

    $stmt = $conn->prepare("INSERT INTO result
    (
        student_name,
        pin,
        year,
        semester,
        branch,

        sub1_name,
        sub2_name,
        sub3_name,
        sub4_name,
        sub5_name,

        sub1,
        sub2,
        sub3,
        sub4,
        sub5,

        total,
        percentage,
        grade,
        result
    )

    VALUES
    (
        ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?,
        ?, ?, ?, ?
    )");

    $stmt->bind_param(
        "ssssssssssiiiiiidss",

        $name,
        $pin,
        $year,
        $semester,
        $branch,

        $sub1_name,
        $sub2_name,
        $sub3_name,
        $sub4_name,
        $sub5_name,

        $sub1,
        $sub2,
        $sub3,
        $sub4,
        $sub5,

        $total,
        $percentage,
        $grade,
        $result
    );

    $stmt->execute();
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Polytechnic Result System</title>

<style>

body{
    margin:0;
    padding:30px;
    font-family:Arial;
    background:linear-gradient(135deg,#0d47a1,#42a5f5);
}

.container{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0px 5px 20px rgba(0,0,0,0.3);
}

h1{
    text-align:center;
    font-size:45px;
    color:#1565c0;
}

.top-button{
    text-align:right;
    margin-bottom:20px;
}

.logout-btn{
    background:gold;
    color:black;
    padding:12px 25px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

form{
    text-align:center;
}

input,select{
    padding:14px;
    margin:8px;
    font-size:16px;
    border:2px solid #90caf9;
    border-radius:8px;
}

.name-box{
    width:220px;
}

.pin-box{
    width:200px;
}

.mark-box{
    width:180px;
}

.add-btn{
    background:green;
    color:white;
    border:none;
    padding:14px 30px;
    font-size:17px;
    border-radius:8px;
    cursor:pointer;
}

.reset-btn{
    background:red;
    color:white;
    border:none;
    padding:14px 30px;
    font-size:17px;
    border-radius:8px;
    cursor:pointer;
}

.subject-box{
    background:#f5f9ff;
    padding:20px;
    border-radius:15px;
    margin-top:20px;
}

.subject-title{
    font-size:28px;
    color:#1565c0;
    margin-bottom:20px;
    font-weight:bold;
}

.subject-row{
    margin-bottom:15px;
}

label{
    font-weight:bold;
    margin-right:10px;
    display:inline-block;
    width:260px;
    text-align:left;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:30px;
}

th{
    background:#1565c0;
    color:white;
    padding:14px;
}

td{
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
}

tr:nth-child(even){
    background:#f5f5f5;
}

.pass{
    color:green;
    font-weight:bold;
}

.fail{
    color:red;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h1>Polytechnic Result System</h1>

<div class="top-button">
<a href="logout1.php" class="logout-btn">Logout</a>
</div>

<form method="POST">

<input type="text"
name="name"
class="name-box"
placeholder="Student Name"
required>

<input type="text"
name="pin"
class="pin-box"
placeholder="Student PIN"
required>

<br>

<select name="year" id="year" onchange="loadSemesters()" required>

<option value="">Select Year</option>

<option value="1st Year">1st Year</option>
<option value="2nd Year">2nd Year</option>
<option value="3rd Year">3rd Year</option>

</select>

<select name="semester" id="semester" onchange="loadSubjects()" required>

<option value="">Select Semester</option>

</select>

<select name="branch" onchange="loadSubjects()" required>

<option value="">Select Branch</option>

<option value="CME">CME</option>
<option value="ECE">ECE</option>

</select>

<div id="subjects-area"></div>

<br><br>

<button type="submit" name="add" class="add-btn">
Add Result
</button>

<button
type="submit"
name="clear"
class="reset-btn"
onclick="return confirm('Delete All Results?')">
Clear Results
</button>

</form>

<?php

$result_data = $conn->query("SELECT * FROM result");

if($result_data->num_rows > 0)
{
    echo "<table>";

    echo "
    <tr>
        <th>Name</th>
        <th>PIN</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Branch</th>
        <th>Total</th>
        <th>Percentage</th>
        <th>Grade</th>
        <th>Result</th>
    </tr>";

    while($row = $result_data->fetch_assoc())
    {
        $class = ($row['result'] == 'Pass') ? 'pass' : 'fail';

        echo "
        <tr>
            <td>".$row['student_name']."</td>
            <td>".$row['pin']."</td>
            <td>".$row['year']."</td>
            <td>".$row['semester']."</td>
            <td>".$row['branch']."</td>
            <td>".$row['total']."</td>
            <td>".round($row['percentage'],1)."%</td>
            <td>".$row['grade']."</td>
            <td class='$class'>".$row['result']."</td>
        </tr>";
    }

    echo "</table>";
}

?>

</div>

<script>

/* LOAD SEMESTERS */

function loadSemesters()
{
    let year = document.getElementById("year").value;

    let semesterDropdown = document.getElementById("semester");

    let options = `<option value="">Select Semester</option>`;

    if(year == "1st Year")
    {
        options += `
        <option value="1st Year">
        1st Year
        </option>
        `;
    }

    else if(year == "2nd Year")
    {
        options += `

        <option value="2nd Year - 3rd Sem">
        2nd Year - 3rd Sem
        </option>

        <option value="2nd Year - 4th Sem">
        2nd Year - 4th Sem
        </option>

        `;
    }

    else if(year == "3rd Year")
    {
        options += `

        <option value="3rd Year - 5th Sem">
        3rd Year - 5th Sem
        </option>

        <option value="3rd Year - 6th Sem">
        3rd Year - 6th Sem
        </option>

        `;
    }

    semesterDropdown.innerHTML = options;

    document.getElementById("subjects-area").innerHTML = "";
}

/* LOAD SUBJECTS */

function loadSubjects()
{
    let semester = document.getElementById("semester").value;

    let branch = document.querySelector("select[name='branch']").value;

    let subjects = "";

    if(branch == "CME")
    {
        if(semester == "1st Year")
        {
            subjects = createSubjects(
                "English",
                "Mathematics1",
                "Physics",
                "Chemistry",
                "Engineering Drawing"
            );
        }

        else if(semester == "2nd Year - 3rd Sem")
        {
            subjects = createSubjects(
                "Data Structures",
                "Digital Electronics",
                "DBMS",
                "Operating System",
                "Mathematics2"
            );
        }

        else if(semester == "2nd Year - 4th Sem")
        {
            subjects = createSubjects(
                "Java",
                "Co&MP",
                "Computer Networks",
                "Web Technology",
                "Software Engineering"
            );
        }

        else if(semester == "3rd Year - 5th Sem")
        {
            subjects = createSubjects(
                "Industrial Management",
                "Big Data and Cloud Computing",
                "Android Programming",
                "IOT",
                "Python"
            );
        }

        else if(semester == "3rd Year - 6th Sem")
        {
            subjects = createSubjects(
                "Industrial Training",
                "Major Project",
                "Seminar",
                "Professional Ethics",
                "Viva"
            );
        }
    }

    else if(branch == "ECE")
    {
        if(semester == "1st Year")
        {
            subjects = createSubjects(
                "English",
                "Mathematics1",
                "Physics",
                "Chemistry",
                "Engineering Drawing"
            );
        }

        else if(semester == "2nd Year - 3rd Sem")
        {
            subjects = createSubjects(
                "Electronic Devices",
                "Network Analysis",
                "Digital Electronics",
                "Communication Systems",
                "Mathematics2"
            );
        }

        else if(semester == "2nd Year - 4th Sem")
        {
            subjects = createSubjects(
                "Microcontrollers",
                "Linear IC Applications",
                "Digital Communication",
                "Electronic Measurements",
                "Computer Hardware"
            );
        }

        else if(semester == "3rd Year - 5th Sem")
        {
            subjects = createSubjects(
                "Embedded Systems",
                "VLSI",
                "Wireless Communication",
                "Industrial Management",
                "Consumer Electronics"
            );
        }

        else if(semester == "3rd Year - 6th Sem")
        {
            subjects = createSubjects(
                "Industrial Training",
                "Major Project",
                "Seminar",
                "Professional Ethics",
                "Viva"
            );
        }
    }

    document.getElementById("subjects-area").innerHTML = subjects;
}

/* SUBJECT TEMPLATE */

function createSubjects(sub1, sub2, sub3, sub4, sub5)
{
    return `

    <div class="subject-box">

    <div class="subject-title">
    Enter Subject Marks
    </div>

    <div class="subject-row">

    <input type="hidden" name="sub1_name" value="${sub1}">

    <label>${sub1}</label>

    <input type="number"
    name="sub1"
    class="mark-box"
    placeholder="Marks"
    required
    min="0"
    max="100">

    </div>

    <div class="subject-row">

    <input type="hidden" name="sub2_name" value="${sub2}">

    <label>${sub2}</label>

    <input type="number"
    name="sub2"
    class="mark-box"
    placeholder="Marks"
    required
    min="0"
    max="100">

    </div>

    <div class="subject-row">

    <input type="hidden" name="sub3_name" value="${sub3}">

    <label>${sub3}</label>

    <input type="number"
    name="sub3"
    class="mark-box"
    placeholder="Marks"
    required
    min="0"
    max="100">

    </div>

    <div class="subject-row">

    <input type="hidden" name="sub4_name" value="${sub4}">

    <label>${sub4}</label>

    <input type="number"
    name="sub4"
    class="mark-box"
    placeholder="Marks"
    required
    min="0"
    max="100">

    </div>

    <div class="subject-row">

    <input type="hidden" name="sub5_name" value="${sub5}">

    <label>${sub5}</label>

    <input type="number"
    name="sub5"
    class="mark-box"
    placeholder="Marks"
    required
    min="0"
    max="100">

    </div>

    </div>

    `;
}

</script>

</body>

</html>
```
