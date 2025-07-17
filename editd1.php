<?php include 'sidebar.php'; ?>
<br>
<h1 class="h3 mb-0">
    Data Disgrafia
    <button class="btn btn-info btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah1_tb_penyakit">Tambah</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Jenis</th>
            <th>Definisi</th>
            <th>Penanganan</th>
            <th>Link</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_penyakit = mysqli_query($kon, "SELECT * FROM 1_tb_penyakit ORDER BY id ASC");
        while ($d = mysqli_fetch_array($data_penyakit)) {
        ?>
            <tr class="text-center">
                <td class="align-middle"><?= $no++; ?></td>
                <td class="align-middle text-left"><?= $d['penyakit']; ?></td>
                <td class="align-middle text-left">
                    <div style="max-height: 150px; overflow-y: auto; white-space: pre-wrap;"><?= $d['definisi']; ?></div>
                </td>
                <td class="align-middle text-left">
                    <div style="max-height: 150px; overflow-y: auto; white-space: pre-wrap;"><?= $d['penanganan']; ?></div>
                </td>

                <td class="align-middle text-left"><?= $d['link']; ?></td>
                <td class="align-middle">
                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#Editpenyakit<?= $d['id']; ?>">
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
if (isset($_POST['Tambah1_tb_penyakit'])) {
    $penyakit = htmlspecialchars($_POST['Tambah_penyakit']);
    $definisi = htmlspecialchars($_POST['Tambah_definisi']);
    $penanganan = htmlspecialchars($_POST['Tambah_penanganan']);
    $link = htmlspecialchars($_POST['Tambah_link']);

    $cek = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM 1_tb_penyakit WHERE penyakit='$penyakit'"));
    if ($cek > 0) {
        echo '<script>alert("penyakit sudah ada");history.go(-1);</script>';
    } else {
        $insert = mysqli_query($kon, "INSERT INTO 1_tb_penyakit (penyakit, definisi, penanganan, link) VALUES ('$penyakit','$definisi','$penanganan','$link')");
        echo $insert ? '<script>history.go(-1);</script>' : '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
}

// Proses Edit
if (isset($_POST['SimpanEdit'])) {
    $id = htmlspecialchars($_POST['id']);
    $penyakit = htmlspecialchars($_POST['Edit_penyakit']);
    $definisi = htmlspecialchars($_POST['Edit_definisi']);
    $penanganan = htmlspecialchars($_POST['Edit_penanganan']);
    $link = htmlspecialchars($_POST['Edit_link']);

    $cek = mysqli_query($kon, "SELECT * FROM 1_tb_penyakit WHERE penyakit='$penyakit' AND id!='$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<script>alert("Kode sudah digunakan!");history.go(-1);</script>';
    } else {
        $update = mysqli_query($kon, "UPDATE 1_tb_penyakit SET penyakit='$penyakit', definisi='$definisi', penanganan='$penanganan', link='$link' WHERE id='$id'")
            or die(mysqli_connect_error());
        echo $update ? '<script>history.go(-1);</script>' : '<script>alert("Gagal Edit Data");history.go(-1);</script>';
    }
}

// Proses Hapus
if (!empty($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($kon, "DELETE FROM 1_tb_penyakit WHERE id='$id'");
    echo $hapus ? '<script>window.location.href="editd1.php";</script>' : '<script>alert("Gagal Hapus Data");</script>';
}
?>

<!-- Modal Tambah -->
<div class="modal fade" id="Tambah1_tb_penyakit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">

            <form method="post" enctype="multipart/form-data">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title text-white">Tambah</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis :</label>
                        <input type="text" name="Tambah_penyakit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Definisi :</label>
                        <textarea name="Tambah_definisi" class="form-control" rows="6" style="resize: vertical;" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Penanganan :</label>
                        <textarea name="Tambah_penanganan" class="form-control" rows="6" style="resize: vertical;" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link :</label>
                        <input type="text" name="Tambah_link" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="Tambah1_tb_penyakit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit (Ditempatkan di luar tbody) -->
<?php
$data_penyakit_modal = mysqli_query($kon, "SELECT * FROM 1_tb_penyakit ORDER BY id ASC");
while ($d = mysqli_fetch_array($data_penyakit_modal)) {
?>
    <div class="modal fade" id="Editpenyakit<?= $d['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                    <div class="modal-header bg-purple">
                        <h5 class="modal-title text-white">Edit </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis :</label>
                            <textarea name="Edit_penyakit" class="form-control" rows="1" style="resize: vertical;" required><?= $d['penyakit']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Definisi :</label>
                            <textarea name="Edit_definisi" class="form-control" rows="10" style="resize: vertical;" required><?= $d['definisi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Penanganan :</label>
                            <textarea name="Edit_penanganan" class="form-control" rows="10" style="resize: vertical;" required><?= $d['penanganan']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link :</label>
                            <textarea name="Edit_link" class="form-control" rows="1" style="resize: vertical;" required><?= $d['link']; ?></textarea>
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