<?php
$pages = 'travel';
include 'template/header.php';
include 'backend/sanitize.php';
$sql1 = "SELECT * from report
where report_id='" . $_GET['id'] . "'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = sanitizeQuillContent($row['report_title']);
        $requesting_organizer = sanitizeQuillContent($row['requesting_organizer']);
        $venue = sanitizeQuillContent($row['venue']);
        $conduct = $row['date_conducted'];
        $editor = sanitizeQuillContent($row['highlights']);
        $concern = sanitizeQuillContent($row['concern']);
        $follow_up_act = sanitizeQuillContent($row['follow_up_act']);
        $importance_of_the_activity = sanitizeQuillContent($row['importance_of_the_activity']);
        $privacy = $row['shared'];
        $unit = $row['shared_unit'];
        $date_submitted = $row['date_submitted'];
        $revision_remarks = sanitizeQuillContent($row['revision_remarks']);
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Travel Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Events</li>
                <li class="breadcrumb-item"><a href="travel.php">Travel</a></li>
                <li class="breadcrumb-item active">View Travel Report</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br>
                        <form class="row g-3" id="add_travel">
                            <div class="col-md-12">
                                <input type="text" id="id" name="id" value="<?= $_GET['id'] ?>" hidden>
                                <input type="text" class="form-control" name="type" value="3" id="type" placeholder="type" hidden>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="requesting" id="requesting" value="<?= $requesting_organizer ?>" placeholder="Requesting Organizer" disabled>
                                    <label for="requesting">Requesting Organizer</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="title" id="title" value="<?= $title ?>" placeholder="Report Title" disabled>
                                    <label for="title">Travel Report Title</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="venue" name="venue" value="<?= $venue ?>" placeholder="Venue" disabled>
                                    <label for="venue">Venue</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="conduct" name="conduct" value="<?= $conduct ?>" placeholder="Date Conducted" disabled>
                                    <label for="conduct">Date Conducted</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <div id="editor" style="height: auto;"><?= $editor ?></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="inputNumber" class="col-md-2 col-form-label">Image Attachment</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="file" id="formFile" multiple disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea style="height: 100px;" class="form-control" id="concerns" name="concerns" placeholder="Concerns" disabled><?= $concern ?></textarea>
                                    <label for="concerns">S&T Related Issues and Concerns raised</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea type="text" style="height: 100px;" class="form-control" id="followup" name="followup" placeholder="Followup" disabled><?= $follow_up_act ?></textarea>
                                    <label for="followup">Follow-up Activities <span style="color:red;">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea type="text" class="form-control" style="height: 100px;" id="importance" name="importance" placeholder="Importance of the activity" disabled><?= $importance_of_the_activity ?></textarea>
                                    <label for="importance">Importance of the activity to your job</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="submitted" name="submitted" placeholder="Date Submitted" value="<?= $date_submitted ?>" disabled>
                                    <label for="submitted">Date Submitted</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="privacy" name="privacy" aria-label="Privacy" disabled>
                                        <option value="1">Select Privacy Level</option>
                                        <option value="1" <?php if ($privacy == 1) {
                                                                echo 'selected';
                                                            } ?>>Public</option>
                                        <option value="2" <?php if ($privacy == 2) {
                                                                echo 'selected';
                                                            } ?>>Private</option>
                                    </select>
                                    <label for="privacy">Privacy Level</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="unit" id="unit" class="form-select" disabled>
                                        <option value="0" selected>Select Unit</option>
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
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea style="height: 100px;" class="form-control" id="revision_remarks" name="revision_remarks" placeholder="revision_remarks" disabled><?= $revision_remarks ?></textarea>
                                    <label for="revision_remarks">Revision Remarks</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="travel.php" class="btn btn-warning btn-md">Back</a>
                            </div>
                        </form><!-- End floating Labels Form -->
                    </div>
                </div>
            </div>


        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                ['link', 'formula'],
                [{
                    'header': 1
                }, {
                    'header': 2
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, {
                    'list': 'check'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }],
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],
                ['clean']
            ];

            var quill = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                placeholder: 'Highlights of the activity',
                theme: 'snow'
            });
            quill.disable();
            document.getElementById("add_travel").addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                formData.append("content", quill.root.innerHTML);

                const urlEncodedData = new URLSearchParams(formData).toString();

                fetch("backend/addtravelreport.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: urlEncodedData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        alert(data);
                        document.getElementById("add_travel").reset();
                        quill.setContents([]);
                        window.location.href = "travel.php";
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                        alert("Error saving data. Please try again.");
                    });
            });
        });
    </script>
</main><!-- End #main -->
<?php
include 'template/footer.php';
?>