<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

//session_start();
include 'header.php';
include 'koneksi.php';
// Validasi data session hasil diagnosa
if (
	empty($_SESSION["penyakit"]) ||
	!isset($_SESSION["certainty_factors"]) ||
	!is_array($_SESSION["certainty_factors"]) ||
	count($_SESSION["certainty_factors"]) == 0
) {
	echo "<div class='container my-5'><div class='alert alert-warning'>Data hasil diagnosa tidak ditemukan. Silakan lakukan diagnosa terlebih dahulu.</div></div>";
	include 'footer.php';
	exit;
}
// Ambil data hasil diagnosa dari session
$penyakit = isset($_SESSION["penyakit"]) ? $_SESSION["penyakit"] : '';
$definisi = isset($_SESSION["definisi"]) ? $_SESSION["definisi"] : '';
$penanganan = isset($_SESSION["penanganan"]) ? $_SESSION["penanganan"] : '';
$link = isset($_SESSION["link"]) ? $_SESSION["link"] : '';
$best_cf = isset($_SESSION["best_cf"]) ? $_SESSION["best_cf"] : 0;
// Ambil data diagnosa terakhir user ini (dalam 5 menit terakhir)
$nama = mysqli_real_escape_string($kon, $_SESSION["nama"]);
$umur = mysqli_real_escape_string($kon, $_SESSION["umur"]);
$query = "SELECT assigned_admin FROM tb_diagnosa_siswa WHERE nama='$nama' AND umur='$umur' ORDER BY tanggal_diagnosa DESC LIMIT 1";
$res = mysqli_query($kon, $query);
$assigned_admin = null;
$admin_name = '-';
if ($row = mysqli_fetch_assoc($res)) {
	$assigned_admin = $row['assigned_admin'];
	if (!empty($assigned_admin)) {
		$qadmin = mysqli_query($kon, "SELECT role, toko FROM login WHERE userid='" . mysqli_real_escape_string($kon, $assigned_admin) . "'");
		if ($a = mysqli_fetch_assoc($qadmin)) {
			$admin_name = "[" . $a['role'] . "]" . " " . $a['toko'];
		}
	}
}
?>


<style>
	.form-control {
		text-align: justify;
		white-space: pre-line;
		line-height: 1.5;
		word-break: break-word;
	}

	/* Menambahkan aturan CSS khusus untuk media print */
	@media print {
		body {
			font-size: 10px;
		}

		.container {
			width: 50%;
		}

		.card-body {
			font-size: 10px;
		}

		textarea {
			font-size: 10px;
			width: 50%;
			resize: none;
		}

		.btnn,
		.bt {
			display: none;
		}

		.hp {
			font-size: 20px;
		}
	}
</style>

<div class="container my-5">
	<div class="row mb-4">
		<div class="col-12">
			<div class="d-flex justify-content-end">
				<div class="btn-group" role="group">
					<a class="btn btn-secondary btn-lg mr-2" href="1_diagnosa.php" style="text-decoration: none; min-width: 120px;">
						<i class="fas fa-arrow-left mr-2"></i>Kembali
					</a>
					<a class="btn btn-success btn-lg" href="generate_pdf.php?t=<?php echo time(); ?>" target="_blank" style="text-decoration: none; min-width: 120px;">
						<i class="fas fa-print mr-2"></i>CETAK
					</a>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<div class="card shadow-lg border-0">
				<div class="card-body" style="background: linear-gradient(to right top, rgba(174, 169, 153, 0.9), rgba(235, 232, 223, 0.9));">
					<h1 class="text-center mb-4 hp">HASIL IDENTIFIKASI</h1>

					<?php
					$persen_cf = round($best_cf * 100, 2);
					$penyakit_info = "$penyakit (CF: $persen_cf%)";
					?>


					<!-- NAMA -->
					<div class="form-group">
						<label for="nama" class="font-weight-bold">NAMA:</label>
						<textarea class="form-control" id="nama" rows="1" readonly><?php echo $_SESSION["nama"]; ?></textarea>
					</div>

					<!-- Umur -->
					<div class="form-group">
						<label for="umur" class="font-weight-bold">Umur:</label>
						<textarea class="form-control" id="umur" rows="1" readonly><?php
																					$umur = isset($_SESSION["umur"]) ? trim($_SESSION["umur"]) : '';
																					if ($umur !== '') {
																						echo (stripos($umur, 'tahun') === false) ? $umur . ' tahun' : $umur;
																					}
																					?></textarea>
					</div>

					<!-- DIAGNOSA -->
					<div class="form-group">
						<label for="penyakit" class="font-weight-bold">IDENTIFIKASI:</label>
						<textarea class="form-control" id="penyakit" rows="1" readonly><?php echo $penyakit_info; ?></textarea>
					</div>

					<!-- DEFINISI -->
					<div class="form-group">
						<label for="definisi" class="font-weight-bold">DEFINISI:</label>
						<textarea class="form-control" id="definisi" rows="7" readonly><?php echo $definisi; ?> </textarea>
					</div>

					<!-- PENANGANAN -->
					<div class="form-group">
						<label for="penanganan" class="font-weight-bold">PENANGANAN:</label>
						<textarea class="form-control pen" id="penanganan" rows="11" readonly><?php echo $penanganan; ?></textarea>
					</div>

					<!-- Certainty Factors for All Diseases -->
					<div class="form-group">
						<label for="penanganan" class="font-weight-bold">HASIL CF LAINNYA:</label>
						<table class="table table-bordered" style="font-size: 15px;">
							<tr>
								<th>Jenis Disleksia</th>
								<th>Certainty Factor (%)</th>
							</tr>
							<?php
							// Find the maximum CF value
							$max_cf = max($_SESSION["certainty_factors"]);

							foreach ($_SESSION["certainty_factors"] as $id_penyakit => $cf_value) {
								// Fetch the disease name from the database
								$qry = "SELECT penyakit FROM 1_tb_penyakit WHERE id = $id_penyakit";
								$result = mysqli_query($kon, $qry);
								$row = mysqli_fetch_assoc($result);
								$penyakit_name = $row['penyakit'];

								// Set the color based on whether this CF is the maximum or below
								$color = ($cf_value == $max_cf) ? 'color: green;' : ''; // Highlight max CF with green
								$color1 = ($cf_value < $max_cf) ? 'color:#504b3f;' : ''; // Highlight CFs below max with red

								// Combine both styles and apply them
								$style = $color . $color1;

								// Display the CF value for each disease
								echo "<tr style='$style'>
								<td>$penyakit_name</td>
								<td>" . round($cf_value * 100, 2) . "%</td>
								</tr>";
							}
							?>
						</table>

					</div>

					<!-- ADMIN TUJUAN -->
					<div class="form-group">
						<label class="font-weight-bold">Data Tersimpan di:</label>
						<textarea class="form-control" rows="1" readonly><?php echo $admin_name; ?></textarea>
					</div>
					<!-- Tombol Informasi Tambahan -->
					<div class="form-group">
						<a class="text-white" href="<?php echo $link; ?>.php" style="text-decoration: none;" target="_blank">
							<button class="btn btn-block mt-4 custom-btn text-light bt" style="background-color:#908872; border: #333;">
								<h5>Informasi Lebih Lanjut Terkait <?php echo $penyakit; ?></h5>
							</button>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<br><br>
<?php include 'footer.php'; ?>