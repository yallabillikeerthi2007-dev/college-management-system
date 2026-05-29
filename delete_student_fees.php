<?php
include("db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $query = "DELETE FROM studs WHERE id='$id'";

    if(mysqli_query($con, $query))
    {
        echo "<script>alert('Student Deleted Successfully'); window.location='admin_dashboard.php';</script>";
    }
    else
    {
        echo "Error: " . mysqli_error($con);
    }
}
else
{
    echo "<script>alert('Invalid Request'); window.location='admin_dashboard.php';</script>";
}
?>