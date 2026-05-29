<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include "db_connect.php";
$branch = $_GET["branch"];
$year = $_GET["year"];

$query = "SELECT * FROM students WHERE dept='$branch' AND year='$year'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
echo "<form method='POST' action='save_attendance.php'>";
echo "<input type='hidden' name='branch' value='$branch'>";
echo "<input type='hidden' name='year' value='$year'>";
echo "<input type='hidden' name='date' value='".date('Y-m-d')."'>";
echo "<table border='1'>";
echo "<tr><th>SNo</th><th>Name</th><th>ID</th><th>Attendance</th></tr>";
while($row = mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>".$row["sno"]."</td>";
echo "<td>".$row["name"]."</td>";
echo "<td>".$row["id"]."</td>";
echo "<td>
<input type='radio' name='status[".$row["id"]."]' value='Present' required> Present
<input type='radio' name='status[".$row["id"]."]' value='Absent'> Absent
</td>";
echo "</tr>";
}
echo "</table><br>";
echo "<button type='submit'>Save Attendance</button>";
echo "</form>";
}else{
echo "<p>No students found for this branch and year!</p>";
}
?>