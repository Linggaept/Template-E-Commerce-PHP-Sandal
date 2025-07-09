<?php require "header.php"; ?>

<style>
    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .row>[class^="col-"] {
        padding-left: 0;
        padding-right: 0;
    }

    /* 
        .row>[class^="col-sm-8"] {
            padding-right: 100px;
        } */

    /* .col-sm-8,
        .col-sm4 {
            padding: 0px;
        } */
    #containt {
        margin-top: 80px;
    }

    .itemBig,
    .item1,
    .item2,
    .item3 {
        border: none;
        background-color: silver;
    }

    .itemBig:hover,
    .item1:hover,
    .item2:hover,
    .item3:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
        border: none;
    }

    .star-rating li {
        padding: 0;
        margin: 0;
    }

    .star-rating i {
        font-size: 17px;
        color: #ffc000;
    }

    #btnDesc1 {
        padding: 12px 10px;
        width: 100%;
        border-radius: 0;
        color: white;
        background-color: #3498db;
        border-top: px solid #3498db;


    }

    #btnDesc1:hover,
    #btnDesc2:hover {
        background-color: rgb(83, 83, 83);
    }

    #btnDesc2 {
        padding: 10px 10px;
        width: 100%;
        border-radius: 0;
        color: white;
        background-color: silver;
        margin-top: 4px;
    }

    .dec {
        width: 100%;
        height: auto;
        border: 2px solid #3498db;
    }
</style>
<?php
$id = $_GET['id'];
$query = "SELECT * FROM tbl_produk WHERE id_produk='$id'";
$result = mysqli_query($db, $query);
$produk = mysqli_fetch_assoc($result);

