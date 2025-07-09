<?php
    include "../koneksi.php";
?>
<?php
// Hapus warna jika ada parameter id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryHapus = "DELETE FROM tbl_warna WHERE id_warna='$id'";
    $execHapus = mysqli_query($db, $queryHapus);

    if ($execHapus) {
        echo "<script>alert('Warna sudah dihapus');</script>";
        echo "<script>location='index.php?pages=tambah-warna';</script>";
    }
}

// Tambah warna baru
if (isset($_POST['tambah'])) {
    $nama = trim($_POST['nama']);
    if ($nama != "") {
        $db->query("INSERT INTO tbl_warna (nm_warna) VALUES ('$nama')");
        echo "<script>location='index.php?pages=tambah-warna';</script>";
    }
}
?>
<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="warna">Nama Warna</label>
                                <input id="warna" name="nama" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success waves-effect waves-light" name="tambah">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card m-b-20">
            <div class="card-body">
                <label for="warna">Daftar Warna</label><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Warna</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php $ambil=$db->query("SELECT * FROM tbl_warna"); ?>
                        <?php while($pecah=$ambil->fetch_assoc()){ ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><?php echo htmlspecialchars($pecah['nm_warna']); ?></td>
                            <td>
                                <a href="index.php?pages=tambah-warna&id=<?php echo $pecah['id_warna']; ?>"
                                    class="text-muted" data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus warna ini?')">
                                    <i class="mdi mdi-close font-18"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>