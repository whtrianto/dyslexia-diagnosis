</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Sticky Footer untuk Admin -->
<style>
    .page-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .page-content {
        flex: 1;
    }

    /* Memastikan footer admin tidak mengambang */
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .page-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
</style>

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
                <button type="button" class="btn btn-info px-4 mr-2" data-dismiss="modal">Batal</button>
                <a href="logout.php" class="btn btn-danger px-4">Keluar</a>
            </div>
        </div>
    </div>
    <!-- end Modal Exit -->

    <script src="assets/vendor/datatables/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable();
        });
        $('#cart').dataTable({
            searching: false,
            paging: false,
            info: false
        });
    </script>
    <script>
        $(document).ready(function() {
            // Tampilkan overlay saat sidebar terbuka
            function toggleOverlay() {
                if ($('.page-wrapper').hasClass('toggled')) {
                    $('.sidebar-overlay').show();
                } else {
                    $('.sidebar-overlay').hide();
                }
            }
            // Inisialisasi
            toggleOverlay();
            // Toggle saat tombol sidebar
            $('#show-sidebar, #close-sidebar').on('click', function() {
                setTimeout(toggleOverlay, 10);
            });
            // Klik overlay menutup sidebar
            $('.sidebar-overlay').on('click', function() {
                $('.page-wrapper').removeClass('toggled');
                toggleOverlay();
            });
            // Jika sidebar di-toggle dengan cara lain
            $(document).on('classChange', '.page-wrapper', function() {
                toggleOverlay();
            });
        });
    </script>
    </body>

    </html>