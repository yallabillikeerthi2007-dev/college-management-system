<?php
session_start();
session_destroy();
header("Location: teacher_index.php");
exit();
?>