<?php
include("db.php");

mysqli_query($conn, "DELETE FROM users WHERE role='admin'");

echo "Deleted!";
?>