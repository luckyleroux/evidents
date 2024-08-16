<?php
session_start();
include '../../connection/connection.php';
$sql = "SELECT * from user u 
left join unit_details ud on ud.unit_id = u.unit_id
left join division_details divi on ud.division_id = divi.division_id
where user_id='" . $_SESSION['id'] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['userfname'];
        $level = $row['access_level'];
        $unit = $row['unit_acr'];
        $unit_id = $row['unit_id'];
        $unit_name = $row['unit_name'];
        $email = $row['email'];
        $division = $row['division_name'];
        $division_acr = $row['division_acr'];
    }
}
switch ($level) {
    case 0:
        $level = 'Admin';
        break;
    case 1:
        $level = 'Division Head';
        break;
    case 2:
        $level = 'Unit Head';
        break;
    case 3:
        $level = 'User';
        break;
    default:
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>EVIDENTS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">EVIDENTS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $unit ?> - <?= $level ?></span>
                    </a><!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $unit ?> - <?= $level ?></h6>
                            <span><?= $level ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="signout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li clas <li class="nav-item">
                <a class="nav-link <?php if ($pages != 'index') {
                                        echo 'collapsed';
                                    } ?>" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link <?php if ($pages != 'minutes' && $pages != 'training' && $pages != 'travel') {
                                        echo 'collapsed';
                                    } ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide "></i><span>Events</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse <?php if ($pages == 'minutes' || $pages == 'training' || $pages == 'travel') {
                                                                        echo ' show';
                                                                    } ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="minutes.php" <?php if ($pages == 'minutes') {
                                                    echo 'class="active"';
                                                } ?>>
                            <i class="bi bi-circle"></i><span>Minutes of the Meeting</span>
                        </a>
                    </li>
                    <li>
                        <a href="training.php" <?php if ($pages == 'training') {
                                                    echo 'class="active"';
                                                } ?>>
                            <i class="bi bi-circle"></i><span>Training</span>
                        </a>
                    </li>
                    <li>
                        <a href="travel.php" <?php if ($pages == 'travel') {
                                                    echo 'class="active"';
                                                } ?>>
                            <i class="bi bi-circle"></i><span>Travel</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
            <li clas <li class="nav-item">
                <a class="nav-link <?php if ($pages != 'reports') {
                                        echo ' collapsed';
                                    } ?>" href="reports.php">
                    <i class="bi bi-collection"></i>
                    <span>Reports</span>
                </a>
            </li><!-- End Dashboard Nav -->


    </aside><!-- End Sidebar-->