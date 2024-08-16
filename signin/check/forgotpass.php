<?php
include '../../unithead/pages/backend/sanitize.php';
include '../../connection/connection.php';

$email = sanitizeQuillContent($_POST['email']);

$token = bin2hex(random_bytes(50));

$sql = "select * from user where email='" . $email . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $to = $_POST['email'];
        $subject = "Forgot Password (EVIDENTS)";
        $message = "
          Dear Mr/Ms. " . $row['userfname'] . ",
          <br><br>
          You have requested to reset your password for your Event Visualization and Insight documentation with enabling notification tracking system account <br />
          <br />
          To reset your password, please click the link below: <br />

          <a href='http://localhost/webtemp/signin/reset_password.php?token=" . $token . "'>evidents.dostmimaropa.gov.ph<a>.<br />
          
          If you did not request a password reset, please ignore this email.      
          <br /><br />
          Thank you,<br /><br />
          <b>EVIDENTS Administrator</b>
          <br /> <br />

          Privacy Note: All information entered in this site (including names, contact number and email address) will be used exclusively for the stated purposes of this site and will not be made available for any other purpose or to any other party. This is an automatically generated email, please do not reply.
          ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: EVIDENTS  Administrator <info_EVIDENTS@.dostmimaropa.ph>' . "\r\n";

        mail($to, $subject, $message, $headers);

        $sql = "UPDATE user SET `tokens`  = '" . $token . "'  WHERE email='" . $_POST['email'] . "'";
        if (mysqli_query($conn, $sql)) {
            header("Location:../index.php?message=Success");
        }

        //SMS
    }
} else {
    echo 'Email not Found';
}
