<?php
include 'db.php';

$sql = "SELECT * FROM student ORDER BY Id ASC";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Id']."</td>";
        echo "<td>".$row['Gender']."</td>";
        echo "<td>".$row['Department']."</td>";
        echo "<td>".$row['Year']."</td>";
        echo "<td>".$row['Phno']."</td>";
        echo "<td>
            <!-- Delete Button -->
            <form method='POST' action='deletion.php' style='display:inline;'>
                <input type='hidden' name='id' value='".$row['Id']."'>
                <button type='submit' class='delete'>Delete</button>
            </form>

            <!-- Update Button -->
            <form method='POST'action='edit.php'style='display:inline;'>
                  <input type='hidden' name='id'value='".$row['Id']."'>
                  <button type='submit' class='edit'>Update</button>
                  </form>
                  </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}

mysqli_close($con);
?>
