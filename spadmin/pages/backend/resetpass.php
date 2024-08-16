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
$pass = "dost4b";
$def_pass = password_hash(sha1($pass), PASSWORD_BCRYPT, ['cost' => 12]);

$sql = "UPDATE user SET 
password = ?,
date_updated = ?
WHERE user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssi",
    $def_pass,
    $date_updated,
    $_GET['id']
);

// Execute the statement
if ($stmt->execute()) {
    header("Location: ../users.php");
} else {
    echo "Error: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
