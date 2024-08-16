<?php
session_start();
if ($_SESSION['id'] == "") header("Location:../../../");

include '../../../connection/connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = "SELECT * from report where report_id= '" . $_GET['id'] . "'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];
        $report_type = $row['report_type'];
    }
}

$status++;

$sql = "UPDATE report SET `status`  = $status, `revision_count` = '0', `revision_remarks`=''  WHERE report_id='" . $_GET['id'] . "'";
if (mysqli_query($conn, $sql)) {
    switch ($report_type) {
        case 1:
            sleep(3);
            header("Location:../minutes.php");
            break;
        case 2:
            sleep(3);
            header("Location:../training.php");
            break;
        case 3:
            sleep(3);
            header("Location:../travel.php");
            break;
    }
}
mysqli_close($conn);
