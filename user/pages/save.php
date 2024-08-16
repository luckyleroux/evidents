<?php
session_start();
date_default_timezone_set('Asia/Manila');

if ($_SESSION['id'] == "") header("Location:../../../");

include '../../connection/connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$shared_unit = ($_POST['privacy'] == 1) ? 0 : $_POST['unit'];
$date_encoded = date('Y-m-d H:i:s');  // Current date and time

$sql = "INSERT INTO report (report_type, report_title, venue, imp_agency, person_attended, highlights, concern, action_request, deadline_action, remarks,
shared, shared_unit, user_id, date_conducted, date_submitted)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssssssiiiss",
    $_POST['type'],
    $_POST['title'],
    $_POST['venue'],
    $_POST['imp_agency'],
    $_POST['person_attend'],
    $_POST['content'],
    $_POST['concerns'],
    $_POST['action_taken'],
    $_POST['deadline'],
    $_POST['remarks'],
    $_POST['privacy'],
    $shared_unit,
    $_SESSION['id'],
    $_POST['conduct'],
    $date_encoded
);

if ($stmt->execute()) {
    echo "Post saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
