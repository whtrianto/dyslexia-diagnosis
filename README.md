# Sistem Pakar Identifikasi Gangguan Belajar (Disleksia & Disgrafia)

Aplikasi ini adalah sistem pakar berbasis web untuk membantu identifikasi dini gangguan belajar, khususnya Disleksia dan Disgrafia, pada anak. Sistem ini menyediakan fitur pengecekan gejala, rekap data diagnosa, serta panduan penanganan berbasis data dan penelitian medis terbaru.

## Fitur Utama

- **Identifikasi Cepat**: Pengguna dapat melakukan pengecekan gejala Disleksia dan Disgrafia secara mudah dan cepat.
- **Data Akurat**: Diagnosa berbasis data dan penelitian medis, menggunakan metode Certainty Factor (CF) untuk hasil yang dapat diandalkan.
- **Rekap Data Siswa**: Admin dapat melihat, memfilter, dan mengekspor rekap data diagnosa siswa (Disleksia & Disgrafia) ke Excel.
- **Detail Diagnosa**: Tersedia detail hasil diagnosa, gejala yang dipilih, dan nilai CF untuk setiap siswa.
- **Statistik Dashboard**: Statistik jumlah diagnosa, jenis gangguan, dan diagnosa harian.
- **Manajemen Data**: Admin dapat menghapus data diagnosa, serta fitur pencarian dan filter data.
- **Akses Mudah**: Platform dapat diakses kapan saja dan di mana saja melalui browser.
- **Panduan & Informasi**: Tersedia halaman informasi lengkap tentang Disleksia dan Disgrafia, termasuk jenis, ciri-ciri, penyebab, dan penanganan.

## Cara Penggunaan

1. **Setup Database**
   - Jalankan `setup_database.php` atau import `create_table_diagnosa.sql` ke database MySQL Anda.
2. **Akses Aplikasi**
   - Buka aplikasi di browser (misal: `http://localhost/disleksia/`).
   - Untuk admin, login menggunakan akun yang tersedia.
3. **Cek Disleksia/Disgrafia**
   - Pilih menu "Cek Disleksia" atau "Cek Disgrafia".
   - Isi data dan pilih gejala yang dialami.
   - Sistem akan menampilkan hasil diagnosa dan saran penanganan.
4. **Rekap Data Siswa (Admin)**
   - Masuk ke menu "Rekap Data Siswa" untuk melihat, memfilter, dan mengekspor data diagnosa.

## Struktur Menu Utama

- **Home**: Halaman utama aplikasi.
- **Panduan**: Petunjuk penggunaan aplikasi.
- **Cek Disleksia**: Informasi dan pengecekan gejala Disleksia.
- **Cek Disgrafia**: Informasi dan pengecekan gejala Disgrafia.
- **Rekap Data Siswa**: (Admin) Rekap hasil diagnosa seluruh siswa.
- **Pengaturan**: (Admin) Pengaturan aplikasi.

## Teknologi yang Digunakan

- **PHP** (Backend)
- **MySQL** (Database)
- **Bootstrap 4** (UI/UX)
- **jQuery** (AJAX & Interaktif)
- **DataTables** (Tabel interaktif)
- **Font Awesome** (Ikon)
- **Dompdf** (Export PDF)

## Keamanan

- Akses rekap data dan manajemen hanya untuk admin yang sudah login.
- Validasi dan sanitasi input untuk mencegah SQL injection.
- Konfirmasi sebelum penghapusan data.

## Kontributor

Dibuat oleh Wahyu Trianto (2003040100)

---

Untuk dokumentasi fitur rekap data siswa dan instalasi, lihat juga:

- `README_REKAP_SISWA.md`
- `PANDUAN_INSTALASI_REKAP.md`

---

Sumber: [whtrianto/dyslexia-diagnosis](https://github.com/whtrianto/dyslexia-diagnosis)
