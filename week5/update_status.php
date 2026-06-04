<?php
session_start();

if (isset($_SESSION['order'])) {
    $_SESSION['order']['status'] = "DELIVERED";
}

header("Location: track_order.php");
exit();
?>