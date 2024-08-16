<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'evidents');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No report ID provided");
}

$report_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch files for the given report_id
$sql = "SELECT * FROM image_storage WHERE report_id = '$report_id'";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Download files as zip
$zip = new ZipArchive();
$zipName = 'downloaded_files_' . time() . '.zip';

if ($zip->open($zipName, ZipArchive::CREATE) !== TRUE) {
    exit("Cannot open <$zipName>\n");
}

foreach ($files as $file) {
    $filepath = '../../../uploads/' . $file['img_name'];
    if (file_exists($filepath)) {
        $zip->addFile($filepath, $file['img_name']);
    }
}

$zip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $zipName);
header('Content-Length: ' . filesize($zipName));
readfile($zipName);
unlink($zipName); // Delete the temporary zip file

mysqli_close($conn);
exit();
