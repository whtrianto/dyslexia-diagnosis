<?php include 'sidebar.php'; ?>
<br>
<h1 class="h3 mb-0">
    Data CF Disleksia
    <button class="btn btn-info btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambahtb_rule">Tambah</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Jenis</th>
            <th>Gejala</th>
            <th>CF</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_id_penyakit = mysqli_query($kon, "SELECT * FROM tb_rule ORDER BY id ASC");
        while ($d = mysqli_fetch_array($data_id_penyakit)) {
        ?>
            <tr class="text-center">
                <td class="align-middle"><?= $no++; ?></td>
                <td class="align-middle text-left"><?= $d['id_penyakit']; ?></td>
                <td class="align-middle text-left"><?= $d['id_gejala']; ?>
                </td>
                <td class="align-middle text-left"><?= $d['certainty_factor']; ?>
                </td>
                <td class="align-middle">
                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#Editid_penyakit<?= $d['id']; ?>">
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
if (isset($_POST['Tambahtb_rule'])) {
    $id_penyakit = htmlspecialchars($_POST['Tambah_id_penyakit']);
    $id_gejala = htmlspecialchars($_POST['Tambah_id_gejala']);
    $certainty_factor = htmlspecialchars($_POST['Tambah_certainty_factor']);

    $insert = mysqli_query($kon, "INSERT INTO tb_rule (id_penyakit, id_gejala, certainty_factor) VALUES ('$id_penyakit','$id_gejala','$certainty_factor')");

    echo $insert
        ? '<script>window.location.href=window.location.href;</script>'
        : '<script>alert("Gagal Menambahkan Data (ID yang anda masukan tidak ada di tabel id jenis/gejalanya)");window.location.href=window.location.href;</script>';
}


// Proses Edit
if (isset($_POST['SimpanEdit'])) {
    $id = htmlspecialchars($_POST['id']);
    $id_penyakit = htmlspecialchars($_POST['Edit_id_penyakit']);
    $id_gejala = htmlspecialchars($_POST['Edit_id_gejala']);
    $certainty_factor = htmlspecialchars($_POST['Edit_certainty_factor']);

    $update = mysqli_query($kon, "UPDATE tb_rule SET id_penyakit='$id_penyakit', id_gejala='$id_gejala', certainty_factor='$certainty_factor' WHERE id='$id'");

    if ($update) {
        echo '<script>window.location.href=window.location.href;</script>';
    } else {
        echo '<script>alert("Gagal Edit Data: ID yang diedit tidak ada di tabel id jenis/gejalanya");window.location.href=window.location.href;</script>';
    }
}


// Proses Hapus
if (!empty($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($kon, "DELETE FROM tb_rule WHERE id='$id'");
    echo $hapus ? '<script>window.location.href="cf.php";</script>' : '<script>alert("Gagal Hapus Data");</script>';
}
?>

<!-- Modal Tambah -->
<div class="modal fade" id="Tambahtb_rule" tabindex="-1" role="dialog">
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
                        <input type="text" name="Tambah_id_penyakit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gejala :</label>
                        <textarea name="Tambah_id_gejala" class="form-control" rows="1" style="resize: vertical;" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>CF :</label>
                        <textarea name="Tambah_certainty_factor" class="form-control" rows="1" style="resize: vertical;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="Tambahtb_rule" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit (Ditempatkan di luar tbody) -->
<?php
$data_id_penyakit_modal = mysqli_query($kon, "SELECT * FROM tb_rule ORDER BY id ASC");
while ($d = mysqli_fetch_array($data_id_penyakit_modal)) {
?>
    <div class="modal fade" id="Editid_penyakit<?= $d['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                    <div class="modal-header bg-purple">
                        <h5 class="modal-title text-white">Edit</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis :</label>
                            <textarea name="Edit_id_penyakit" class="form-control" rows="1" style="resize: vertical;" required><?= $d['id_penyakit']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gejala :</label>
                            <textarea name="Edit_id_gejala" class="form-control" rows="1" style="resize: vertical;" required><?= $d['id_gejala']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>CF :</label>
                            <textarea name="Edit_certainty_factor" class="form-control" rows="1" style="resize: vertical;" required><?= $d['certainty_factor']; ?></textarea>
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