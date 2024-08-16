<?php
header('Content-Type: application/json');

$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . uniqid() . '_' . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    echo json_encode(["success" => false, "message" => "File is not an image."]);
    exit();
}

// Check file size (5MB limit)
if ($_FILES["image"]["size"] > 5000000) {
    echo json_encode(["success" => false, "message" => "Sorry, your file is too large."]);
    exit();
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo json_encode(["success" => false, "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
    exit();
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $url = '/your-project-path/' . $target_file; // Adjust this path
    echo json_encode(["success" => true, "url" => $url]);
} else {
    echo json_encode(["success" => false, "message" => "Sorry, there was an error uploading your file."]);
}
