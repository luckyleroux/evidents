<?php
$pages = 'travel';
include 'template/header.php';
include 'backend/sanitize.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Travel Report</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Travel Report</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <br>
            <a href="addtravel.php" type="button" class="btn btn-primary btn-sm">Add New</a>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Requesting Organizer</th>
                  <th scope="col">Title</th>
                  <th scope="col">Venue</th>
                  <th scope="col">Date Conducted</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * from report rep left join user us on us.user_id = rep.user_id left join unit_details ud on ud.unit_id = us.unit_id where report_type = 3&& ud.unit_id = '" . $unit_id . "'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                      <td><?= $row['report_id'] ?></td>
                      <td><?= sanitizeQuillContent($row['requesting_organizer']) ?></td>
                      <td><?= sanitizeQuillContent($row['report_title']) ?></td>
                      <td><?= sanitizeQuillContent($row['venue']) ?></td>
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
                      <td><?php
                          if (($row['status'] == 3 && $row['revision_count'] == 0) || ($row['status'] == 2 && $row['revision_count'] == 0)) { ?>
                          <a href="viewtravel.php?id=<?= $row['report_id'] ?>" type="button" class="btn btn-success btn-sm" title="View report" onclick="viewReport('<?= $row['report_id'] ?>')">
                            <i class="bi bi-eye"></i>
                          </a>
                          <a href="../print/travel.php?id=<?= $row['report_id'] ?>" type="button" class="btn btn-info btn-sm" title="Print report">
                            <i class="bi bi-printer"></i>
                          </a>
                          <a href="backend/download.php?id=<?= $row['report_id'] ?>" type="button" class="btn btn-light btn-sm" title="Download attachment">
                            <i class="bi bi-download"></i>
                          </a>
                        <?php
                          } else { ?>
                          <a href="viewtravel.php?id=<?= $row['report_id'] ?>" type="button" class="btn btn-success btn-sm" title="View report" onclick="viewReport(' <?= $row['report_id'] ?>')">
                            <i class="bi bi-eye"></i>
                          </a>
                          <a href="edittravel.php?id=<?= $row['report_id'] ?>" type="button" class="btn btn-warning btn-sm" title="Edit report">
                            <i class="bi bi-pencil-square"></i>
                          </a>
                        <?php
                          } ?>
                      </td>
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