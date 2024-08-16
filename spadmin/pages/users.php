<?php
$pages = 'user';
include 'template/header.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">List of Users</li>
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
                <button class="nav-link w-100 active" id="tsd-tab" data-bs-toggle="tab" data-bs-target="#tsd-justified" type="button" role="tab" aria-controls="tsd" aria-selected="true">Technical Service Division</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="fad-tab" data-bs-toggle="tab" data-bs-target="#fad-justified" type="button" role="tab" aria-controls="fad" aria-selected="false">Finance and Administrative Division</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="ord-tab" data-bs-toggle="tab" data-bs-target="#ord-justified" type="button" role="tab" aria-controls="ord" aria-selected="false">Office of Regional Director</button>
              </li>
            </ul>


            <div class="tab-content pt-2" id="myTabjustifiedContent">
              <div class="tab-pane fade show active" id="tsd-justified" role="tabpanel" aria-labelledby="tsd-tab">
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">Full Name</th>
                      <th scope="col">Email Address</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * from user us left join unit_details ud on ud.unit_id = us.unit_id where division_id = 1";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td><?= ucfirst($row['userfname']) ?> <?= ucfirst($row['userlname']) ?></td>
                          <td><?= $row['email'] ?></td>
                          <td><?= $row['unit_name'] ?> (<?= $row['unit_acr'] ?>)</td>
                          <td><?php if ($row['user_status'] == 1) {
                                echo 'Active';
                              } else {
                                echo 'Inactive';
                              } ?></td>
                          <td>
                            <a href="#" type="button" class="btn btn-success btn-sm" title="Approve User" onclick="approveUser('<?= $row['user_id'] ?>')">
                              <i class="bi bi-check-circle"></i>
                            </a>
                            <a href="edituser.php?id=<?= $row['user_id'] ?>" type="button" class="btn btn-warning btn-sm" title="Edit User">
                              <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" type="button" class="btn btn-info btn-sm" title="Reset Pass" onclick="resetPass('<?= $row['user_id'] ?>')">
                              <i class="bi bi-key"></i>
                            </a>
                          </td>
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
                      <th scope="col">Full Name</th>
                      <th scope="col">Email Address</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tbody>
                    <?php
                    $sql = "SELECT * from user us left join unit_details ud on ud.unit_id = us.unit_id where division_id = 2";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td><?= ucfirst($row['userfname']) ?> <?= ucfirst($row['userlname']) ?></td>
                          <td><?= base64_decode($row['email']) ?></td>
                          <td><?= $row['unit_name'] ?> (<?= $row['unit_acr'] ?>)</td>
                          <td><?php if ($row['user_status'] == 1) {
                                echo 'Active';
                              } else {
                                echo 'Inactive';
                              } ?></td>
                          <td>
                            <a href="#" type="button" class="btn btn-success btn-sm" title="Approve User" onclick="approveUser('<?= $row['user_id'] ?>')">
                              <i class="bi bi-check-circle"></i>
                            </a>
                            <a href="edituser.php?id=<?= $row['user_id'] ?>" type="button" class="btn btn-warning btn-sm" title="Edit User">
                              <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" type="button" class="btn btn-info btn-sm" title="Reset Pass" onclick="resetPass('<?= $row['user_id'] ?>')">
                              <i class="bi bi-key"></i>
                            </a>
                          </td>
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
                      <th scope="col">Full Name</th>
                      <th scope="col">Email Address</th>
                      <th scope="col">Unit</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tbody>
                    <?php
                    $sql = "SELECT * from user us left join unit_details ud on ud.unit_id = us.unit_id where division_id = 3";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td><?= ucfirst($row['userfname']) ?> <?= ucfirst($row['userlname']) ?></td>
                          <td><?= base64_decode($row['email']) ?></td>
                          <td><?= $row['unit_name'] ?> (<?= $row['unit_acr'] ?>)</td>
                          <td><?php if ($row['user_status'] == 1) {
                                echo 'Active';
                              } else {
                                echo 'Inactive';
                              } ?></td>
                          <td>
                            <a href="#" type="button" class="btn btn-success btn-sm" title="Approve User" onclick="approveUser('<?= $row['user_id'] ?>')">
                              <i class="bi bi-check-circle"></i>
                            </a>
                            <a href="edituser.php?id=<?= $row['user_id'] ?>" type="button" class="btn btn-warning btn-sm" title="Edit User">
                              <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" type="button" class="btn btn-info btn-sm" title="Reset Pass" onclick="resetPass('<?= $row['user_id'] ?>')">
                              <i class="bi bi-key"></i>
                            </a>
                          </td>
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
<script>
  function approveUser(userId) {
    Swal.fire({
      title: 'Are you sure you want to approve this user?',
      text: "This action cannot be undone!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Approved!",
          text: "The user has been approve.",
          icon: "success"
        });
        window.location.href = "backend/approve_user.php?id=" + userId;
      }
    });
  }

  function resetPass(userId) {
    Swal.fire({
      title: 'Are you sure you want to reset the password of this account?',
      text: "This action cannot be undone!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Reset'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Reset!",
          text: "The password has been reset.",
          icon: "success"
        });
        window.location.href = "backend/resetpass.php?id=" + userId;
      }
    });
  }
</script>
<?php
include 'template/footer.php';
?>