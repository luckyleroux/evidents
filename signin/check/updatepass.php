<?php

include '../../connection/connection.php';
$token = '';

$sql1 = "SELECT * from user where tokens='" . $_POST['token'] . "'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE user SET `password`  = '" . $_POST['newpassword'] . "', `tokens` = '" . $token . "'  WHERE tokens='" . $_POST['token'] . "'";
    if (mysqli_query($conn, $sql)) {
        header("Location:../index.php?message=Success");
    }
} else {
    header("Location:../index.php?message=Failed");
}
