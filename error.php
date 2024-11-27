<?php include 'header.php'; ?>
<br>
<script>
	function myFunction() {
		window.print();
	}
</script>

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
	<button class="btnn float-right mb-3" onclick="myFunction()">CETAK</button>

	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<div class="card shadow-lg border-0">
				<div class="card-body" style="background: linear-gradient(to right top, rgba(174, 169, 153, 0.9), rgba(235, 232, 223, 0.9));">
					<h1 class="text-center mb-4 hp">HASIL DIAGNOSA</h1>
					<div class="form-group">
						<label for="penyakit" class="font-weight-bold">DIAGNOSA:</label>
						<textarea class="form-control text-danger" id="penyakit" rows="1" readonly>Belum Diketahui</textarea>
					</div>

					<div class="form-group">
						<label for="definisi" class="font-weight-bold">DEFINISI:</label>
						<textarea class="form-control text-danger" id="definisi" rows="6" readonly>Maaf tidak terdefinisi!</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<?php include 'footer.php'; ?>