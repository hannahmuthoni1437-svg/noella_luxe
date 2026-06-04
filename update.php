<?php
include("db.php");

mysqli_query($conn, "UPDATE users SET password='leila45' WHERE id ='202'");

echo "Updated!";
?>