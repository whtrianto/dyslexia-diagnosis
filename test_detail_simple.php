<!DOCTYPE html>
<html>

<head>
    <title>Test Detail Identifikasi</title>
    <script src="assets/vendor/datatables/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Test Detail Identifikasi</h2>

        <button class="btn btn-info" onclick="testDetail()">
            Test Detail ID 3
        </button>

        <div id="result" class="mt-3"></div>
    </div>

    <!-- Modal -->
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
        function testDetail() {
            console.log('Testing detail function...');

            // Cek jQuery
            if (typeof $ === 'undefined') {
                document.getElementById('result').innerHTML = '<div class="alert alert-danger">jQuery tidak tersedia!</div>';
                return;
            }

            console.log('jQuery version:', $.fn.jquery);

            // Cek Bootstrap modal
            if (typeof $.fn.modal === 'undefined') {
                document.getElementById('result').innerHTML = '<div class="alert alert-danger">Bootstrap modal tidak tersedia!</div>';
                return;
            }

            console.log('Bootstrap modal tersedia');

            // Test AJAX
            $.ajax({
                url: 'detail_diagnosa.php',
                type: 'POST',
                data: {
                    id: 3
                },
                success: function(response) {
                    console.log('AJAX Success:', response);
                    document.getElementById('result').innerHTML = '<div class="alert alert-success">AJAX berhasil! Response length: ' + response.length + '</div>';

                    $('#detailContent').html(response);
                    $('#detailModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.error('Status:', status);
                    console.error('Response:', xhr.responseText);
                    document.getElementById('result').innerHTML = '<div class="alert alert-danger">AJAX Error: ' + error + '<br>Response: ' + xhr.responseText + '</div>';
                }
            });
        }

        $(document).ready(function() {
            console.log('Document ready');
            console.log('jQuery version:', $.fn.jquery);
            console.log('Bootstrap modal available:', typeof $.fn.modal !== 'undefined');
        });
    </script>
</body>

</html>