<?php

include 'db.php';

$sql="CREATE TABLE admin(aid INT AUTO_INCREMENT PRIMARY KEY,username VARCHAR(20),password VARCHAR(20))";

if(mysqli_query($con,$sql))
{
    echo "Admin table created successfully";
}
else
{
    echo "Table not created ".mysqli_error($con);
}

mysqli_close($con);

?>