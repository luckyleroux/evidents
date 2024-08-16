<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
<link rel="stylesheet" href="logincss/style.css">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVIDENTS</title>
</head>

<body>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Forgot Password</h4>
                                            <form action="check/updatepass.php" method="POST">
                                                <div class="form-group">
                                                    <input type="text" name="token" id="token" value="<?= $_GET['token'] ?>" hidden>
                                                    <input type="text" name="newpassword" class="form-style" placeholder="Enter new password" id="newpassword" autocomplete="off" required>
                                                    <i class="input-icon uil uil-key-skeleton-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="verifypassword" class="form-style" placeholder="Confirm new password" id="verifypassword" autocomplete="off" required>
                                                    <i class="input-icon uil uil-key-skeleton-alt"></i>
                                                </div>
                                                <a href="index.php" class="btn mt-4">Back</a>
                                                <button type="submit" class="btn mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_GET['status'])) {
    if ($_GET['status'] == 1) {
        echo '<script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Account has been created"
            });
        </script>';
    } else {
        echo '<script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Account has not created"
            });
        </script>';
    }
} ?>

</html>