/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : disleksia

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 14/07/2025 18:29:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for 1_tb_gejala
-- ----------------------------
DROP TABLE IF EXISTS `1_tb_gejala`;
CREATE TABLE `1_tb_gejala`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gejala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `kode`(`kode` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of 1_tb_gejala
-- ----------------------------
INSERT INTO `1_tb_gejala` VALUES (1, 'G001', 'Tulisan tangan tidak terbaca atau sangat berantakan (contoh: sulit membedakan huruf h dengan n)');
INSERT INTO `1_tb_gejala` VALUES (2, 'G002', 'Kesulitan memegang pensil dengan benar (contoh: terlalu kencang atau longgar) ');
INSERT INTO `1_tb_gejala` VALUES (3, 'G003', 'Cepat lelah saat menulis meskipun hanya menulis sedikit');
INSERT INTO `1_tb_gejala` VALUES (4, 'G004', 'Sering membuat bentuk huruf yang tidak konsisten (huruf a kadang seperti o)');
INSERT INTO `1_tb_gejala` VALUES (5, 'G005', 'Terlalu lambat dalam menyalin teks dari papan tulis atau buku');
INSERT INTO `1_tb_gejala` VALUES (6, 'G006', 'Sering salah dalam ejaan saat menulis kata yang sudah dikenal');
INSERT INTO `1_tb_gejala` VALUES (7, 'G007', 'Kesulitan menuangkan ide secara tertulis meskipun dapat mengungkapkan secara lisan');
INSERT INTO `1_tb_gejala` VALUES (8, 'G008', 'Penggunaan tata bahasa dan struktur kalimat yang salah secara berulang');
INSERT INTO `1_tb_gejala` VALUES (9, 'G009', 'Menulis dengan urutan kata yang tidak logis atau acak');
INSERT INTO `1_tb_gejala` VALUES (10, 'G010', 'Kesulitan memahami perintah menulis yang bersifat naratif atau deskriptif ');
INSERT INTO `1_tb_gejala` VALUES (11, 'G011', 'Huruf dan kata tidak mengikuti garis atau batas margin saat menulis');
INSERT INTO `1_tb_gejala` VALUES (12, 'G012', 'Jarak antar huruf atau kata tidak konsisten (terlalu rapat atau terlalu renggang)');
INSERT INTO `1_tb_gejala` VALUES (13, 'G013', 'Teks miring atau menanjak/menurun secara tidak beraturan');
INSERT INTO `1_tb_gejala` VALUES (14, 'G014', 'Kesulitan mengatur posisi huruf dalam kata atau angka dalam baris');
INSERT INTO `1_tb_gejala` VALUES (15, 'G015', 'Huruf besar dan kecil sering tercampur secara tidak sesuai aturan');
INSERT INTO `1_tb_gejala` VALUES (16, 'G016', 'Menolak atau merasa frustrasi saat diminta menulis');
INSERT INTO `1_tb_gejala` VALUES (17, 'G017', 'Menangis atau marah saat mengerjakan tugas menulis');
INSERT INTO `1_tb_gejala` VALUES (18, 'G018', 'Sering mengeluh sakit kepala atau tangan saat sesi menulis dimulai');
INSERT INTO `1_tb_gejala` VALUES (19, 'G019', 'Menunjukkan rasa rendah diri terhadap hasil tulisannya sendiri');
INSERT INTO `1_tb_gejala` VALUES (20, 'G020', 'Menghindari aktivitas menulis di sekolah maupun di rumah');
INSERT INTO `1_tb_gejala` VALUES (21, 'G021', 'Tulisan sulit dibaca dan susunan kalimat tidak logis');
INSERT INTO `1_tb_gejala` VALUES (22, 'G022', 'Ejaan salah, jarak tidak konsisten, dan posisi tulisan acak');
INSERT INTO `1_tb_gejala` VALUES (23, 'G023', 'Menunjukkan emosi negatif (marah/cemas) ketika harus menulis cerita atau jawaban panjang');
INSERT INTO `1_tb_gejala` VALUES (24, 'G024', 'Kesulitan menyampaikan ide melalui tulisan, disertai tulisan berantakan');
INSERT INTO `1_tb_gejala` VALUES (25, 'G025', 'Banyak aspek penulisan terganggu secara bersamaan (motorik, bahasa, dan emosional)');

-- ----------------------------
-- Table structure for 1_tb_penyakit
-- ----------------------------
DROP TABLE IF EXISTS `1_tb_penyakit`;
CREATE TABLE `1_tb_penyakit`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `penyakit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `definisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `penanganan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of 1_tb_penyakit
-- ----------------------------
INSERT INTO `1_tb_penyakit` VALUES (1, 'Disgrafia Motorik', 'Disgrafia motorik merupakan jenis gangguan belajar yang disebabkan oleh lemahnya kemampuan motorik halus yang diperlukan untuk menulis. Anak-anak dengan disgrafia motorik cenderung memiliki tulisan yang sulit dibaca, tidak rapi, dan tidak konsisten dalam ukuran atau bentuk huruf. Gejala utama termasuk kesulitan menggenggam alat tulis dengan benar, kelelahan saat menulis dalam waktu singkat, serta ketidakmampuan menjaga konsistensi tekanan saat menulis.', 'Penanganan disgrafia motorik melibatkan terapi okupasi yang berfokus pada pengembangan keterampilan motorik halus. Anak juga dapat menggunakan alat tulis ergonomis yang dirancang untuk memberikan kenyamanan dan kontrol lebih baik saat menulis. Selain itu, program latihan menulis yang dilakukan secara bertahap dengan dukungan dari terapis atau guru dapat membantu anak memperbaiki koordinasi motorik dan meningkatkan kepercayaan diri.', '1_motorik');
INSERT INTO `1_tb_penyakit` VALUES (2, 'Disgrafia Linguistik', 'Disgrafia linguistik adalah gangguan belajar yang ditandai dengan kesulitan dalam pemrosesan bahasa, yang berdampak pada kemampuan menulis. Anak-anak dengan disgrafia linguistik sering mengalami kesulitan menyusun kata-kata dengan benar, salah mengeja, serta tidak mampu merangkai kalimat menjadi paragraf yang terstruktur. Mereka juga sering merasa frustasi ketika harus menulis cerita atau tugas yang memerlukan ekspresi tertulis.', 'Pendekatan penanganan disgrafia linguistik mencakup latihan pengucapan fonetik yang berkelanjutan untuk memperkuat hubungan antara bunyi dan huruf. Terapi bahasa yang melibatkan pelatihan tata bahasa dan struktur kalimat juga sangat dianjurkan. Bimbingan dari guru atau terapis bahasa dapat membantu anak mengembangkan keterampilan menulis secara bertahap, sehingga mereka lebih percaya diri dalam mengungkapkan ide mereka dalam bentuk tulisan.', '1_linguistik');
INSERT INTO `1_tb_penyakit` VALUES (3, 'Disgrafia Spatial', 'Disgrafia spatial merupakan gangguan belajar yang memengaruhi kemampuan anak dalam menjaga tata letak tulisan. Anak dengan disgrafia ini sering mengalami kesulitan dalam mengatur jarak antar huruf, kata, dan baris. Tulisannya cenderung keluar dari margin atau tidak sejajar pada kertas bergaris. Kesulitan ini sering kali disebabkan oleh kurangnya persepsi visual-spatial yang memadai.', 'Penanganan disgrafia spatial dapat mencakup penggunaan kertas bergaris khusus atau kertas dengan grid yang dirancang untuk membantu anak melatih pengaturan tata letak tulisan. Selain itu, latihan rutin dengan bimbingan langsung dari guru atau terapis dapat membantu anak memahami pentingnya pola tata ruang yang konsisten. Dengan pengawasan yang tepat, anak dapat belajar mengatur tulisan mereka secara lebih terstruktur.', '1_spatial');
INSERT INTO `1_tb_penyakit` VALUES (4, 'Disgrafia Emosional', 'Disgrafia emosional adalah jenis disgrafia yang dipengaruhi oleh faktor emosional, seperti stres, kecemasan, atau tekanan saat menulis. Anak dengan disgrafia ini sering merasa tertekan ketika harus menyelesaikan tugas menulis, yang berakibat pada tulisan yang tidak rapi, banyak kesalahan, atau bahkan penolakan untuk menulis. Masalah emosional ini dapat memperburuk gejala disgrafia lainnya.', 'Penanganan disgrafia emosional berfokus pada memberikan dukungan psikologis melalui konseling untuk membantu anak mengelola stres dan kecemasan. Selain itu, penting untuk menciptakan lingkungan belajar yang mendukung dan bebas tekanan, sehingga anak merasa lebih nyaman saat menulis. Mengurangi beban akademik dan memberikan penguatan positif juga dapat membantu meningkatkan motivasi dan kepercayaan diri anak.', '1_emosional');
INSERT INTO `1_tb_penyakit` VALUES (5, 'Disgrafia Gabungan', 'Disgrafia gabungan adalah jenis disgrafia yang melibatkan kombinasi dari berbagai masalah, termasuk gangguan motorik, linguistik, spatial, dan emosional. Anak-anak dengan disgrafia gabungan menunjukkan berbagai gejala dari jenis-jenis disgrafia lainnya, seperti tulisan yang tidak rapi, kesulitan mengeja, masalah tata letak, serta tekanan emosional yang mengganggu proses menulis.', 'Penanganan disgrafia gabungan memerlukan pendekatan holistik yang dirancang secara individual. Program terapi okupasi, pelatihan bahasa, dukungan emosional melalui konseling, serta adaptasi lingkungan belajar yang fleksibel merupakan bagian penting dari intervensi. Penanganan yang dilakukan secara terpadu dan berkelanjutan dapat membantu anak mengatasi berbagai aspek kesulitan menulis yang mereka hadapi.', '1_gabungan');

-- ----------------------------
-- Table structure for 1_tb_rule
-- ----------------------------
DROP TABLE IF EXISTS `1_tb_rule`;
CREATE TABLE `1_tb_rule`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penyakit` int NULL DEFAULT NULL,
  `id_gejala` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `certainty_factor` float NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_penyakit`(`id_penyakit` ASC) USING BTREE,
  INDEX `id_gejala`(`id_gejala` ASC) USING BTREE,
  CONSTRAINT `1_tb_rule_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `1_tb_penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `1_tb_rule_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `1_tb_gejala` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of 1_tb_rule
-- ----------------------------
INSERT INTO `1_tb_rule` VALUES (1, 1, 'G001', 0.8);
INSERT INTO `1_tb_rule` VALUES (2, 1, 'G002', 0.75);
INSERT INTO `1_tb_rule` VALUES (3, 1, 'G003', 0.7);
INSERT INTO `1_tb_rule` VALUES (4, 1, 'G004', 0.6);
INSERT INTO `1_tb_rule` VALUES (5, 1, 'G005', 0.65);
INSERT INTO `1_tb_rule` VALUES (6, 2, 'G006', 0.8);
INSERT INTO `1_tb_rule` VALUES (7, 2, 'G007', 0.75);
INSERT INTO `1_tb_rule` VALUES (8, 2, 'G008', 0.65);
INSERT INTO `1_tb_rule` VALUES (9, 2, 'G009', 0.7);
INSERT INTO `1_tb_rule` VALUES (10, 2, 'G010', 0.6);
INSERT INTO `1_tb_rule` VALUES (11, 3, 'G011', 0.8);
INSERT INTO `1_tb_rule` VALUES (12, 3, 'G012', 0.75);
INSERT INTO `1_tb_rule` VALUES (13, 3, 'G013', 0.65);
INSERT INTO `1_tb_rule` VALUES (14, 3, 'G014', 0.7);
INSERT INTO `1_tb_rule` VALUES (15, 3, 'G015', 0.6);
INSERT INTO `1_tb_rule` VALUES (16, 4, 'G016', 0.8);
INSERT INTO `1_tb_rule` VALUES (17, 4, 'G017', 0.75);
INSERT INTO `1_tb_rule` VALUES (18, 4, 'G018', 0.6);
INSERT INTO `1_tb_rule` VALUES (19, 4, 'G019', 0.7);
INSERT INTO `1_tb_rule` VALUES (20, 4, 'G020', 0.65);
INSERT INTO `1_tb_rule` VALUES (21, 5, 'G021', 0.75);
INSERT INTO `1_tb_rule` VALUES (22, 5, 'G022', 0.7);
INSERT INTO `1_tb_rule` VALUES (23, 5, 'G023', 0.65);
INSERT INTO `1_tb_rule` VALUES (24, 5, 'G024', 0.7);
INSERT INTO `1_tb_rule` VALUES (25, 5, 'G025', 0.75);

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `userid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `toko` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES (1, 'siabid', '$2y$10$MCQvp6qgEo0IBlFVvj4M1ueU2.I5SyuiX8lVDQ9Mt5NRsP1i13uHC', 'SIABID', 'brain.svg');

-- ----------------------------
-- Table structure for tb_diagnosa_siswa
-- ----------------------------
DROP TABLE IF EXISTS `tb_diagnosa_siswa`;
CREATE TABLE `tb_diagnosa_siswa`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gejala_dipilih` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hasil_diagnosa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cf_tertinggi` decimal(5, 2) NOT NULL,
  `cf_semua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_diagnosa` timestamp NOT NULL DEFAULT current_timestamp,
  `jenis_diagnosa` enum('disleksia','disgrafia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'disleksia',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_diagnosa_siswa
-- ----------------------------

-- ----------------------------
-- Table structure for tb_gejala
-- ----------------------------
DROP TABLE IF EXISTS `tb_gejala`;
CREATE TABLE `tb_gejala`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gejala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `kode`(`kode` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_gejala
-- ----------------------------
INSERT INTO `tb_gejala` VALUES (1, 'G001', 'Sulit mengenali suara huruf (contoh: sering ketukar ucapan huruf b dengan d).');
INSERT INTO `tb_gejala` VALUES (2, 'G002', 'Sering tertukar urutan huruf atau kata (contoh: membaca \"balon\" jadi \"bolan\").');
INSERT INTO `tb_gejala` VALUES (3, 'G003', 'Kesulitan membaca kata-kata panjang (contoh: membaca \"perpustakaan\" jadi \"pusatakaan\").');
INSERT INTO `tb_gejala` VALUES (4, 'G004', 'Susah mengeja kata dengan benar (contoh: mengeja \"pisang\" jadi \"pis-ng\").');
INSERT INTO `tb_gejala` VALUES (5, 'G005', 'Sering lupa tanda baca saat membaca (contoh: tidak berhenti di titik atau koma).');
INSERT INTO `tb_gejala` VALUES (6, 'G006', 'Susah mengerti cerita atau bacaan (contoh: setelah membaca, tidak bisa menjawab isi cerita).');
INSERT INTO `tb_gejala` VALUES (7, 'G007', 'Terlambat bicara atau sulit menyebutkan kata-kata (contoh: \"kucing\" diucapkan \"tucik\").');
INSERT INTO `tb_gejala` VALUES (8, 'G008', 'Bingung dengan simbol atau bentuk kata (contoh: tidak tahu perbedaan huruf \"o\" dan angka \"0\").');
INSERT INTO `tb_gejala` VALUES (9, 'G009', 'Sering membaca kata secara terbalik (contoh: membaca \"topi\" jadi \"ipot\").');
INSERT INTO `tb_gejala` VALUES (10, 'G010', 'Sulit membedakan huruf yang mirip (contoh: bingung antara huruf b dan d).');
INSERT INTO `tb_gejala` VALUES (11, 'G011', 'Susah dalam memperkirakan jarak, ukuran, atau waktu dengan tepat. (contoh: tidak bisa membaca jam analog).');
INSERT INTO `tb_gejala` VALUES (12, 'G012', 'Sulit memahami isi cerita dalam buku (contoh: tidak tahu siapa yang sedang berbicara di cerita).');
INSERT INTO `tb_gejala` VALUES (13, 'G013', 'Tidak bisa fokus saat membaca atau belajar (contoh: sering melihat ke luar jendela saat membaca).');
INSERT INTO `tb_gejala` VALUES (14, 'G014', 'Kesulitan memperhatikan tulisan (contoh: tidak bisa melihat tulisan kecil di papan tulis).');
INSERT INTO `tb_gejala` VALUES (15, 'G015', 'Lambat memahami petunjuk tertulis (contoh: butuh waktu lama membaca dan mengerti instruksi di ujian).');
INSERT INTO `tb_gejala` VALUES (16, 'G016', 'Bingung menghubungkan kata dengan maknanya (contoh: tidak tahu bahwa \"apel\" adalah buah).');
INSERT INTO `tb_gejala` VALUES (17, 'G017', 'Harus membaca dengan suara keras karena tidak bisa membaca dalam hati (contoh: selalu membaca dengan menggerakkan mulut).');
INSERT INTO `tb_gejala` VALUES (18, 'G018', 'Sering membalikan angka (contoh: 6 jadi 9, 12 jadi 21)');
INSERT INTO `tb_gejala` VALUES (19, 'G019', 'Sulit mengerti angka atau tanda matematika (contoh: bingung membedakan \"+\" dan \"-\").');
INSERT INTO `tb_gejala` VALUES (20, 'G020', 'Sering salah saat mengerjakan soal matematika (contoh: 2 + 3 dijawab 6).');

-- ----------------------------
-- Table structure for tb_penyakit
-- ----------------------------
DROP TABLE IF EXISTS `tb_penyakit`;
CREATE TABLE `tb_penyakit`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `penyakit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `definisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `penanganan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_penyakit
-- ----------------------------
INSERT INTO `tb_penyakit` VALUES (1, 'Disleksia Fonologis', 'Gangguan belajar yang memengaruhi kemampuan seseorang untuk memproses fonem, yaitu unit suara terkecil dalam bahasa. Gangguan ini menyebabkan kesulitan dalam membaca, mengucapkan kata-kata, atau memahami struktur fonetik. Disleksia fonologis sering ditemukan pada anak-anak usia sekolah namun dapat berlanjut hingga dewasa jika tidak ditangani dengan tepat.', 'Mengatasi disleksia fonologis memerlukan pendekatan yang membantu individu memahami hubungan antara huruf dan fonem. Strategi yang efektif meliputi terapi fonologis untuk melatih kemampuan mengenali dan menghubungkan suara dengan huruf, serta pendekatan multisensori yang menggabungkan pendengaran, visual, dan kinestetik dalam pembelajaran membaca. Penggunaan teknologi, seperti aplikasi berbasis fonetik, dapat memperkuat latihan secara mandiri. Dukungan dari tutor atau pendidik yang memahami kebutuhan anak dengan disleksia fonologis sangat penting. Kesabaran, latihan teratur, dan pendekatan yang konsisten menjadi kunci keberhasilan dalam meningkatkan kemampuan fonologis individu.', 'fonologis');
INSERT INTO `tb_penyakit` VALUES (2, 'Disleksia Visual', 'Gangguan belajar yang memengaruhi kemampuan seseorang untuk memproses informasi visual, yang berakibat pada kesulitan membaca, mengenali huruf, atau memahami teks. Gangguan ini sering dialami oleh anak-anak, namun juga dapat terjadi pada orang dewasa. Dyslexia visual berkaitan erat dengan kesulitan otak dalam memproses sinyal visual, bukan karena gangguan penglihatan seperti rabun.', 'Mengatasi disleksia visual memerlukan strategi yang berfokus pada penguatan kemampuan pengenalan bentuk huruf dan visual. Latihan seperti membandingkan huruf, mengenali pola, dan visual matching dapat membantu. Menggunakan font yang mudah dibaca, seperti Arial atau Comic Sans, serta meningkatkan kontras teks juga efektif. Pengajaran menggunakan media visual seperti flashcards, infografis, dan teknologi edukatif dapat mendukung pemahaman. Pendampingan oleh spesialis, seperti terapis atau guru yang berpengalaman, penting untuk memastikan metode yang digunakan sesuai dengan kebutuhan individu.', 'visual');
INSERT INTO `tb_penyakit` VALUES (3, 'Disleksia Sintaksis', 'Gangguan belajar yang memengaruhi kemampuan seseorang untuk memahami struktur kalimat dan tata bahasa, yang berakibat pada kesulitan membaca, menulis, dan memahami teks secara menyeluruh. Gangguan ini sering dialami oleh anak-anak, namun juga dapat terjadi pada orang dewasa. Disleksia sintaksis berkaitan dengan kesulitan otak dalam memproses aturan sintaksis bahasa, bukan karena kurangnya pengetahuan tentang kata-kata itu sendiri.', 'Mengatasi disleksia sintaksis memerlukan pendekatan yang membantu individu memahami struktur kalimat dan tata bahasa. Strategi yang efektif termasuk latihan pengurutan kata untuk membangun kalimat yang benar, memahami subjek, predikat, dan objek. Menggunakan visual aids seperti diagram kalimat atau peta konsep dapat mempermudah pemahaman struktur sintaksis. Membaca bersama dengan panduan guru atau terapis juga dapat membantu individu mengenali pola tata bahasa. Kesabaran, latihan rutin, dan metode pengajaran yang sistematis penting untuk memperkuat kemampuan sintaksis bagi individu dengan disleksia ini.', 'sintaksis');
INSERT INTO `tb_penyakit` VALUES (4, 'Disleksia Aritmetika', 'Gangguan belajar yang memengaruhi kemampuan seseorang dalam memahami dan memproses konsep angka serta operasi matematika. Gangguan ini sering dialami oleh anak-anak, namun juga dapat terjadi pada orang dewasa. Disleksia aritmetika berkaitan dengan kesulitan otak dalam memproses informasi numerik, bukan karena kurangnya pengetahuan matematika dasar.', 'Mengatasi disleksia aritmetika memerlukan pendekatan yang membantu individu memahami konsep matematika dasar dan hubungan antar angka. Strategi yang efektif termasuk penggunaan alat bantu visual seperti gambar, diagram, dan manipulatif untuk memperjelas konsep matematika. Pendekatan multisensori yang melibatkan penglihatan, pendengaran, dan sentuhan dapat membantu individu memproses informasi matematika dengan lebih baik. Latihan berulang dengan masalah sederhana, serta pengajaran yang terstruktur dan bertahap, penting untuk membangun keterampilan aritmetika. Dukungan dari tutor atau pendidik yang berpengalaman dalam mengatasi disleksia aritmetika juga sangat penting untuk memperkuat pemahaman matematika bagi individu dengan kesulitan ini.', 'aritmetika');
INSERT INTO `tb_penyakit` VALUES (5, 'Disleksia Gabungan', 'Gabungan belajar yang melibatkan kombinasi dari berbagai jenis disleksia, yaitu fonologis, visual, sintaksis, dan aritmetika. Gangguan ini memengaruhi kemampuan seseorang dalam membaca, memahami teks, memproses informasi visual, serta mengolah angka dan operasi matematika. Disleksia gabungan sering kali memiliki dampak yang lebih kompleks dibandingkan dengan jenis disleksia individu, sehingga memerlukan pendekatan yang lebih holistik untuk penanganannya.', 'Mengatasi disleksia gabungan memerlukan pendekatan menyeluruh yang mencakup aspek fonologis, visual, sintaksis, dan aritmetika. Strategi melibatkan latihan phonemic awareness, penggunaan alat bantu visual seperti flashcards, serta pengurutan kalimat untuk memahami struktur bahasa. Alat manipulatif dan permainan matematika dapat membantu dalam aspek aritmetika. Dukungan dari guru atau terapis spesialis serta metode pengajaran yang sistematis sangat penting untuk keberhasilan proses ini.', 'gabungan');

-- ----------------------------
-- Table structure for tb_rule
-- ----------------------------
DROP TABLE IF EXISTS `tb_rule`;
CREATE TABLE `tb_rule`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penyakit` int NULL DEFAULT NULL,
  `id_gejala` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `certainty_factor` float NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_penyakit`(`id_penyakit` ASC) USING BTREE,
  INDEX `id_gejala`(`id_gejala` ASC) USING BTREE,
  CONSTRAINT `tb_rule_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `tb_penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_rule_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `tb_gejala` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_rule
-- ----------------------------
INSERT INTO `tb_rule` VALUES (1, 1, 'G001', 0.8);
INSERT INTO `tb_rule` VALUES (2, 1, 'G002', 0.7);
INSERT INTO `tb_rule` VALUES (3, 1, 'G003', 0.7);
INSERT INTO `tb_rule` VALUES (4, 1, 'G004', 0.8);
INSERT INTO `tb_rule` VALUES (5, 1, 'G007', 0.2);
INSERT INTO `tb_rule` VALUES (6, 2, 'G005', 0.4);
INSERT INTO `tb_rule` VALUES (7, 2, 'G008', 0.8);
INSERT INTO `tb_rule` VALUES (8, 2, 'G009', 0.4);
INSERT INTO `tb_rule` VALUES (9, 2, 'G010', 0.8);
INSERT INTO `tb_rule` VALUES (10, 2, 'G014', 0.8);
INSERT INTO `tb_rule` VALUES (11, 3, 'G006', 0.8);
INSERT INTO `tb_rule` VALUES (12, 3, 'G012', 0.8);
INSERT INTO `tb_rule` VALUES (13, 3, 'G013', 0.4);
INSERT INTO `tb_rule` VALUES (14, 3, 'G015', 0.8);
INSERT INTO `tb_rule` VALUES (15, 3, 'G016', 0.8);
INSERT INTO `tb_rule` VALUES (16, 4, 'G018', 0.8);
INSERT INTO `tb_rule` VALUES (17, 4, 'G019', 0.8);
INSERT INTO `tb_rule` VALUES (18, 4, 'G020', 0.4);
INSERT INTO `tb_rule` VALUES (19, 5, 'G003', 0.3);
INSERT INTO `tb_rule` VALUES (20, 5, 'G005', 0.3);
INSERT INTO `tb_rule` VALUES (21, 5, 'G006', 0.6);
INSERT INTO `tb_rule` VALUES (22, 4, 'G011', 0.6);
INSERT INTO `tb_rule` VALUES (23, 5, 'G013', 0.3);
INSERT INTO `tb_rule` VALUES (24, 5, 'G017', 0.8);
INSERT INTO `tb_rule` VALUES (25, 5, 'G019', 0.7);

SET FOREIGN_KEY_CHECKS = 1;
