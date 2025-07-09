<?php
    include "../koneksi.php";
?>
<?php
// Hapus ukuran jika ada parameter id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryHapus = "DELETE FROM tbl_ukuran WHERE id_ukuran='$id'";
    $execHapus = mysqli_query($db, $queryHapus);

    if ($execHapus) {
        echo "<script>alert('Ukuran sudah dihapus');</script>";
        echo "<script>location='index.php?pages=tambah-ukuran';</script>";
    }
}

// Tambah ukuran baru
if (isset($_POST['tambah'])) {
    $nama = trim($_POST['nama']);
    if ($nama != "") {
        $db->query("INSERT INTO tbl_ukuran (nm_ukuran) VALUES ('$nama')");
        echo "<script>location='index.php?pages=tambah-ukuran';</script>";
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
                                <label for="ukuran">Nama Ukuran</label>
                                <input id="ukuran" name="nama" type="text" class="form-control" required>
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
                <label for="ukuran">Daftar Ukuran</label><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Ukuran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php $ambil=$db->query("SELECT * FROM tbl_ukuran"); ?>
                        <?php while($pecah=$ambil->fetch_assoc()){ ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><?php echo htmlspecialchars($pecah['nm_ukuran']); ?></td>
                            <td>
                                <a href="index.php?pages=tambah-ukuran&id=<?php echo $pecah['id_ukuran']; ?>"
                                    class="text-muted" data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ukuran ini?')">
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