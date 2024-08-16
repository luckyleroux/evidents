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
imp_agency = ?,
venue = ?,
person_attended = ?,
highlights = ?,
shared = ?,
shared_unit =?,
date_conducted = ?,
date_updated = ?
WHERE report_id = ?";

include 'sanitize.php';

$title = sanitizeQuillContent($_POST['title']);
$imp_agency = sanitizeQuillContent($_POST['imp_agency']);
$venue = sanitizeQuillContent($_POST['venue']);
$person_attend = sanitizeQuillContent($_POST['person_attend']);
$cleaned_content = sanitizeQuillContent($_POST['content']);

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssiissi",
    $_POST['type'],
    $title,
    $imp_agency,
    $venue,
    $person_attend,
    $content,
    $_POST['privacy'],
    $shared_unit,
    $_POST['conduct'],
    $date_updated,
    $_POST['id']
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
