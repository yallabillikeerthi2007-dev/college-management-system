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

body{
    font-family: Arial;
    background: #f4f4f4;
    padding: 30px;
}

.container{
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}

h1{
    text-align: center;
    color: #1565c0;
}

form{
    text-align: center;
    margin-bottom: 30px;
}

input{
    padding: 15px;
    width: 300px;
    font-size: 18px;
    border: 2px solid #ddd;
    border-radius: 6px;
}

button{
    background: #1565c0;
    color: white;
    border: none;
    padding: 15px 25px;
    font-size: 18px;
    border-radius: 6px;
    cursor: pointer;
}

table{
    width: 100%;
    border-collapse: collapse;
}

th{
    background: #1565c0;
    color: white;
    padding: 15px;
}

td{
    border: 1px solid #ccc;
    padding: 15px;
    text-align: center;
}

.pass{
    color: green;
    font-weight: bold;
}

.fail{
    color: red;
    font-weight: bold;
}

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