<?php
include '../../connection/connection.php';
$user = $_POST["username"];
$password = sha1($_POST["password"]);
$sql = "select * from user where username='" . $user . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $auth = password_verify($password, $row['password']);
        if ($auth) {
            if ($row['user_status'] != 0) {
                //active
                session_start();
                $_SESSION['level'] = $row['access_level'];
                $_SESSION['id'] = $row['user_id'];
                $sqlx = "UPDATE user set attempts = '0' where user_id = '" . $row['user_id'] . "'";
                mysqli_query($conn, $sqlx);

                if ($_SESSION['level'] == 0) {
                    header("Location: ../../spadmin/pages/");
                }
                if ($_SESSION['level'] == 1) {
                    if ($row['unit_id'] == 0) {
                        header("Location:../../divisionhead/pages/profile.php");
                    } else {
                        header("Location:../../divisionhead/pages/");
                    }
                }
                if ($_SESSION['level'] == 2) {
                    if ($row['unit_id'] == 0) {
                        header("Location:../../unithead/pages/profile.php");
                    } else {
                        header("Location:../../unithead/pages/");
                    }
                }
                if ($_SESSION['level'] == 3) {
                    if ($row['unit_id'] == 0) {
                        header("Location:../../user/pages/profile.php");
                    } else {
                        header("Location:../../user/pages/");
                    }
                }
            } else {
                // inactive
                $message = "Please contact the administrator to reactivate the account.";
                header("Location:../index.php?status=5&message=" . urlencode($message));
            }
        } else {
            //incorrect password
            $attempts = 0;
            if ($row['user_status'] != 0) {
                $sql1 = "UPDATE user set attempts = '" . ($row['attempts'] + 1) . "' where user_id = '" . $row['user_id'] . "'";
                mysqli_query($conn, $sql1);

                $sql2 = "select * from user where user_id='" . $row['user_id'] . "'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        if ($row2['attempts'] < 5) {
                            $message = "Incorrect password.";
                            header("Location:../index.php?attempts=" . $row2["attempts"] . "&message=" . urlencode($message));
                        } else {
                            $sql3 = "UPDATE users set status = '0' where user_id = '" . $row['user_id'] . "'";
                            mysqli_query($conn, $sql3);
                            $message = "Account has been locked.";
                            header("Location:../index.php?status=5&message=" . urlencode($message));
                        }
                    }
                }
            } else {
                //
                $message = "Account has been locked.";
                header("Location:../index.php?status=5&message=" . urlencode($message));
            }
        }
    }
} else {
    //no user
    $message = "User not found.";
    header("Location:../index.php?message=" . urlencode($message));
}
