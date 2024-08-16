<?php
$pages = 'minutes';

include 'template/header.php';
include 'backend/sanitize.php';
$sql1 = "SELECT * from report
where report_id='" . $_GET['id'] . "'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = sanitizeQuillContent($row['report_title']);
        $imp_agency = sanitizeQuillContent($row['imp_agency']);
        $venue = sanitizeQuillContent($row['venue']);
        $conduct = $row['date_conducted'];
        $person_attend = sanitizeQuillContent($row['person_attended']);
        $editor = sanitizeQuillContent($row['highlights']);
        $concern = sanitizeQuillContent($row['concern']);
        $deadline_req = $row['deadline_action'];
        $action_taken = sanitizeQuillContent($row['action_request']);
        $remarks = sanitizeQuillContent($row['remarks']);
        $date_submitted = date($row['date_submitted']);
        $privacy = $row['shared'];
        $unit = $row['shared_unit'];
        $revision_remarks = sanitizeQuillContent($row['revision_remarks']);
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Minutes Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Events</li>
                <li class="breadcrumb-item"><a href="minutes.php">Minutes of the Meeting</a></li>
                <li class="breadcrumb-item active">View Minutes of the Meeting</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br>
                        <form class="row g-3" id="revise_minute">
                            <input type="text" class="form-control" name="type" value="1" id="type" placeholder="type" hidden>
                            <input type="text" class="form-control" name="report_id" value="<?= $_GET['id'] ?>" id="report_id" placeholder="type" hidden>
                            <div class="col-md-12">
                                <div class="form-floating">

                                    <input type="text" class="form-control" name="title" id="title" value="<?= $title ?>" placeholder="Report Title" disabled>
                                    <label for="title">Report Title</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="imp_agency" id="imp_agency" value="<?= $imp_agency ?>" placeholder="Implementing Agency" disabled>
                                    <label for="imp_agency">Implementing Agency</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="venue" name="venue" value="<?= $venue ?>" placeholder="Venue" disabled>
                                    <label for="venue">Venue</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="conduct" name="conduct" value="<?= $conduct ?>" placeholder="Date Conducted" disabled>
                                    <label for="conduct">Date Conducted</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="person_attend" name="person_attend" value="<?= $person_attend ?>" placeholder="Person Attended" disabled>
                                    <label for="person_attend">Person who Attended</label>
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
                                    <input type="text" class="form-control" id="concerns" name="concerns" value="<?= $concern ?>" placeholder="Concerns" disabled>
                                    <label for="concerns">Concerns the RD should know</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="deadline" name="deadline" value="<?= $deadline_req ?>" placeholder="Deadline" disabled>
                                    <label for="deadline">Deadline for action request/s</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="action_taken" name="action_taken" value="<?= $action_taken ?>" placeholder="Action Taken" disabled>
                                    <label for="action_taken">Action taken</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="remarks" name="remarks" value="<?= $remarks ?>" placeholder="Remarks" disabled>
                                    <label for="remarks">Remarks</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="submitted" name="submitted" value="<?= $date_submitted ?>" placeholder="Date Submitted" disabled>
                                    <label for="submitted">Date Submitted</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="privacy" name="privacy" aria-label="Privacy" disabled>
                                        <option value="">Select Privacy Level</option>
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
                            <div class=col-md-12>
                                <div class="form-floating mb-3">
                                    <textarea style="height: 100px;" class="form-control" id="revision_remarks" name="revision_remarks" placeholder="revision_remarks"></textarea>
                                    <label for="revision_remarks">Revision Remarks</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="minutes.php" class="btn btn-warning btn-md">Back</a>
                                <button type="submit" id="saveButton" class="btn btn-primary">Submit</button>

                            </div>
                        </form><!-- End floating Labels Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<script>
    const selectElement = document.getElementById('privacy');
    const inputField = document.getElementById('unit');

    selectElement.addEventListener('change', function() {
        if (this.value === '1') {
            inputField.disabled = true;
        } else {
            inputField.disabled = false; // Enable input for other options (optional)
        }
    });

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
        document.getElementById("revise_minute").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append("content", quill.root.innerHTML);

            const urlEncodedData = new URLSearchParams(formData).toString();

            fetch("backend/revise_minutes.php", {
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
                    document.getElementById("revise_minute").reset();
                    quill.setContents([]);
                    window.location.href = "minutes.php";
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    alert("Error saving data. Please try again.");
                });
        });
    });
</script>
<?php
include 'template/footer.php';
?>