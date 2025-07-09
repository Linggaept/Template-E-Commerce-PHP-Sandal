<?php include "../koneksi.php" ?>

<!-- Menampilkan Daftar Kategori Produk -->
<?php
$query = "SELECT * FROM tbl_kat_produk";
$result = mysqli_query($db, $query);
$warna = mysqli_query($db, "SELECT * FROM tbl_warna");
$ukuran = mysqli_query($db, "SELECT * FROM tbl_ukuran");
?>

<!-- Menambahkan Data Produk -->
<?php
if (isset($_POST['tambah'])) {
    $kategori = $_POST['id_kategori'];
    $nmProduk = $_POST['nama'];
    $berat = $_POST['berat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $nmGambar = $_FILES['img']['name'];
    $lokasi = $_FILES['img']['tmp_name'];

    // Ambil array warna & ukuran dari form
    $warnaArr = isset($_POST['warna']) ? $_POST['warna'] : [];
    $ukuranArr = isset($_POST['ukuran']) ? $_POST['ukuran'] : [];
    $stok_variasi = isset($_POST['stok_variasi']) ? intval($_POST['stok_variasi']) : 0;

    if (!empty($lokasi)) {
        move_uploaded_file($lokasi, "assets/images/foto_produk/" . $nmGambar);
        // Insert ke tbl_produk (tanpa kolom stok)
        $query_add = "INSERT INTO tbl_produk
                (id_kategori,nm_produk,berat,harga,gambar,deskripsi)
                VALUES('$kategori', '$nmProduk', '$berat', '$harga', '$nmGambar', '$deskripsi')";
        $exec_add = mysqli_query($db, $query_add);

        if ($exec_add) {
            $id_produk_baru = mysqli_insert_id($db);

            // Simpan kombinasi warna & ukuran ke tbl_produk_variasi
            foreach ($warnaArr as $id_warna) {
                foreach ($ukuranArr as $id_ukuran) {
                    mysqli_query($db, "INSERT INTO tbl_produk_variasi (id_produk, id_warna, id_ukuran, stok)
                        VALUES ('$id_produk_baru', '$id_warna', '$id_ukuran', '$stok_variasi')");
                }
            }

            echo "<p class='alert alert-success' role='alert'>
                Berhasil Menambahkan Data Produk beserta variasi warna & ukuran.<br />
                <a href='index.php?pages=produk'>Lihat Semua Produk</a>
                </p>";
        } else {
            echo "<p class='alert alert-danger' role='alert'>
                [Error] Gagal menambah produk.<br />
                </p>";
        }
    } else {
        echo "<p class='alert alert-danger' role='alert'>
                [Error] Upload Gambar Gagal.<br />
                </p>";
    }
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
                                <input name="nama" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Kategori Produk</label>
                                <select class="form-control select2" name="id_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php mysqli_data_seek($result, 0); while ($pilih = mysqli_fetch_array($result)): ?>
                                        <option value="<?php echo $pilih['id_kategori'] ?>">
                                            <?php echo $pilih['nm_kategori']  ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pilih Warna</label>
                                <select name="warna[]" class="form-control" multiple required>
                                    <?php mysqli_data_seek($warna, 0); while ($w = mysqli_fetch_assoc($warna)): ?>
                                        <option value="<?php echo $w['id_warna']; ?>"><?php echo $w['nm_warna']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <small>Pilih satu atau lebih warna (Ctrl+klik untuk multi)</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pilih Ukuran</label>
                                <select name="ukuran[]" class="form-control" multiple required>
                                    <?php mysqli_data_seek($ukuran, 0); while ($u = mysqli_fetch_assoc($ukuran)): ?>
                                        <option value="<?php echo $u['id_ukuran']; ?>"><?php echo $u['nm_ukuran']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <small>Pilih satu atau lebih ukuran (Ctrl+klik untuk multi)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Stok per Kombinasi Warna & Ukuran</label>
                                <input type="number" name="stok_variasi" class="form-control" value="0" min="0" required>
                                <small>Stok akan sama untuk semua kombinasi warna & ukuran yang dipilih.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Berat Produk (gram)</label>
                                <input name="berat" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Harga Produk</label>
                                <input name="harga" type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Masukkan Gambar Produk</label>
                                <input type="file" class="filestyle" data-buttonname="btn-secondary" name="img" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Kosongkan kolom stok produk, karena stok diatur per variasi -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea id="elm1" name="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success waves-effect waves-light" name="tambah">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>