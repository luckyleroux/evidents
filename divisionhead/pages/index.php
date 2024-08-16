<?php
$pages = "index";
include 'template/header.php';
include 'backend/sanitize.php';

$users = 0;
$revision_count = 0;
$approved_count = 0;
$sql1 = "SELECT * from report rep
left join user us on rep.user_id = us.user_id 
left join unit_details un on us.unit_id = un.unit_id
left join division_details divi on un.division_id = divi.division_id
where status = 1 and divi.division_id='" . $division_id . "'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $users = $users + 1;
  }
}
$sql2 = "SELECT * from report where status = 2 and revision_count >0 and user_id='" . $unit_id . "'";
$result = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $revision_count = $revision_count + 1;
  }
}
$sql3 = "SELECT * from report where status = 2 && revision_count = 0 && user_id='" . $unit_id . "' || status = 3 && revision_count = 0 && user_id='" . $unit_id . "'";
$result = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $approved_count = $approved_count + 1;
  }
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">User <span>| <?= $division_acr ?></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $users ?></h6>
                    <span class="text small pt-1 fw-bold"><?= $division ?></span><span class="text-muted small pt-2 ps-1">User</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Report <span>| Approved</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-check2-square"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $revision_count ?></h6>
                    <span class="text small pt-1 fw-bold">Approved </span><span class="text-muted small pt-2 ps-1">Report</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-6">
            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Report <span>| Pending</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-hand-thumbs-down"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $approved_count ?></h6>
                    <span class="text small pt-1 fw-bold">Pending</span> <span class="text-muted small pt-2 ps-1">Report</span>

                  </div>
                </div>

              </div>
            </div>

          </div>


          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h5 class="card-title">Recent File</h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Implementing Agency</th>
                      <th scope="col">Type of Report</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Date Conducted</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * from report rep 
                    left join user us on us.user_id = rep.user_id 
                    left join unit_details ud on ud.unit_id = us.unit_id
                    where us.user_id = '" . $_SESSION['id'] . "' ORDER BY rep.date_created DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        switch ($row['report_type']) {
                          case '1':
                            $type = 'Minutes of the Meeting';
                            break;
                          case '2':
                            $type = 'Training Report';
                            break;
                          case '3':
                            $type = 'Travel Report';
                            break;
                          default:
                            break;
                        }
                    ?>
                        <tr>
                          <td><?= $row['report_id'] ?></td>
                          <td><?= sanitizeQuillContent($row['report_title']) ?></td>
                          <td><?= sanitizeQuillContent($row['imp_agency']) ?></td>
                          <td><?= $type ?></td>
                          <td><?= $row['unit_name'] ?></td>
                          <td><?= $row['date_conducted'] ?></td>
                          <td><?php
                              switch ($row['status']) {
                                case 1:
                                  if ($row['revision_count'] == 0) {
                                    echo "<span class='badge bg-warning'>Pending</span>";
                                  } else {
                                    echo "<span class='badge bg-danger'>For Revision <br>by Unit Head</span>";
                                  }
                                  break;
                                case 2:
                                  if ($row['revision_count'] == 0) {
                                    echo "<span class='badge bg-success'>Approved <br>by Unit Head</span>";
                                  } else {
                                    echo "<span class='badge bg-danger'>For Revision <br>by Division Head</span>";
                                  }
                                  break;
                                case 3:
                                  if ($row['revision_count'] == 0) {
                                    echo "<span class='badge bg-success'>Approved <br>by Division Head</span>";
                                  }
                                  break;
                                default:
                                  break;
                              } ?></td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->


    </div>
  </section>

</main><!-- End #main -->
<?php
include 'template/footer.php';
?>