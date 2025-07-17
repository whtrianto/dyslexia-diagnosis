# Panduan Instalasi Fitur Rekap Data Siswa

## Langkah-langkah Instalasi

### 1. Setup Database
Jalankan file `setup_database.php` di browser untuk membuat tabel yang diperlukan:
```
http://localhost/disleksia/setup_database.php
```

Atau jika Anda menggunakan phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database `disleksia`
3. Klik tab "SQL"
4. Copy dan paste isi file `create_table_diagnosa.sql`
5. Klik "Go" untuk menjalankan

### 2. Verifikasi File
Pastikan semua file berikut sudah ada:
- ✅ `rekap_siswa.php` - Halaman utama rekap data
- ✅ `detail_diagnosa.php` - Modal detail diagnosa
- ✅ `hapus_diagnosa.php` - Proses hapus data
- ✅ `export_excel.php` - Export data ke Excel
- ✅ `setup_database.php` - Setup database (opsional setelah dijalankan)
- ✅ `cek_database.php` - Cek status database dan tabel
- ✅ `header_admin.php` - Header admin dengan struktur HTML lengkap
- ✅ `sidebar_content.php` - Konten sidebar tanpa struktur HTML
- ✅ `test_sidebar.php` - Test sidebar (opsional)
- ✅ `test_rekap.php` - Test rekap data (opsional)
- ✅ `clean_duplicate_data.php` - Pembersihan data duplikat (opsional)

### 3. Verifikasi Modifikasi File
Pastikan file berikut sudah dimodifikasi:
- ✅ `database/disleksia.sql` - Sudah ditambahkan struktur tabel
- ✅ `proses.php` - Sudah ditambahkan penyimpanan data disleksia
- ✅ `1_proses.php` - Sudah ditambahkan penyimpanan data disgrafia
- ✅ `sidebar.php` - Sudah ditambahkan menu rekap data

### 4. Test Fitur
1. Login sebagai admin (username: admin, password: admin)
2. Klik menu "Rekap Data Siswa" di sidebar
3. Lakukan diagnosa baru untuk menguji penyimpanan data
4. Test fitur filter, detail, dan export

### 5. Cek Status Database (Opsional)
Jalankan `cek_database.php` untuk memverifikasi status database dan tabel:
```
http://localhost/disleksia/cek_database.php
```

### 6. Test Koneksi Database (Opsional)
Jalankan `test_rekap.php` untuk memverifikasi koneksi database dan query:
```
http://localhost/disleksia/test_rekap.php
```

### 7. Pembersihan Data Duplikat (Jika Ada)
Jika ada data duplikat, jalankan `clean_duplicate_data.php`:
```
http://localhost/disleksia/clean_duplicate_data.php
```

## Troubleshooting

### Jika tabel tidak terbuat:
1. Pastikan koneksi database benar di `koneksi.php`
2. Pastikan database `disleksia` sudah ada
3. Jalankan `setup_database.php` lagi

### Jika menu tidak muncul:
1. Pastikan sudah login sebagai admin
2. Refresh halaman atau clear cache browser
3. Periksa file `sidebar.php` sudah dimodifikasi

### Jika data tidak tersimpan:
1. Periksa file `proses.php` dan `1_proses.php` sudah dimodifikasi
2. Pastikan tabel `tb_diagnosa_siswa` sudah terbuat
3. Periksa error log PHP

### Jika ada error "Undefined variable: kon":
1. Error ini sudah diperbaiki dengan memindahkan query setelah include header
2. Pastikan file `rekap_siswa.php` sudah diupdate
3. Pastikan koneksi database di `koneksi.php` sudah benar
4. Test dengan `test_rekap.php` untuk memverifikasi koneksi

### Jika data tersimpan duplikat:
1. Masalah ini sudah diperbaiki dengan menghilangkan loop while
2. Ditambahkan pengecekan data duplikat sebelum insert
3. Jalankan `clean_duplicate_data.php` untuk membersihkan data duplikat yang sudah ada
4. Pastikan file `proses.php` dan `1_proses.php` sudah diupdate

### Jika export Excel tidak berfungsi:
1. Pastikan browser mengizinkan download
2. Periksa file `export_excel.php` sudah ada
3. Pastikan tidak ada output sebelum header

### Jika ada error session_start():
1. Error ini sudah diperbaiki dengan menambahkan pengecekan session_status()
2. Pastikan semua file sudah diupdate dengan perbaikan session
3. Clear cache browser jika masih ada masalah

### Jika sidebar tidak bisa dibuka:
1. Pastikan file `header_admin.php` dan `sidebar_content.php` sudah ada
2. Periksa file `sidebar.js` sudah dimuat dengan benar
3. Pastikan jQuery dan Bootstrap sudah dimuat
4. Test dengan file `test_sidebar.php` untuk memverifikasi
5. Clear cache browser dan refresh halaman

## Fitur yang Tersedia Setelah Instalasi

1. **Dashboard Rekap Data** - Melihat semua data diagnosa
2. **Filter Data** - Filter berdasarkan jenis diagnosa
3. **Statistik** - Total diagnosa, disleksia, disgrafia, hari ini
4. **Detail Diagnosa** - Modal popup dengan informasi lengkap
5. **Export Excel** - Download data dalam format Excel
6. **Hapus Data** - Hapus data dengan konfirmasi

## Keamanan
- Semua akses dibatasi untuk admin saja
- Data input di-sanitize
- Konfirmasi sebelum hapus data
- Validasi session di setiap file

## Catatan
- Setelah instalasi berhasil, Anda bisa menghapus file `setup_database.php`
- Data akan otomatis tersimpan setiap ada diagnosa baru
- Backup database secara berkala untuk keamanan data 