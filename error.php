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

<div class="container my-5">
	<!-- <a href="index.php">
		<button class="btnn float-right mb-3">Kembali</button>
	</a> -->

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
						<textarea class="form-control" id="umur" rows="1" readonly><?php echo $_SESSION["umur"] !== '' ? $_SESSION["umur"] . ' tahun' : ''; ?></textarea>
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
						<div class="form-group">
							<label for="penanganan" class="font-weight-bold">PENANGANAN:</label>
							<textarea class="form-control text-success" id="penanganan" rows="6" readonly>-</textarea>
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
						<div class="form-group">
							<label for="penanganan" class="font-weight-bold">PENANGANAN:</label>
							<textarea class="form-control text-danger" id="penanganan" rows="6" readonly>Maaf tidak terdefinisi!</textarea>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<?php include 'footer.php'; ?>