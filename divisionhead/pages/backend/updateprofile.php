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

$sql = "UPDATE user SET 
userfname = ?,
email = ?,
date_updated = ?
WHERE user_id = ?";

include 'sanitize.php';
$fullname = sanitizeQuillContent($_POST['fullname']);
$email = sanitizeQuillContent($_POST['email']);
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssi",
    $fullname,
    $email,
    $date_updated,
    $_SESSION['id']
);

// Execute the statement
if ($stmt->execute()) {
    header("Location: ../profile.php");
} else {
    echo "Error: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
