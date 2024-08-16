<?php
$pages = 'minutes';
include 'template/header.php';
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Minutes Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Events</li>
                <li class="breadcrumb-item"><a href="minutes.php">Minutes of the Meeting</a></li>
                <li class="breadcrumb-item active">Add Minutes of the Meeting</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br>
                        <form class="row g-3" id="add_minute">
                            <input type="text" class="form-control" name="type" value="1" id="type" placeholder="type" hidden>
                            <div class="col-md-12">
                                <div class="form-floating">

                                    <input type="text" class="form-control" name="title" id="title" placeholder="Report Title">
                                    <label for="title">Report Title</label>
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
                                    <input type="text" class="form-control" id="person_attend" name="person_attend" placeholder="Person Attended">
                                    <label for="person_attend">Person who Attended</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <div id="editor" style="height: auto;"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="inputNumber" class="col-md-2 col-form-label">Image Attachment</label>
                                <div class="col-md-12">
                                    <input type="file" name="myfile[]" id="myfile[]" class="form-control" multiple accept="image/png, image/jpeg, image/jpg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="concerns" name="concerns" placeholder="Concerns">
                                    <label for="concerns">Concerns the RD should know</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Deadline">
                                    <label for="deadline">Deadline for action request/s</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="action_taken" name="action_taken" placeholder="Action Taken">
                                    <label for="action_taken">Action taken</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
                                    <label for="remarks">Remarks</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="submitted" name="submitted" placeholder="Date Submitted">
                                    <label for="submitted">Date Submitted</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="privacy" name="privacy" aria-label="Privacy">
                                        <option value="1" Selected>Select Privacy Level</option>
                                        <option value="1">Public</option>
                                        <option value="2">Private</option>
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
                            <div class="text-center">
                                <button type="submit" id="saveButton" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
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

            document.getElementById("add_minute").addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                formData.append("content", quill.root.innerHTML);

                // const urlEncodedData = new URLSearchParams(formData).toString();

                fetch("backend/addminutereport.php", {
                        method: "POST",
                        // headers: {
                        //     "Content-Type": "application/x-www-form-urlencoded",
                        // },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        alert(data);
                        document.getElementById("add_minute").reset();
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
</main><!-- End #main -->

<?php
include 'template/footer.php';
?>