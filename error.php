<?php include 'header.php'; ?>
<br>

<style>
	/* Menambahkan aturan CSS khusus untuk media print */
	@media print {
		body {
			font-size: 10px;
			/* Mengubah ukuran font */
		}

		.container {
			width: 50%;
			/* Memastikan kontainer mengisi seluruh lebar saat dicetak */
		}

		.card-body {
			font-size: 10px;
			/* Mengubah ukuran font dalam card */
		}

		textarea {
			font-size: 10px;
			/* Mengubah ukuran font dalam textarea */
			width: 50%;
			/* Memastikan textarea mengisi lebar halaman */
			resize: none;
			/* Menonaktifkan resize */
		}

		/* Mengatur ukuran tombol cetak */
		.btnn {
			display: none;
			/* Menyembunyikan tombol cetak saat dicetak */
		}

		/* Menyesuaikan ukuran font untuk judul H1 */
		.hp {
			font-size: 20px;
			/* Memperbesar ukuran font untuk "HASIL DIAGNOSA" */
		}
	}
</style>

<?php
// Ambil admin tujuan dari diagnosis terakhir user
$admin_name = '-';
if (isset($_SESSION["nama"]) && isset($_SESSION["umur"])) {
	include 'koneksi.php';
	$nama = mysqli_real_escape_string($kon, $_SESSION["nama"]);
	$umur = mysqli_real_escape_string($kon, $_SESSION["umur"]);
	$qry_admin = "SELECT assigned_admin FROM tb_diagnosa_siswa WHERE nama='$nama' AND umur='$umur' ORDER BY tanggal_diagnosa DESC LIMIT 1";
	$res_admin = mysqli_query($kon, $qry_admin);
	if ($row_admin = mysqli_fetch_assoc($res_admin)) {
		$assigned_admin = $row_admin['assigned_admin'];
		if (!empty($assigned_admin)) {
			$qadmin = mysqli_query($kon, "SELECT role, toko FROM login WHERE userid='" . mysqli_real_escape_string($kon, $assigned_admin) . "'");
			if ($a = mysqli_fetch_assoc($qadmin)) {
				$admin_name = $a['role'] . " (" . $a['toko'] . ")";
			}
		}
	}
}
?>
<div class="container my-5">
	<!-- <a href="index.php">
		<button class="btnn float-right mb-3">Kembali</button>
	</a> -->
	<div class="row mb-4">
		<div class="col-12">
			<div class="d-flex justify-content-end">
				<div class="btn-group" role="group">
					<?php
					$back_url = 'index.php';
					if (isset($_SERVER['HTTP_REFERER'])) {
						$referer = basename(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
						if (in_array($referer, ['diagnosa.php', '1_diagnosa.php'])) {
							$back_url = $referer;
						}
					}
					?>
					<a class="btn btn-secondary btn-lg mr-2" href="<?php echo $back_url; ?>" style="text-decoration: none; min-width: 120px;">
						<i class="fas fa-arrow-left mr-2"></i>Kembali
					</a>
					<a class="btn btn-success btn-lg" href="generate_pdf.php?t=<?php echo time(); ?>" target="_blank" style="text-decoration: none; min-width: 120px;">
						<i class="fas fa-print mr-2"></i>CETAK
					</a>
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

					<!-- NAMA -->
					<div class="form-group">
						<label for="nama" class="font-weight-bold">NAMA:</label>
						<textarea class="form-control" id="nama" rows="1" readonly><?php echo $_SESSION["nama"]; ?></textarea>
					</div>
					<!-- Umur -->
					<div class="form-group">
						<label for="umur" class="font-weight-bold">Umur:</label>
						<textarea class="form-control" id="umur" rows="1" readonly><?php
																					$umur = $_SESSION["umur"];
																					if (preg_match('/tahun$/', trim($umur))) {
																						echo trim($umur);
																					} else {
																						echo trim($umur) !== '' ? trim($umur) . ' tahun' : '';
																					}
																					?></textarea>
					</div>
					<?php if (isset($_SESSION['penyakit']) && $_SESSION['penyakit'] == 'Normal') { ?>
						<div class="form-group">
							<label for="penyakit" class="font-weight-bold">IDENTIFIKASI:</label>
							<textarea class="form-control text-success" id="penyakit" rows="1" readonly>Normal</textarea>
						</div>
						<div class="form-group">
							<label for="definisi" class="font-weight-bold">DEFINISI:</label>
							<textarea class="form-control text-success" id="definisi" rows="6" readonly>Siswa tidak menunjukkan gejala apapun.</textarea>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="penyakit" class="font-weight-bold">IDENTIFIKASI:</label>
							<textarea class="form-control text-danger" id="penyakit" rows="1" readonly>Belum Diketahui</textarea>
						</div>
						<div class="form-group">
							<label for="definisi" class="font-weight-bold">DEFINISI:</label>
							<textarea class="form-control text-danger" id="definisi" rows="6" readonly>Maaf tidak terdefinisi!</textarea>
						</div>

					<?php } ?>
					<div class="form-group">
						<label class="font-weight-bold">Data Tersimpan di:</label>
						<textarea class="form-control" rows="1" readonly><?php echo $admin_name; ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<?php include 'footer.php'; ?>