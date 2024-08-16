<?php
// Start Session
session_start();

// Get the actual date in Manila
date_default_timezone_set('Asia/Manila');

// Remove unauthorized users
if ($_SESSION['id'] == "") header("Location:../../../");

// Include the  database connection php script
include '../../../connection/connection.php';
$date_updated = date("Y-m-d | H:i:s");

$sql = "UPDATE report SET 
report_type = ?,
report_title=?,
venue = ?,
imp_agency = ?,
person_attended = ?,
highlights = ?,
concern = ?,
action_request = ?,
deadline_action = ?,
remarks = ?,
shared = ?,
shared_unit =?,
date_conducted = ?,
date_updated = ?
WHERE report_id = ?";

include 'sanitize.php';

$title = sanitizeQuillContent($_POST['title']);
$venue = sanitizeQuillContent($_POST['venue']);
$imp_agency = sanitizeQuillContent($_POST['imp_agency']);
$person_attend = sanitizeQuillContent($_POST['person_attend']);
$concerns = sanitizeQuillContent($_POST['concerns']);
$action_taken = sanitizeQuillContent($_POST['action_taken']);
$remarks = sanitizeQuillContent($_POST['remarks']);
$sanitized_content = sanitizeQuillContent($_POST['content']);

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssssssiissi",
    $_POST['type'],
    $title,
    $venue,
    $imp_agency,
    $person_attend,
    $sanitized_content,
    $concerns,
    $action_taken,
    $_POST['deadline'],
    $remarks,
    $_POST['privacy'],
    $shared_unit,
    $_POST['conduct'],
    $date_encoded,
    $_POST['report_id']
);

// Execute the statement
if ($stmt->execute()) {
    echo 'Successfully submitted';
} else {
    echo "Error: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
