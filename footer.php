<!-- Footer -->
<?php
require('koneksi.php');
$sql    = "SELECT * FROM login";
$query  = mysqli_query($kon, $sql);
while ($data = mysqli_fetch_array($query)) {
?>
	<footer>
		<a href="editd.php" class="foot text-white">
			<div class="left-text">&copy; 2025 <?php echo $data["toko"]; ?></div>
		</a>
		<div class="right-text">
			<a href="https://informatika.ump.ac.id/" style="text-decoration: none;" class="foot text-white">Teknik Informatika</a> |
			<a href="https://psikologi.ump.ac.id/" style="text-decoration: none;" class="foot text-white">Psikologi</a> |
			<a href="https://ump.ac.id/" style="text-decoration: none;" class="foot text-white">UMP</a>
		</div>
	</footer>
<?php } ?>
<script>
	window.addEventListener('load', () => {
		// Animasi untuk section (.hero-section atau .hero-section1)
		const hero = document.querySelector('.hero-section, .hero-section1');
		if (hero) {
			hero.classList.add('animate');
		}

		// Animasi isi dalam section satu per satu
		const fadeItems = document.querySelectorAll('.fade-item');
		fadeItems.forEach((item, index) => {
			setTimeout(() => {
				item.classList.add('animate');
			}, index * 200);
		});

		// Animasi kartu fitur satu per satu
		const cards = document.querySelectorAll('.feature-card');
		cards.forEach((card, index) => {
			setTimeout(() => {
				card.classList.add('animate');
			}, (fadeItems.length * 200) + (index * 200)); // muncul setelah isi section selesai
		});
	});
</script>
<style>
	.container,
	.page-content,
	.main-content {
		margin-bottom: 20px !important;
	}

	footer {
		margin-top: 10px !important;
		position: relative;
	}

	footer:before {
		content: '';
		display: block;
		height: 20px;
		width: 30%;
		margin-bottom: 0;
	}
</style>


</body>

</html>