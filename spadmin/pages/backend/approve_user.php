<?php
session_start();
if ($_SESSION['id'] == "") header("Location:../../../");

include '../../../connection/connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE user SET `user_status`  = 1  WHERE user_id='" . $_GET['id'] . "'";
if (mysqli_query($conn, $sql)) {

    header("Location:../users.php");
}
mysqli_close($conn);
