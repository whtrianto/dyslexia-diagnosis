<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
	$selected_gejala = isset($_POST['gejala']) ? $_POST['gejala'] : [];

	if (empty($selected_gejala)) {
		include 'error.php';
		exit;
	}

	$certainty_factors = [];

	// Ambil nilai CF untuk gejala yang dipilih
	foreach ($selected_gejala as $gejala) {
		$qry = "SELECT id_penyakit, certainty_factor FROM tb_rule WHERE id_gejala='$gejala'";
		$result = mysqli_query($kon, $qry);

		while ($row = mysqli_fetch_assoc($result)) {
			$id_penyakit = $row['id_penyakit'];
			$cf_gejala = $row['certainty_factor'];

			if (!isset($certainty_factors[$id_penyakit])) {
				$certainty_factors[$id_penyakit] = 0;
			}

			// Kombinasi CF: CF(old) + CF(new) * (1 - CF(old))
			$certainty_factors[$id_penyakit] = $certainty_factors[$id_penyakit] + $cf_gejala * (1 - $certainty_factors[$id_penyakit]);
		}
	}

	// Tentukan penyakit dengan nilai CF tertinggi
	arsort($certainty_factors); // Urutkan berdasarkan CF secara menurun
	$best_match = key($certainty_factors);
	$best_cf = current($certainty_factors);

	if ($best_cf >= 0.5) { // Contoh threshold untuk diagnosa positif
		$cari_penyakit = "SELECT * FROM tb_penyakit WHERE id=$best_match";
		$db = mysqli_query($kon, $cari_penyakit);
		while ($d = mysqli_fetch_array($db)) {
			$penyakit = $d['penyakit'];
			$definisi = $d['definisi'];
			include 'hasil.php';
		}
	} else {
		include 'error.php';
	}
}
