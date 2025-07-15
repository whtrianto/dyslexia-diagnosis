# Fitur Rekap Data Siswa Diagnosa

## Deskripsi
Fitur ini memungkinkan admin untuk melihat rekap data siswa yang telah melakukan diagnosa disleksia dan disgrafia. Data yang disimpan meliputi nama siswa, gejala yang dipilih, hasil diagnosa, dan nilai certainty factor.

## Fitur yang Tersedia

### 1. Tabel Rekap Data
- Menampilkan semua data diagnosa siswa dalam format tabel
- Informasi yang ditampilkan:
  - Nama siswa
  - Jenis diagnosa (Disleksia/Disgrafia)
  - Gejala yang dipilih
  - Hasil diagnosa
  - CF tertinggi (dengan indikator warna)
  - Tanggal dan waktu diagnosa

### 2. Filter Data
- Filter berdasarkan jenis diagnosa:
  - Semua jenis
  - Disleksia saja
  - Disgrafia saja

### 3. Statistik Dashboard
- Total diagnosa
- Jumlah diagnosa disleksia
- Jumlah diagnosa disgrafia
- Jumlah diagnosa hari ini

### 4. Detail Diagnosa
- Modal popup untuk melihat detail lengkap diagnosa
- Informasi detail CF semua jenis gangguan
- Gejala yang dipilih dengan format yang mudah dibaca

### 5. Export Excel
- Export data ke format Excel (.xls)
- Dapat difilter berdasarkan jenis diagnosa
- Format yang rapi dengan header dan footer

### 6. Manajemen Data
- Hapus data diagnosa (dengan konfirmasi)
- Data table dengan fitur search, sort, dan pagination

## File yang Dibuat/Dimodifikasi

### File Baru:
1. `rekap_siswa.php` - Halaman utama rekap data
2. `detail_diagnosa.php` - Modal detail diagnosa
3. `hapus_diagnosa.php` - Proses hapus data
4. `export_excel.php` - Export data ke Excel
5. `create_table_diagnosa.sql` - Script pembuatan tabel

### File yang Dimodifikasi:
1. `database/disleksia.sql` - Menambahkan struktur tabel baru
2. `proses.php` - Menambahkan penyimpanan data diagnosa disleksia
3. `1_proses.php` - Menambahkan penyimpanan data diagnosa disgrafia
4. `sidebar.php` - Menambahkan menu rekap data siswa

## Struktur Database

### Tabel: `tb_diagnosa_siswa`
```sql
CREATE TABLE `tb_diagnosa_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `gejala_dipilih` text NOT NULL,
  `hasil_diagnosa` varchar(255) NOT NULL,
  `cf_tertinggi` decimal(5,2) NOT NULL,
  `cf_semua` text NOT NULL,
  `tanggal_diagnosa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_diagnosa` enum('disleksia','disgrafia') NOT NULL DEFAULT 'disleksia',
  PRIMARY KEY (`id`)
);
```

## Cara Penggunaan

### 1. Setup Database
Jalankan script SQL untuk membuat tabel:
```sql
-- Import file create_table_diagnosa.sql atau
-- Jalankan query CREATE TABLE yang ada di file tersebut
```

### 2. Akses Fitur
1. Login sebagai admin
2. Klik menu "Rekap Data Siswa" di sidebar
3. Gunakan filter untuk melihat data tertentu
4. Klik tombol "Detail" untuk melihat informasi lengkap
5. Klik tombol "Export Excel" untuk mengunduh data

### 3. Manajemen Data
- **Lihat Detail**: Klik tombol "Detail" pada baris data
- **Hapus Data**: Klik tombol "Hapus" dan konfirmasi
- **Export Data**: Klik tombol "Export Excel"

## Keamanan
- Semua akses dibatasi hanya untuk admin yang sudah login
- Data input di-sanitize untuk mencegah SQL injection
- Konfirmasi sebelum menghapus data
- Validasi session di setiap file

## Teknologi yang Digunakan
- PHP dengan MySQL
- Bootstrap 4 untuk UI
- DataTables untuk tabel interaktif
- jQuery untuk AJAX
- Font Awesome untuk ikon

## Catatan Penting
- Pastikan database sudah dibuat dan tabel `tb_diagnosa_siswa` sudah ada
- File ini akan otomatis menyimpan data setiap kali ada diagnosa baru
- Data yang dihapus tidak dapat dikembalikan
- Export Excel menggunakan format HTML table yang kompatibel dengan Excel 