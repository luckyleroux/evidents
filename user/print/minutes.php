<?php
session_start();
include '../../connection/connection.php';
$sql = "SELECT * from report
where report_id='" . $_GET['id'] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['report_title'];
        $imp_agency = $row['imp_agency'];
        $venue = $row['venue'];
        $conduct = $row['date_conducted'];
        $person_attend = $row['person_attended'];
        $editor = $row['highlights'];
        $concern = $row['concern'];
        $deadline_req = $row['deadline_action'];
        $action_taken = $row['action_request'];
        $remarks = $row['remarks'];
        $date_submitted = date($row['date_submitted']);
        $privacy = $row['shared'];
        $unit = $row['shared_unit'];
        $revision_remarks = $row['revision_remarks'];
        $title = $row['report_title'];
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>EVIDENTS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header,
        footer {
            flex-shrink: 0;
        }

        .content {
            margin-bottom: 30mm;
        }

        @media print {
            body {
                width: 210mm;
                height: 297mm;
            }

            .page-container {
                height: 297mm;
                page-break-after: always;
            }

            header {
                position: running(header);
            }

            footer {
                position: fixed;
                bottom: 0;
                left: 10mm;
                right: 10mm;
                width: calc(100% - 20mm);
            }

            .content {
                margin-bottom: 30mm;
            }

            @page {
                size: A4;
                margin: 20mm 10mm 10mm 10mm;

                @top-center {
                    content: element(header);
                }

                @bottom-center {
                    content: element(footer);
                }
            }


            table {
                width: 100%;
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            td,
            th {
                word-wrap: break-word;
                max-width: 50%;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            footer .row {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
            }

            footer .col-md-9 {
                flex: 1;
            }

            footer .col-md-3 {
                flex: 0 0 auto;
            }
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .text-container {
            margin-left: 20px;
        }

        .certification-container {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="card">
            <div class="card-header">
                <div class="logo-container">
                    <img src="../Assets/dost mimaropa.jpg" alt="Dost Logo" width="120" height="120">
                    <div class="text-container">
                        <h6>Republic of the Philippines</h6>
                        <h4><b>DEPARTMENT OF SCIENCE AND TECHNOLOGY</b></h4>
                        <h6>MIMAROPA Region</h6>
                    </div>
                </div>
                <div class="certification-container">
                    <img src="../Assets/iso-2015.jpg" alt="ISO Logo" width="120" height="120">
                    <img src="../Assets/PQA.png" alt="PQA Logo" width="120" height="120">
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="animated fadeIn">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong></strong>
                    </div>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Title of activity:</th>
                                    <td><?= $title ?></td>
                                </tr>
                                <tr>
                                    <th>Venue:</th>
                                    <td><?= $venue ?></td>
                                </tr>
                                <tr>
                                    <th>Date conducted:</th>
                                    <td><?= date_format(date_create($conduct), "F d, Y") ?></td>
                                </tr>
                                <tr>
                                    <th>Implementing agency:</th>
                                    <td><?= $imp_agency ?></td>
                                </tr>
                                <tr>
                                    <th>Person's who attended:</th>
                                    <td><?= $person_attend ?></td>
                                </tr>
                                <tr>
                                    <th>Highlights of the activity:</th>
                                    <td>
                                        <?= $editor ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Concerns the RD should know:</th>
                                    <td><?= $concern ?></td>
                                </tr>
                                <tr>
                                    <th>Action request/s coming from the activity:</th>
                                    <td><?= $action_taken ?></td>
                                </tr>
                                <tr>
                                    <th>Deadline for action request/s:</th>
                                    <td><?= date_format(date_create($deadline_req), "F d, Y") ?></td>
                                </tr>
                                <tr>
                                    <th>Action Taken:</th>
                                    <td><?= $remarks ?></td>
                                </tr>
                                <tr>
                                    <th>Remarks:</th>
                                    <td><?= $remarks ?></td>
                                </tr>
                                <tr>
                                    <th>Date submitted:</th>
                                    <td><?= date_format(date_create($date_submitted), "F d, Y") ?></td>
                                </tr>
                                <tr>
                                    <th>Signature/s of staff:</th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="row">
            <div class="col-md-9">
                <h6>
                    <div>Postal Address: DOST-MIMAROPA, 4/F PTRI Bldg. Gen. Santos Ave., Bicutan, Taguig City</div>
                    <div>Telefax No.: 8837-3755</div>
                    <div>URL: http://www.region4b.dost.gov.ph</div>
                    <div>Email Address: official@mimaropa.dost.gov.ph</div>
                </h6>
            </div>
            <div class="col-md-3 text-right">
                <img src="../Assets/BP.png" alt="Dost Logo" style="max-width: 120px; max-height: 120px;">
            </div>
        </div>
    </footer>

    <script>
        window.print();
        window.onafterprint = function() {
            if (confirm("Print canceled. Go back to previous page?")) {
                window.history.back();
            }
        };
    </script>
</body>

</html>