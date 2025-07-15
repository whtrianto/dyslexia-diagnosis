<!DOCTYPE html>
<html>

<head>
    <title>Test Warna Badge Jenis Identifikasi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .test-container {
            padding: 20px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .badge-example {
            margin: 10px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Test Warna Badge Jenis Identifikasi</h2>

        <div class="test-container">
            <h4>Warna Badge yang Diterapkan:</h4>

            <div class="badge-example">
                <strong>Disleksia:</strong>
                <span class="badge badge-success">Disleksia</span>
                <small>(Hijau - Success)</small>
            </div>

            <div class="badge-example">
                <strong>Disgrafia:</strong>
                <span class="badge badge-warning">Disgrafia</span>
                <small>(Kuning - Warning)</small>
            </div>
        </div>

        <div class="test-container">
            <h4>Contoh Tabel dengan Badge:</h4>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Jenis Identifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Contoh Siswa 1</td>
                        <td>
                            <span class="badge badge-success">Disleksia</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Contoh Siswa 2</td>
                        <td>
                            <span class="badge badge-warning">Disgrafia</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="test-container">
            <h4>Kode PHP yang Digunakan:</h4>
            <pre><code>&lt;span class="badge badge-&lt;?php echo $row['jenis_diagnosa'] == 'disleksia' ? 'success' : 'warning'; ?&gt;"&gt;
    &lt;?php echo ucfirst($row['jenis_diagnosa']); ?&gt;
&lt;/span&gt;</code></pre>
        </div>

        <div class="alert alert-info">
            <strong>Info:</strong> Warna badge telah diubah sesuai permintaan:
            <ul>
                <li><strong>Disleksia</strong> = <span class="badge badge-success">Success (Hijau)</span></li>
                <li><strong>Disgrafia</strong> = <span class="badge badge-warning">Warning (Kuning)</span></li>
            </ul>
        </div>
    </div>
</body>

</html>