
<?php
include("db.php");

session_start();

$pin_no = $_SESSION['pin_no'] ?? '';

$query = "SELECT * FROM studs WHERE pin_no='$pin_no'";

$result = mysqli_query($con,$query);

$row = mysqli_fetch_assoc($result);


if(!isset($_SESSION['role']) || $_SESSION['role']!="student"){
    header("Location: login.php");
    exit();
}

$con = mysqli_connect("localhost","root","","college_management");

if(!$con){
    die("Database connection failed");
}

$studentData = null;
$message = "";

if(isset($_POST['search'])){

    $name   = trim($_POST['name']);
    $branch = trim($_POST['branch']);
    $pin_no  = trim($_POST['pin_no']);

//$pinno=$_SESSION['pinno'];

    // Query (case-insensitive + trim)
    $sql = "SELECT * FROM studs 
            WHERE LOWER(TRIM(name)) = LOWER(TRIM('$name'))
            AND LOWER(TRIM(branch)) = LOWER(TRIM('$branch'))
            AND LOWER(TRIM(pin_no)) = LOWER(TRIM('$pin_no'))";

    $result = mysqli_query($con,$sql);

    if($result){
        if(mysqli_num_rows($result) > 0){
            $studentData = mysqli_fetch_assoc($result);
        }
        else{
            $message = "Invalid Details ";
        }
    }
    else{
        $message = "Query Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>

    <style>
        body{
            font-family: Arial;
            background: #f2f2f2;
            margin: 0;
        }

       /* .header{
            background: darkblue;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }*/

        .box{
            width: 650px;
            background: white;
            padding: 25px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
        }

        label{
            font-weight: bold;
        }

        input, select{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid gray;
        }

        button{
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover{
            background: #0056b3;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td{
            border: 1px solid gray;
        }

        th, td{
            padding: 10px;
            text-align: center;
        }

        th{
            background: lightblue;
        }

        .logout{
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background: darkblue;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
        }

        .msg{
            text-align:center;
            font-weight:bold;
            color:red;
            margin-top:15px;
        }
    </style>
</head>

<body>

<div style="text-align:center;background:darkblue;color:white;padding:15px;font-size:22px;font-weight:bold;">GOVT POLYTECHNIC ANAKAPALLI</div>

<div class="box">

    <h2>Enter Student Details</h2>

    <form method="POST">

        <label>NAME *</label>
        <input type="text" name="name" required placeholder="Enter Name">

        <label>BRANCH *</label>
        <select name="branch" required>
            <option value="">-- Select Branch --</option>
            <option value="CME">CME</option>
            <option value="ECE">ECE</option>
            <option value="EEE">EEE</option>
            <option value="CIVIL">CIVIL</option>
            <option value="MECH">MECH</option>
        </select>

        <label>PIN NO *</label>
        <input type="text" name="pin_no" required placeholder="Enter PIN No">

        <button type="submit" name="search">View Details</button>

    </form>

    <!-- Error Message -->
    <?php
    if($message != ""){
        echo "<div class='msg'>$message</div>";
    }
    ?>

    <!-- Student Details -->
    <?php if($studentData != null){ ?>

    <h2 style="margin-top:30px;">Student Fees Details</h2>

    <table>
           <tr> 
            <th>PIN No</th>
            <td><?php echo $studentData['pin_no'] ??''; ?></td>
        </tr>

        <tr>
            <th>Name</th>
            <td><?php echo $studentData['name']; ?></td>
        </tr>
          <tr>
            <th>Branch</th>
            <td><?php echo $studentData['branch']; ?></td>
        </tr>

        <tr>
            <th>Year</th>
            <td><?php echo $studentData['year']; ?></td>
        </tr>
       
                    <tr>
            <th>Phone No</th>
            <td><?php echo $studentData['phone']; ?></td>
        </tr>
                <tr>
            <th>Total Fee</th>
            <td><?php echo $studentData['total_fee']; ?></td>
        </tr>
        <tr>
            <th>Paid Fee</th>
            <td><?php echo $studentData['paid_fee']; ?></td>
        </tr>
           <tr>
            <th>BAlance Fee</th>
            <td><?php echo $studentData['balance_fee']; ?></td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td><?php echo $studentData['due_date']; ?></td>
        </tr>
    </table>

    <?php } ?>

    <a class="logout" href="logout.php">Logout</a>

</div>

</body>
</html>