<?php include 'header_admin.php'; ?>
<?php include 'sidebar_content.php'; ?>

<main class="page-content">
    <div class="container-fluid">
        <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-bug mr-2"></i>
                            Test Detail Identifikasi
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Test Button Detail</h5>
                                <button class="btn btn-info" onclick="testDetail()">
                                    <i class="fas fa-eye"></i> Test Detail
                                </button>
                                <button class="btn btn-success" onclick="testAjax()">
                                    <i class="fas fa-sync"></i> Test AJAX
                                </button>
                            </div>
                            <div class="col-md-6">
                                <h5>Console Log</h5>
                                <div id="console-log" style="background: #f8f9fa; padding: 10px; border-radius: 5px; min-height: 100px; font-family: monospace; font-size: 12px;">
                                    Console log akan muncul di sini...
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h5>Data Identifikasi (5 terbaru)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis Identifikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, nama, jenis_diagnosa FROM tb_diagnosa_siswa ORDER BY tanggal_diagnosa DESC LIMIT 5";
                                    $result = mysqli_query($kon, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td><?php echo ucfirst($row['jenis_diagnosa']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="detailDiagnosa(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Identifikasi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menambahkan log ke console
    function addLog(message) {
        const logDiv = document.getElementById('console-log');
        const timestamp = new Date().toLocaleTimeString();
        logDiv.innerHTML += `[${timestamp}] ${message}<br>`;
        console.log(message);
    }

    // Test fungsi detail
    function testDetail() {
        addLog('Test Detail button clicked');
        addLog('jQuery version: ' + (typeof $ !== 'undefined' ? $.fn.jquery : 'jQuery not loaded'));
        addLog('Bootstrap modal available: ' + (typeof $ !== 'undefined' && $.fn.modal ? 'Yes' : 'No'));
    }

    // Test AJAX
    function testAjax() {
        addLog('Testing AJAX request...');
        $.ajax({
            url: 'detail_diagnosa.php',
            type: 'POST',
            data: {
                id: 1
            },
            success: function(response) {
                addLog('AJAX Success: ' + response.substring(0, 100) + '...');
            },
            error: function(xhr, status, error) {
                addLog('AJAX Error: ' + error);
            }
        });
    }

    // Fungsi detail diagnosa yang diperbaiki
    function detailDiagnosa(id) {
        addLog('detailDiagnosa called with ID: ' + id);

        // Cek apakah jQuery tersedia
        if (typeof $ === 'undefined') {
            addLog('ERROR: jQuery tidak tersedia!');
            alert('Error: jQuery tidak tersedia!');
            return;
        }

        // Cek apakah Bootstrap modal tersedia
        if (typeof $.fn.modal === 'undefined') {
            addLog('ERROR: Bootstrap modal tidak tersedia!');
            alert('Error: Bootstrap modal tidak tersedia!');
            return;
        }

        addLog('Mengirim AJAX request...');

        $.ajax({
            url: 'detail_diagnosa.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                addLog('AJAX Success - Response length: ' + response.length);
                $('#detailContent').html(response);
                $('#detailModal').modal('show');
                addLog('Modal should be shown now');
            },
            error: function(xhr, status, error) {
                addLog('AJAX Error: ' + error);
                addLog('Status: ' + status);
                addLog('Response: ' + xhr.responseText);
                alert('Error: ' + error);
            }
        });
    }

    $(document).ready(function() {
        addLog('Document ready');
        addLog('jQuery version: ' + $.fn.jquery);
        addLog('Bootstrap modal available: ' + (typeof $.fn.modal !== 'undefined'));

        // Test modal
        $('#detailModal').on('show.bs.modal', function() {
            addLog('Modal show event triggered');
        });

        $('#detailModal').on('shown.bs.modal', function() {
            addLog('Modal shown event triggered');
        });
    });
</script>

<?php include 'footer1.php'; ?>