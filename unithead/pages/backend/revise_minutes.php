<?php
session_start();
if ($_SESSION['id'] == "") header("Location:../../../");

include '../../../connection/connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = "SELECT * from report where report_id= '" . $_POST['report_id'] . "'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $revision_count = $row['revision_count'];
        $report_type = $row['report_type'];
    }
}
include 'sanitize.php';

$revision_count = $revision_count + 1;
$remarks = sanitizeQuillContent($_POST['revision_remarks']);
$sql = "UPDATE report SET `revision_remarks`  = '" . $remarks . "', `revision_count` = $revision_count  WHERE report_id='" . $_POST['report_id'] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Revision sent!";
}
mysqli_close($conn);
