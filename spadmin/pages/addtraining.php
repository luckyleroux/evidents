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
                <li class="breadcrumb-item"><a href="minutes.php">Training</a></li>
                <li class="breadcrumb-item active">Add Training Report</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br>
                        <form class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Report Title">
                                    <label for="title">Training Title</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="imp_agency" id="imp_agency" placeholder="Implementing Agency">
                                    <label for="imp_agency">Implementing Agency</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue">
                                    <label for="venue">Venue</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="conduct" name="conduct" placeholder="Date Conducted">
                                    <label for="conduct">Date Conducted</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="person_attend" name="venue" placeholder="Venue">
                                    <label for="venue">Person who Attended</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>Highlights of the activity</label>
                                <div class="form-floating">

                                    <div class="quill-editor-full" style="height:auto;">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="privacy" aria-label="Privacy">
                                        <option selected>Select Privacy Level</option>
                                        <option value="1">Public</option>
                                        <option value="2">Private</option>
                                    </select>
                                    <label for="privacy">Privacy Level</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="unit" id="unit" class="form-select">
                                        <option value="">Select Unit</option>
                                        <?php
                                        $sql = "SELECT * from unit_details";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?><option value="<?= $row['unit_id'] ?>"><?= $row['unit_name'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <label for="unit">Unit Access</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End floating Labels Form -->
                    </div>
                </div>
            </div>


        </div>
    </section>

</main><!-- End #main -->
<?php
include 'template/footer.php';
?>