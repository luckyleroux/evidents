<?php
session_start();
date_default_timezone_set('Asia/Manila');

if ($_SESSION['id'] == "") header("Location:../../../");

include '../../../connection/connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $shared_unit = ($_POST['privacy'] == 1) ? 0 : $_POST['unit'];
$shared_unit = 0;

if ($_POST['privacy'] == 2) {
    $shared_unit = $_POST['unit'];
}

$date_encoded = date('Y-m-d H:i:s');  // Current date and time

$sql = "INSERT INTO report (report_type, report_title, venue, imp_agency, person_attended, highlights, concern, action_request, deadline_action, remarks,
shared, shared_unit, user_id, date_conducted, date_submitted)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

include 'sanitize.php';

$title = sanitizeQuillContent($_POST['title']);
$venue = sanitizeQuillContent($_POST['venue']);
$imp_agency = sanitizeQuillContent($_POST['imp_agency']);
$person_attend = sanitizeQuillContent($_POST['person_attend']);
$concerns = sanitizeQuillContent($_POST['concerns']);
$action_taken = sanitizeQuillContent($_POST['action_taken']);
$remarks = sanitizeQuillContent($_POST['remarks']);

$cleaned_content = sanitizeQuillContent($_POST['content']);
// Use $sanitized_content when inserting into the database

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssssssiiiss",
    $_POST['type'],
    $title,
    $venue,
    $imp_agency,
    $person_attend,
    $cleaned_content,
    $concerns,
    $action_taken,
    $_POST['deadline'],
    $remarks,
    $_POST['privacy'],
    $shared_unit,
    $_SESSION['id'],
    $_POST['conduct'],
    $date_encoded
);

if ($stmt->execute()) {
    $report_id = $stmt->insert_id;
    echo "Post saved successfully!";
} else {
    echo "Error: " . $stmt->error;
    exit;
}

$stmt->close();

// for uploading multiple images

if (isset($_FILES['myfile'])) {
    $uploadedImages = $_FILES['myfile'];

    // Create uploads directory if it doesn't exist
    $upload_dir = '../../../uploads';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    foreach ($uploadedImages['name'] as $key => $filename) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $hashname = sha1($filename . time() . $key) . '.' . $extension;
        $destination = $upload_dir . $hashname;

        $file = $uploadedImages['tmp_name'][$key];
        $size = $uploadedImages['size'][$key];

        if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
            echo "Error: Your file extension must be .png, .jpg, or .jpeg for file: $filename<br>";
        } elseif ($size > 1000000) { // file shouldn't be larger than 1Megabyte
            echo "Error: File too large: $filename<br>";
        } else {
            if (move_uploaded_file($file, $destination)) {
                echo "File moved to: $destination<br>";
                $sql = "INSERT INTO image_storage (img_name, img_ext, report_id, date_created) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssis", $hashname, $extension, $report_id, $date_encoded);
                if ($stmt->execute()) {
                    echo "Report has been successfully submitted";
                }
                $stmt->close();
            }
        }
    }
}

$conn->close();
