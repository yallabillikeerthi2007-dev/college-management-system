<?php

$conn = new mysqli("localhost", "root", "", "college_management");

$result = null;

if(isset($_POST['search']))
{
    $pin = $_POST['pin'];

    $sql = "SELECT * FROM results WHERE pin='$pin'";

    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Result</title>

<style>
<?php

$conn = new mysqli("localhost", "root", "", "college_management");

$result = null;

if(isset($_POST['search']))
{
    $pin = $_POST['pin'];

    $sql = "SELECT * FROM results WHERE pin='$pin'";

    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Result</title>

<style>
<style>

body{
    font-family: Arial;
    background: linear-gradient(135deg,#0d47a1,#42a5f5);
    padding: 30px;
    min-height: 100vh;
}

.container{
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.3);
    max-width: 900px;
    margin: auto;
}

h1{
    text-align: center;
    color: #0d47a1;
    margin-bottom: 30px;
}

form{
    text-align: center;
    margin-bottom: 30px;
}

input{
    padding: 15px;
    width: 300px;
    font-size: 18px;
    border: 2px solid #90caf9;
    border-radius: 8px;
    outline: none;
}

input:focus{
    border-color: #1565c0;
    box-shadow: 0px 0px 8px rgba(21,101,192,0.5);
}

button{
    background: linear-gradient(to right,#1565c0,#1e88e5);
    color: white;
    border: none;
    padding: 15px 25px;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover{
    background: linear-gradient(to right,#0d47a1,#1565c0);
    transform: scale(1.03);
}

table{
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 10px;
}

th{
    background: #0d47a1;
    color: white;
    padding: 15px;
    font-size: 17px;
}

td{
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
    background: #f9fbff;
}

tr:hover td{
    background: #e3f2fd;
}

.pass{
    color: green;
    font-weight: bold;
}

.fail{
    color: red;
    font-weight: bold;
}

h2{
    margin-top: 20px;
}

</style>


</style>

</head>

<body>

<div class="container">

<h1>Check Your Result</h1>

<form method="POST">

<input type="text"
       name="pin"
       placeholder="Enter Student PIN"
       required>

<button type="submit"
        name="search">
        Search
</button>

</form>

<?php

if($result && $result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {

?>

<table>

<tr>
    <th>Name</th>
    <th>PIN</th>
    <th>Total</th>
    <th>Percentage</th>
    <th>Result</th>
    <th>Grade</th>
</tr>

<tr>

<td><?php echo $row['student_name']; ?></td>

<td><?php echo $row['pin']; ?></td>

<td><?php echo $row['total']; ?></td>

<td><?php echo round($row['percentage'],1); ?>%</td>

<td class="<?php echo strtolower($row['result']); ?>">
<?php echo $row['result']; ?>
</td>

<td><?php echo $row['grade']; ?></td>

</tr>

</table>

<?php

    }
}
elseif(isset($_POST['search']))
{
    echo "<h2 style='color:red;text-align:center;'>No Result Found</h2>";
}

?>

</div>

</body>

</html>

