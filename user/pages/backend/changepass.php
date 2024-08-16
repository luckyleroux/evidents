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

$password = sha1($_POST["password"]);
$renewpassword = password_hash(sha1($_POST['renewpassword']), PASSWORD_BCRYPT, ['cost' => 12]);
$sql = "select * from user where user_id='" . $_SESSION['id'] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $current_pass = $row['password'];
    }
}

$auth = password_verify($password, $current_pass);
if ($auth) {
    if ($_POST['renewpassword'] == $_POST['newpassword']) {
        $sql = "UPDATE user SET 
        password = ?,
        date_updated = ?
        WHERE user_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssi",
            $renewpassword,
            $date_updated,
            $_SESSION['id']
        );
        if ($stmt->execute()) {
            header("Location: ../profile.php?status=1");
        } else {
            echo "Error: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../profile.php?status=2");
    }
} else {
    header("Location: ../profile.php?status=3");
}
// Execute the statement
