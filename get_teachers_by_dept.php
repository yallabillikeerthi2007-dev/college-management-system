<?php
include "db.php";
$dept = $_GET["dept"];
$result = mysqli_query($conn, "SELECT * FROM teachers WHERE dept='$dept'");

if(mysqli_num_rows($result) == 0){
    echo "<p style='color:red;'>No teachers found in this department.</p>";
} else {
    echo "<form method='POST' action='save_teacher_attendance.php'>";
    echo "<input type='hidden' name='dept' value='$dept'/>";
    echo "<input type='hidden' name='date' id='date_val' value=''/>";
    echo "<table border='1' style='margin:20px auto;width:80%;border-collapse:collapse;'>
    <tr style='background:#28a745;color:white;'>
        <th>SNo</th>
        <th>Teacher ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Status</th>
    </tr>";
    $sno = 1;
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
        <td>{$sno}</td>
        <td>{$row['teacher_id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['dept']}</td>
        <td>
            <select name='status[{$row['teacher_id']}]'>
                <option value='Present'>Present</option>
                <option value='Absent'>Absent</option>
            </select>
            <input type='hidden' name='teacher_name[{$row['teacher_id']}]' value='{$row['name']}'/>
        </td>
        </tr>";
        $sno++;
    }
    echo "</table>";
    echo "<button type='submit' name='save' style='padding:10px 25px;background:#28a745;color:white;border:none;border-radius:25px;font-size:16px;cursor:pointer;'>Save Attendance</button>";
    echo "</form>";
}
?>