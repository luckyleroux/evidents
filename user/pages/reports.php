<?php
$pages = 'reports';
include 'template/header.php';
include 'backend/sanitize.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Reports</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">List of reports</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 active" id="tsd-tab" data-bs-toggle="tab" data-bs-target="#tsd-justified" type="button" role="tab" aria-controls="tsd" aria-selected="true">Pending</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="fad-tab" data-bs-toggle="tab" data-bs-target="#fad-justified" type="button" role="tab" aria-controls="fad" aria-selected="false">Revision</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="ord-tab" data-bs-toggle="tab" data-bs-target="#ord-justified" type="button" role="tab" aria-controls="ord" aria-selected="false">Approved</button>
              </li>
            </ul>


            <div class="tab-content pt-2" id="myTabjustifiedContent">
              <div class="tab-pane fade show active" id="tsd-justified" role="tabpanel" aria-labelledby="tsd-tab">
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Implementing Agency</th>
                      <th scope="col">Person Attended</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Date Conducted</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * from report rep left join user us on us.user_id = rep.user_id left join unit_details ud on ud.unit_id = us.unit_id where rep.status = 1 && us.user_id = '" . $_SESSION['id'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td><?= $row['report_id'] ?></td>
                          <td><?= sanitizeQuillContent($row['report_title']) ?></td>
                          <td><?= sanitizeQuillContent($row['imp_agency']) ?></td>
                          <td><?= sanitizeQuillContent($row['person_attended']) ?></td>
                          <td><?= $row['unit_name'] ?></td>
                          <td><?= $row['date_conducted'] ?></td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="fad-justified" role="tabpanel" aria-labelledby="fad-tab">
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Implementing Agency</th>
                      <th scope="col">Person Attended</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Date Conducted</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * from report rep left join user us on us.user_id = rep.user_id left join unit_details ud on ud.unit_id = us.unit_id where rep.status = 1 && revision_count >0 && us.user_id = '" . $_SESSION['id'] . "'|| rep.status = 2 && revision_count >0 && us.user_id = '" . $_SESSION['id'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td><?= $row['report_id'] ?></td>
                          <td><?= sanitizeQuillContent($row['report_title']) ?></td>
                          <td><?= sanitizeQuillContent($row['imp_agency']) ?></td>
                          <td><?= sanitizeQuillContent($row['person_attended']) ?></td>
                          <td><?= $row['unit_name'] ?></td>
                          <td><?= $row['date_conducted'] ?></td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="ord-justified" role="tabpanel" aria-labelledby="ord-tab">
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Implementing Agency</th>
                      <th scope="col">Person Attended</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Date Conducted</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * from report rep left join user us on us.user_id = rep.user_id left join unit_details ud on ud.unit_id = us.unit_id where rep.status = 3 && us.unit_id = '" . $unit_id . "'|| rep.status = 3 && rep.shared=1 || rep.status = 3 && rep.shared = 2 && rep.shared_unit = '" . $unit_id . "'|| rep.status = 3 && us.unit_id ='" . $unit_id . "' && us.user_id = '" . $_SESSION['id'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td><?= $row['report_id'] ?></td>
                          <td><?= sanitizeQuillContent($row['report_title']) ?></td>
                          <td><?= sanitizeQuillContent($row['imp_agency']) ?></td>
                          <td><?= sanitizeQuillContent($row['person_attended']) ?></td>
                          <td><?= $row['unit_name'] ?></td>
                          <td><?= $row['date_conducted'] ?></td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div><!-- End Default Tabs -->

          </div>
        </div>
      </div>


    </div>
  </section>

</main><!-- End #main -->
<?php
include 'template/footer.php';
?>