<?php
if (isset($_POST['download_zip'])) {
    $zip = new ZipArchive();
    $zipName = 'downloaded_files_' . time() . '.zip';

    if ($zip->open($zipName, ZipArchive::CREATE) !== TRUE) {
        exit("Cannot open <$zipName>\n");
    }

    foreach ($_POST['file_ids'] as $file_id) {
        $sql = "SELECT * FROM files WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $file_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $file = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($file) {
            $filepath = 'uploads/' . $file['name'];
            if (file_exists($filepath)) {
                $zip->addFile($filepath, $file['name']);

                // Update downloads count
                $newCount = $file['downloads'] + 1;
                $updateQuery = "UPDATE files SET downloads = ? WHERE id = ?";
                $stmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($stmt, "ii", $newCount, $file_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipName);
    header('Content-Length: ' . filesize($zipName));
    readfile($zipName);
    unlink($zipName); // Delete the temporary zip file
    exit();
}
