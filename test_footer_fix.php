<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Footer Fix</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .test-content {
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            margin: 20px;
            border-radius: 10px;
            min-height: 400px;
        }

        .test-section {
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(174, 154, 114, 0.1);
            border-radius: 8px;
        }

        .zoom-test {
            text-align: center;
            padding: 20px;
            background: rgba(59, 47, 47, 0.1);
            border-radius: 8px;
            margin: 20px 0;
        }

        .zoom-instructions {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="test-content">
            <h1>Test Perbaikan Footer</h1>

            <div class="zoom-instructions">
                <h4>📋 Instruksi Test:</h4>
                <ol>
                    <li>Zoom in/out browser (Ctrl + / Ctrl -)</li>
                    <li>Ubah ukuran window browser</li>
                    <li>Scroll ke bawah halaman</li>
                    <li>Pastikan footer selalu berada di bawah</li>
                </ol>
            </div>

            <div class="test-section">
                <h3>Test Section 1</h3>
                <p>Ini adalah konten test untuk memastikan footer tetap di posisi yang benar saat layar diperbesar atau diperkecil.</p>
            </div>

            <div class="test-section">
                <h3>Test Section 2</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="test-section">
                <h3>Test Section 3</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <div class="zoom-test">
                <h4>🔍 Test Zoom Browser</h4>
                <p>Zoom in/out dan perhatikan posisi footer</p>
                <button onclick="testZoom()" class="btnn">Test Zoom</button>
            </div>

            <div class="test-section">
                <h3>Test Section 4</h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>

            <div class="test-section">
                <h3>Test Section 5</h3>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <a href="editd.php" class="foot text-white">
            <div class="left-text">&copy; 2025 SIABID</div>
        </a>
        <div class="right-text">
            <a href="https://informatika.ump.ac.id/" style="text-decoration: none;" class="foot text-white">Teknik Informatika</a> |
            <a href="https://psikologi.ump.ac.id/" style="text-decoration: none;" class="foot text-white">Psikologi</a> |
            <a href="https://ump.ac.id/" style="text-decoration: none;" class="foot text-white">UMP</a>
        </div>
    </footer>

    <script>
        function testZoom() {
            alert('Sekarang coba zoom in/out browser (Ctrl + / Ctrl -) dan perhatikan posisi footer!');
        }

        // Test responsive behavior
        window.addEventListener('resize', function() {
            console.log('Window resized - checking footer position');
        });

        // Test scroll behavior
        window.addEventListener('scroll', function() {
            console.log('Page scrolled - footer should stay at bottom');
        });
    </script>
</body>

</html>