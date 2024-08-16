<?php
$pages = 'training';
include 'template/header.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Training Report</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Training Reports</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <br>
            <a href="addtraining.php" type="button" class="btn btn-primary btn-sm">Add New</a>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Prepared by</th>
                  <th scope="col">Unit</th>
                  <th scope="col">Date Conducted</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * from report rep left join user us on us.user_id = rep.user_id left join unit_details ud on ud.unit_id = us.unit_id where report_type = 2";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                      <td><?= $row['report_id'] ?></td>
                      <td><?= $row['report_title'] ?></td>
                      <td><?= $row['imp_agency'] ?></td>
                      <td><?= $row['person_attended'] ?></td>
                      <td><?= $row['unit_name'] ?></td>
                      <td><?= $row['date_conducted'] ?></td>
                      <td><?php
                          switch ($row['status']) {
                            case 1:
                              echo "<span class='badge bg-warning'>Pending</span>";
                              break;
                            case 2:
                              echo "<span class='badge bg-danger'>Revision</span>";
                              break;
                            case 3:
                              echo "<span class='badge bg-success'>Approved</span>";
                              break;
                            default:
                              break;
                          } ?></td>
                      <td></td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </section>

</main><!-- End #main -->
<?php
include 'template/footer.php';
?>