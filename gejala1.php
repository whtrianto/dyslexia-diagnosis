<?php include 'sidebar.php'; ?>
<br>
<h1 class="h3 mb-0">
    Gejala Disgrafia
    <button class="btn btn-info btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah1_tb_gejala">Tambah Gejala</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Kode</th>
            <th>Gejala</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_gejala = mysqli_query($kon, "SELECT * FROM 1_tb_gejala ORDER BY id ASC");
        while ($d = mysqli_fetch_array($data_gejala)) {
        ?>
            <tr class="text-center">
                <td class="align-middle"><?= $no++; ?></td>
                <td class="align-middle"><?= $d['kode']; ?></td>
                <td class="align-middle text-left"><?= $d['gejala']; ?></td>
                <td class="align-middle">
                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#EditGejala<?= $d['id']; ?>">
                        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
                    </button>
                    <a class="btn btn-danger btn-sm" href="?hapus=<?= $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
// Proses Tambah
if (isset($_POST['Tambah1_tb_gejala'])) {
    $kode = htmlspecialchars($_POST['Tambah_Kode_1_tb_gejala']);
    $gejala = htmlspecialchars($_POST['Tambah_gejala']);

    $cek = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM 1_tb_gejala WHERE kode='$kode'"));
    if ($cek > 0) {
        echo '<script>alert("Kode sudah ada");history.go(-1);</script>';
    } else {
        $insert = mysqli_query($kon, "INSERT INTO 1_tb_gejala (kode, gejala) VALUES ('$kode', '$gejala')");
        echo $insert ? '<script>history.go(-1);</script>' : '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
}

// Proses Edit
if (isset($_POST['SimpanEdit'])) {
    $id = htmlspecialchars($_POST['id']);
    $kode = htmlspecialchars($_POST['Edit_Kode_1_tb_gejala']);
    $gejala = htmlspecialchars($_POST['Edit_gejala']);

    $cek = mysqli_query($kon, "SELECT * FROM 1_tb_gejala WHERE kode='$kode' AND id!='$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<script>alert("Kode sudah digunakan!");history.go(-1);</script>';
    } else {
        $update = mysqli_query($kon, "UPDATE 1_tb_gejala SET kode='$kode', gejala='$gejala' WHERE id='$id'")
            or die(mysqli_connect_error());
        echo $update ? '<script>history.go(-1);</script>' : '<script>alert("Gagal Edit Data");history.go(-1);</script>';
    }
}

// Proses Hapus
if (!empty($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($kon, "DELETE FROM 1_tb_gejala WHERE id='$id'");
    echo $hapus ? '<script>window.location.href="gejala1.php";</script>' : '<script>alert("Gagal Hapus Data");</script>';
}
?>

<!-- Modal Tambah -->
<div class="modal fade" id="Tambah1_tb_gejala" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <?php
            $getKode = mysqli_query($kon, "SELECT MAX(kode) AS maxID FROM 1_tb_gejala");
            $dataKode = mysqli_fetch_array($getKode);

            $kodeTerakhir = $dataKode['maxID']; // contoh: G012

            $urutan = (int)substr($kodeTerakhir, 1); // ambil angka setelah huruf, misal 012 jadi 12
            $urutan++; // naikkan 1

            $kodeBaru = 'G' . sprintf("%03s", $urutan); // hasil: G013
            ?>

            <form method="post" enctype="multipart/form-data">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title text-white">Tambah Gejala</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Gejala :</label>
                        <input type="text" name="Tambah_Kode_1_tb_gejala" value="<?= $kodeBaru; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Gejala :</label>
                        <textarea name="Tambah_gejala" class="form-control" rows="4" style="resize: vertical;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="Tambah1_tb_gejala" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit (Ditempatkan di luar tbody) -->
<?php
$data_gejala_modal = mysqli_query($kon, "SELECT * FROM 1_tb_gejala ORDER BY id ASC");
while ($d = mysqli_fetch_array($data_gejala_modal)) {
?>
    <div class="modal fade" id="EditGejala<?= $d['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                    <div class="modal-header bg-purple">
                        <h5 class="modal-title text-white">Edit Gejala</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode :</label>
                            <input type="text" name="Edit_Kode_1_tb_gejala" value="<?= $d['kode']; ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Gejala :</label>
                            <textarea name="Edit_gejala" class="form-control" rows="4" style="resize: vertical;" required><?= $d['gejala']; ?></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" name="SimpanEdit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'footer1.php'; ?>