<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>MIS-OJT DOST-MIMAROPA</span></strong>. All Rights Reserved <?php echo date('Y'); ?>

    </div>
    <div class="credits">
        Designed by <a href="https://dostmimaropa.ph/">MIS DOST-MIMAROPA</a>
    </div>
</footer><!-- End Footer -->
<script>
    const privacy = document.getElementById('privacy');
    const unit = document.getElementById('unit');

    privacy.addEventListener('change', () => {
        if (privacy.value != '1') {
            unit.disabled = false;
        } else {
            unit.disabled = true;
            unit.value = 0;
        }
    });
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>