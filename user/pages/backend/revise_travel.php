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
report_title = ?,
requesting_organizer = ?,
venue = ?,
date_conducted = ?,
highlights = ?,
concern = ?,
follow_up_act = ?,
importance_of_the_activity = ?,
shared = ?,
shared_unit = ?,
date_submitted = ?,
date_updated = ?
WHERE report_id = ?";

include 'sanitize.php';

$title = sanitizeQuillContent($_POST['title']);
$requesting = sanitizeQuillContent($_POST['requesting']);
$venue = sanitizeQuillContent($_POST['venue']);
$conduct = sanitizeQuillContent($_POST['conduct']);
$concerns = sanitizeQuillContent($_POST['concerns']);
$followup = sanitizeQuillContent($_POST['followup']);
$importance = sanitizeQuillContent($_POST['importance']);
$cleaned_content = sanitizeQuillContent($_POST['content']);
// Use $sanitized_content when inserting into the database
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssiissi",
    $title,
    $requesting,
    $venue,
    $conduct,
    $content,
    $concerns,
    $followup,
    $importance,
    $_POST['privacy'],
    $shared_unit,
    $_POST['submitted'],
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
