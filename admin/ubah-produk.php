<?php require "../koneksi.php" ?>
<?php 
$id = $_GET['id'];
$queryProduk = "SELECT * FROM tbl_produk WHERE id_produk='$id' ";
$resultProduk = mysqli_query($db, $queryProduk);
$produk = mysqli_fetch_assoc($resultProduk);

// Query kategori
$queryKat = "SELECT * FROM tbl_kat_produk";
$resultKat = mysqli_query($db, $queryKat);

// Query variasi produk
$queryVar = "SELECT v.*, w.nm_warna, u.nm_ukuran FROM tbl_produk_variasi v
    LEFT JOIN tbl_warna w ON v.id_warna=w.id_warna
    LEFT JOIN tbl_ukuran u ON v.id_ukuran=u.id_ukuran
    WHERE v.id_produk='$id'";
$resultVar = mysqli_query($db, $queryVar);

if (isset($_POST['ubah'])) {
    $kategori = $_POST['id_kategori'];
    $nmProduk = $_POST['nama'];
    $berat = $_POST['berat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $nmGambar = $_FILES['img']['name'];
    $lokasi = $_FILES['img']['tmp_name'];

    if (!empty($lokasi)) {
        move_uploaded_file($lokasi, "assets/images/foto_produk/$nmGambar");
        $queryEdit = "UPDATE tbl_produk SET id_kategori='$kategori', nm_produk='$nmProduk', berat='$berat', harga='$harga', gambar='$nmGambar', deskripsi='$deskripsi'
        WHERE id_produk='$id'";
        $resultEdit = mysqli_query($db, $queryEdit);
    } else {
        $queryEdit = "UPDATE tbl_produk SET id_kategori='$kategori', nm_produk='$nmProduk', berat='$berat', harga='$harga', deskripsi='$deskripsi'
        WHERE id_produk='$id'";
        $resultEdit = mysqli_query($db, $queryEdit);
    }

    // Update stok per variasi
    if (isset($_POST['stok_variasi']) && is_array($_POST['stok_variasi'])) {
        foreach ($_POST['stok_variasi'] as $id_variasi => $stok) {
            $stok = intval($stok);
            mysqli_query($db, "UPDATE tbl_produk_variasi SET stok='$stok' WHERE id_variasi='$id_variasi'");
        }
    }

    echo "<script>alert('Data produk sudah diubah');location='index.php?pages=produk';</script>";
}
?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input name="nama" type="text" class="form-control"
                                    value="<?php echo htmlspecialchars($produk['nm_produk']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Kategori Produk</label>
                                <select class="form-control select2" name="id_kategori">
                                    <option>-- Pilih Kategori --</option>
                                    <?php while($pilih = mysqli_fetch_array($resultKat)): ?>
                                    <?php $active = ($produk['id_kategori'] == $pilih['id_kategori'])?"selected":""?>
                                    <option value="<?php echo $pilih['id_kategori']?>" <?php echo $active?>>
                                        <?php echo $pilih['nm_kategori']?>
                                    </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Berat Produk (gram)</label>
                                <input name="berat" type="number" class="form-control"
                                    value="<?php echo htmlspecialchars($produk['berat']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Harga Produk</label>
                                <input name="harga" type="number" class="form-control"
                                    value="<?php echo htmlspecialchars($produk['harga']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gambar Sebelumnya</label><br>
                                <?php if($produk['gambar']!=null):?>
                                    <img src="assets/images/foto_produk/<?php echo $produk['gambar']; ?>" alt="product img" class="img-fluid"
                                    style="max-height: 125px;" />
                                <?php endif;?>
                            </div>
                            <div class="form-group">
                                <label>Ganti Gambar</label>
                                <input type="file" class="filestyle" data-buttonname="btn-secondary" name="img">
                            </div>
                        </div>
                    </div>
                    <!-- Tabel Variasi Warna & Ukuran -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Stok per Variasi (Warna & Ukuran)</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Warna</th>
                                            <th>Ukuran</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($variasi = mysqli_fetch_assoc($resultVar)): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($variasi['nm_warna']); ?></td>
                                            <td><?php echo htmlspecialchars($variasi['nm_ukuran']); ?></td>
                                            <td>
                                                <input type="number" name="stok_variasi[<?php echo $variasi['id_variasi']; ?>]" value="<?php echo htmlspecialchars($variasi['stok']); ?>" min="0" class="form-control" style="width:100px;">
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <small>Edit stok sesuai variasi warna & ukuran produk.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea id="elm1" name="deskripsi"><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success waves-effect waves-light" name="ubah">Ubah</button>
                    <a href="index.php?pages=produk" class="btn btn-secondary waves-effect">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>