$qvar = mysqli_query($db, "SELECT v.*, w.nm_warna, u.nm_ukuran 
    FROM tbl_produk_variasi v
    LEFT JOIN tbl_warna w ON v.id_warna=w.id_warna
    LEFT JOIN tbl_ukuran u ON v.id_ukuran=u.id_ukuran
    WHERE v.id_produk='$id' AND v.stok > 0");

// Buat array untuk select
$warnaArr = [];
$ukuranArr = [];
while ($v = mysqli_fetch_assoc($qvar)) {
    $warnaArr[$v['id_warna']] = $v['nm_warna'];
    $ukuranArr[$v['id_ukuran']] = $v['nm_ukuran'];
    $variasiList[$v['id_warna'] . '_' . $v['id_ukuran']] = [
        'id_variasi' => $v['id_variasi'],
        'stok' => $v['stok']
    ];
}

// Ambil total stok dari tbl_produk_variasi
$qstok = mysqli_query($db, "SELECT SUM(stok) as total_stok FROM tbl_produk_variasi WHERE id_produk='$id'");
$stok = mysqli_fetch_assoc($qstok);
$total_stok = $stok['total_stok'] ?? 0;
?>
<div class="container bg-white rounded pt-4 pb-4" id="containt">
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="itemBig">
                <a href="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>">
                    <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>" height="400px"
                        width="100%">
                </a>
            </div>
        </div>
        <div class="col-md-7 col-sm-12 pt-3 pl-5">
            <h3><?php echo $produk['nm_produk']; ?></h3>
            <div class="star-rating">
                <ul class="list-inline">
                    <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star-o"></i></li>
                </ul>
            </div>
            <hr>
            <h3 class="text-danger"><span class="text-secondary" style="font-size: 15px">Harga :
                </span>Rp. <?php echo number_format($produk['harga']); ?></h3>
            <br>
            <p class="text-secondary font-weight-bold"><i class="fa fa-stop-circle-o text-success"
                    aria-hidden="true"></i>
                Stok Tersedia</p>
            <p class="text-danger stok-info">Silakan pilih warna & ukuran</p>

            <div class="form-group">
                <label>Pilih Warna</label>
                <select class="form-control" id="pilih-warna" name="warna" required>
                    <option value="">-- Pilih Warna --</option>
                    <?php foreach ($warnaArr as $idw => $nmw): ?>
                        <option value="<?php echo $idw; ?>"><?php echo $nmw; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Pilih Ukuran</label>
                <select class="form-control" id="pilih-ukuran" name="ukuran" required>
                    <option value="">-- Pilih Ukuran --</option>
                    <?php foreach ($ukuranArr as $idu => $nmu): ?>
                        <option value="<?php echo $idu; ?>"><?php echo $nmu; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <form method="post">
                <div class="row">
            <input type="hidden" name="id_variasi" id="id_variasi" value="">

                    <div class="col-3">
                        <h3><span class="text-secondary" style="font-size: 15px">Jumlah : </span></h3>
                        <!-- <input id="demo0" type="text" value="1" name="demo0" data-bts-min="1"
                                data-bts-max="<?php echo $produk['stok']; ?>" class="text-center" /> -->
                        <div class="input-group spinner">
                            <button type="button" class="btn btn-primary btn-number pl-2 pr-2"
                                style="border-radius: 5px 0 0 5px;" id="minus-btn">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input type="text" name="stok" id="qty_input" class="form-control input-number text-center"
                                value="1" min="1" max="<?php echo $total_stok; ?>">
                            <button type="button" class="btn btn-primary btn-number pl-2 pr-2"
                                style="border-radius: 0 5px 5px 0;" id="plus-btn"><i class="fa fa-plus"></i>
                            </button>
                            <script>
                                $(function() {
                                    $('.spinner #plus-btn').on('click', function() {
                                        var btn = $(this);
                                        var input = btn.closest('.spinner').find('input');
                                        if (input.attr('max') == undefined || parseInt(input
                                                .val()) <
                                            parseInt(input.attr('max'))) {
                                            input.val(parseInt(input.val(), 10) + 1);
                                        } else {
                                            btn.next("disabled", true);
                                        }
                                    });
                                    $('.spinner #minus-btn').on('click',
                                        function() {
                                            var btn = $(this);
                                            var input = btn.closest('.spinner').find('input');
                                            if (input.attr('min') == undefined || parseInt(input
                                                    .val()) >
                                                parseInt(input.attr('min'))) {
                                                input.val(parseInt(input.val(), 10) - 1);
                                            } else {
                                                btn.prev("disabled", true);
                                            }
                                        });
                                })
                            </script>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <button class="btn btn-primary btn-block" name="beli">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i> Masukkan Keranjang
                        </button>
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-primary btn-block ml-3" name="beli2">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
        </div>
        </form>
        <?php
        if (isset($_POST['beli']) || isset($_POST['beli2'])) {
            $jumlah = intval($_POST['stok']);
            $id_variasi = intval($_POST['id_variasi']);

            if ($id_variasi > 0) {
                if (isset($_SESSION['cart'][$id_variasi])) {
                    $_SESSION['cart'][$id_variasi] += $jumlah;
                } else {
                    $_SESSION['cart'][$id_variasi] = $jumlah;
                }
                if (isset($_POST['beli'])) {
                    echo "<script type='text/javascript'>swal('','Produk Sudah Masuk Ke Keranjang Belanja', 'success');</script>";
                } else {
                    echo "<script>location='cart.php';</script>";
                }
            } else {
                echo "<script>alert('Pilih warna dan ukuran terlebih dahulu!');</script>";
            }
        }
        ?>
    </div>
    <br>
    <hr>
    <div class="ProdukDesc">
        <div class="row">
            <div class="col-md-2">
                <button class="btn" id="btnDesc1">DESCRIPTIONS</button>
            </div>
            <div class="col-md-2">
                <button class="btn text-light" id="btnDesc2">FEEDBACKS</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-light">
                <div class="dec pt-5 pl-5 pr-5 text-justify">
                    <h5>Spesifikasi Dan Deskripsi Produk :</h5>
                    <?php echo $produk['deskripsi']; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data variasi dari PHP ke JS
    var variasiList = <?php echo json_encode($variasiList ?? []); ?>;

    function updateVariasi() {
        var warna = $('#pilih-warna').val();
        var ukuran = $('#pilih-ukuran').val();
        var key = warna + '_' + ukuran;
        if (variasiList[key]) {
            $('#id_variasi').val(variasiList[key]['id_variasi']);
            $('#qty_input').attr('max', variasiList[key]['stok']);
            $('.stok-info').text('Tersisa ' + variasiList[key]['stok'] + ' Unit');
        } else {
            $('#id_variasi').val('');
            $('#qty_input').attr('max', 0);
            $('.stok-info').text('Stok tidak tersedia');
        }
    }

    $('#pilih-warna, #pilih-ukuran').on('change', updateVariasi);
</script>
<?php require "footer.php"; ?>