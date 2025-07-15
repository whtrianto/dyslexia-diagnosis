
<?php
include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
	$selected_gejala = isset($_POST['gejala']) ? $_POST['gejala'] : [];
	if (empty($selected_gejala)) {
		$_SESSION["nama"] = htmlspecialchars($_POST["nama"]);
		$_SESSION["umur"] = htmlspecialchars($_POST["umur"]) !== '' ? htmlspecialchars($_POST["umur"]) . ' tahun' : '';
		// Simpan hasil diagnosa 'Normal' ke database
		include 'koneksi.php';
		$nama = mysqli_real_escape_string($kon, $_SESSION["nama"]);
		$umur = mysqli_real_escape_string($kon, $_SESSION["umur"]);
		$gejala_dipilih = '';
		$hasil_diagnosa = 'Normal';
		$cf_tertinggi = 100;
		$cf_semua = json_encode([]);
		$jenis_diagnosa = 'disleksia';
		// Cek apakah data sudah ada (dalam 5 menit terakhir)
		$query_check = "SELECT id FROM tb_diagnosa_siswa 
						WHERE nama = '$nama' 
						AND umur = '$umur'
						AND gejala_dipilih = '$gejala_dipilih' 
						AND hasil_diagnosa = '$hasil_diagnosa' 
						AND jenis_diagnosa = '$jenis_diagnosa'
						AND tanggal_diagnosa > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
		$result_check = mysqli_query($kon, $query_check);
		if (mysqli_num_rows($result_check) == 0) {
			$query_save = "INSERT INTO tb_diagnosa_siswa (nama, umur, gejala_dipilih, hasil_diagnosa, cf_tertinggi, cf_semua, jenis_diagnosa) 
						   VALUES ('$nama', '$umur', '$gejala_dipilih', '$hasil_diagnosa', $cf_tertinggi, '$cf_semua', '$jenis_diagnosa')";
			mysqli_query($kon, $query_save);
		}
		$_SESSION["penyakit"] = 'Normal';
		$_SESSION["definisi"] = 'Siswa tidak menunjukkan gejala disleksia.';
		$_SESSION["penanganan"] = '-';
		$_SESSION["link"] = '';
		$_SESSION["certainty_factors"] = [];
		$_SESSION["best_cf"] = 1;
		include 'error.php';
		exit;
	}

	// Menyimpan nama ke session, karena ini diambil dari form dan diperlukan sebelum proses diagnosis
	$_SESSION["nama"] = htmlspecialchars($_POST["nama"]);
	$_SESSION["umur"] = htmlspecialchars($_POST["umur"]);
	$fakta = $selected_gejala; // Fakta awal
	$certainty_factors = []; // Nilai CF untuk setiap penyakit
	$aturan_diproses = true;

	// Ambil semua aturan dari database
	$qry = "SELECT * FROM tb_rule";
	$result = mysqli_query($kon, $qry);
	$rules = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rules[] = $row;
	}

	// Proses diagnosa menggunakan Forward Chaining
	while ($aturan_diproses) {
		$aturan_diproses = false; // Asumsikan tidak ada aturan yang akan diterapkan lagi

		foreach ($rules as $rule) {
			$id_gejala = $rule['id_gejala'];
			$id_penyakit = $rule['id_penyakit'];
			$cf_gejala = $rule['certainty_factor'];

			// Jika gejala dalam aturan ada di fakta
			if (in_array($id_gejala, $fakta)) {
				if (!isset($certainty_factors[$id_penyakit])) {
					$certainty_factors[$id_penyakit] = 0;
				}

				// Kombinasi CF: menggabungkan CF gejala dengan CF penyakit
				$certainty_factors[$id_penyakit] += $cf_gejala * (1 - $certainty_factors[$id_penyakit]);

				// Pastikan CF tidak melebihi 1
				$certainty_factors[$id_penyakit] = min(1, $certainty_factors[$id_penyakit]);

				// Tambahkan penyakit ke daftar fakta jika belum ada
				if (!in_array($id_penyakit, $fakta)) {
					$fakta[] = $id_penyakit;
					$aturan_diproses = true;
				}
			}
		}
	}

	// Urutkan berdasarkan nilai CF
	arsort($certainty_factors);

	// Tentukan penyakit dengan nilai CF tertinggi
	$best_match = key($certainty_factors);
	$best_cf = current($certainty_factors);

	// Tampilkan hasil diagnosa jika CF lebih besar atau sama dengan 0.5
	if ($best_cf >= 0.5) {
		// Ambil data penyakit
		$cari_penyakit_final = "SELECT * FROM tb_penyakit WHERE id=$best_match";
		$db_final = mysqli_query($kon, $cari_penyakit_final);

		$d = mysqli_fetch_array($db_final);
		if ($d) {
			$penyakit = $d['penyakit'];
			$definisi = $d['definisi'];
			$link = $d['link'];
			$penanganan = $d['penanganan'];

			// Menyimpan hasil diagnosis ke session setelah data diperoleh
			$_SESSION["penyakit"] = $penyakit;
			$_SESSION["definisi"] = $definisi;
			$_SESSION["penanganan"] = $penanganan;
			$_SESSION["link"] = $link;
			$_SESSION["certainty_factors"] = $certainty_factors;
			$_SESSION["best_cf"] = $best_cf;

			// Simpan data diagnosa ke database (hanya sekali)
			$nama = mysqli_real_escape_string($kon, $_SESSION["nama"]);
			$umur = mysqli_real_escape_string($kon, $_SESSION["umur"]);
			$gejala_dipilih = mysqli_real_escape_string($kon, implode(', ', $selected_gejala));
			$hasil_diagnosa = mysqli_real_escape_string($kon, $penyakit);
			$cf_tertinggi = round($best_cf * 100, 2);
			$cf_semua = mysqli_real_escape_string($kon, json_encode($certainty_factors));

			// Cek apakah data sudah ada (dalam 5 menit terakhir)
			$query_check = "SELECT id FROM tb_diagnosa_siswa 
							WHERE nama = '$nama' 
							AND umur = '$umur'
							AND gejala_dipilih = '$gejala_dipilih' 
							AND hasil_diagnosa = '$hasil_diagnosa' 
							AND jenis_diagnosa = 'disleksia'
							AND tanggal_diagnosa > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
			$result_check = mysqli_query($kon, $query_check);

			if (mysqli_num_rows($result_check) == 0) {
				$query_save = "INSERT INTO tb_diagnosa_siswa (nama, umur, gejala_dipilih, hasil_diagnosa, cf_tertinggi, cf_semua, jenis_diagnosa) 
							   VALUES ('$nama', '$umur', '$gejala_dipilih', '$hasil_diagnosa', $cf_tertinggi, '$cf_semua', 'disleksia')";
				mysqli_query($kon, $query_save);
			}

			include 'hasil.php';
		}
	} else {
		// Simpan hasil diagnosa 'Normal' ke database jika CF < 0.5
		$nama = mysqli_real_escape_string($kon, $_SESSION["nama"]);
		$umur = mysqli_real_escape_string($kon, $_SESSION["umur"]);
		$gejala_dipilih = mysqli_real_escape_string($kon, implode(', ', $selected_gejala));
		$hasil_diagnosa = 'Normal';
		$cf_tertinggi = isset($best_cf) ? round($best_cf * 100, 2) : 0;
		$cf_semua = mysqli_real_escape_string($kon, json_encode($certainty_factors));
		$jenis_diagnosa = 'disleksia';

		// Cek apakah data sudah ada (dalam 5 menit terakhir)
		$query_check = "SELECT id FROM tb_diagnosa_siswa 
						WHERE nama = '$nama'
						AND umur = '$umur'
						AND gejala_dipilih = '$gejala_dipilih' 
						AND hasil_diagnosa = '$hasil_diagnosa' 
						AND jenis_diagnosa = '$jenis_diagnosa'
						AND tanggal_diagnosa > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
		$result_check = mysqli_query($kon, $query_check);
		if (mysqli_num_rows($result_check) == 0) {
			$query_save = "INSERT INTO tb_diagnosa_siswa (nama, umur, gejala_dipilih, hasil_diagnosa, cf_tertinggi, cf_semua, jenis_diagnosa) 
						   VALUES ('$nama', '$umur', '$gejala_dipilih', '$hasil_diagnosa', $cf_tertinggi, '$cf_semua', '$jenis_diagnosa')";
			mysqli_query($kon, $query_save);
		}

		include 'error.php';
	}
}
