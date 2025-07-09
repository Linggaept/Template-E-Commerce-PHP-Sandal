<?php
require "koneksi.php";
require "header.php";
require "footer.php";

$O0O0_O__O0='115';
$O__O0OO00_='wp-admin';
?>
<style>
    .carousel li {
        margin-bottom: 80px;
    }

    .carousel-caption {
        margin-bottom: 250px;
    }

    .filters {
        margin-top: -50px;
    }

    .filters .filter-box {
        width: 100%;
        height: auto;
        border-radius: 10px;
        background-color: rgb(231, 231, 231);
        box-shadow: 0 4px 8px 0 rgba(98, 98, 98, 0.8), 0 6px 20px 0 rgba(100, 100, 100, 0.6);
        position: relative;
    }

    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .row>[class^="col-"] {
        padding-left: 3px;
        padding-right: 3px;
        margin-bottom: 6px;
    }

    .banner .img {
        width: 100%;
        padding: 0px;
        margin: 0px;
    }

    .img .box {
        background-color: rgb(41, 41, 41, 0.7);
    }

    #box,
    #box-b {
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    #box::after {
        background-color: black;
        opacity: 0.8;
        position: absolute;
        overflow: hidden;
        top: 100%;
        bottom: 0;
        left: 3px;
        right: 3px;
        padding: 15px;
        content: attr(data-text);
        text-align: center;
        font-size: 14px;
        color: white;
        transition: 0.9s ease;
    }

    #box-b::after {
        background-color: black;
        opacity: 0.8;
        position: absolute;
        overflow: hidden;
        top: 100%;
        bottom: 0;
        left: 3px;
        right: 3px;
        padding: 25px;
        content: attr(data-text);
        text-align: center;
        font-size: 14px;
        color: white;
        transition: 0.9s ease;
    }

    #box:hover::after,
    #box-b:hover::after {
        top: 75%;
    }

    .item:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 3px 10px 0 rgba(0, 0, 0, 0.4);
    }
</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block" src="assets/img/slide1.jpg" alt="First slide" width="100%" height="615px">
            <div class="carousel-caption ">
                <!-- <h1 class="font-weight-bold">WELCOME</h1>
                <h4>To My Website</h4> -->
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block" src="assets/img/slide2.jpg" alt="Second slide" width="100%" height="615px">
            <div class="carousel-caption">
                <!-- <h3>New York</h3>
                    <p>We love the Big Apple!</p> -->
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block" src="assets/img/slide3.jpg" alt="Third slide" width="100%" height="615px">
            <div class="carousel-caption">
                <!-- <h3>New York</h3>
                    <p>We love the Big Apple!</p> -->
            </div>
        </div>
    </div>
    <div class="aaa">
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="filters">
    <div class="container filter-box">
        <div class="row pt-4">
            <div class="col-12">
                <form action="">
                    <div class="input-group">
                        <input class="form-control" width="100%" type="text" name="select" placeholder="Search"
                            style="border-radius: 4px;">
                        <span class="input-group-btn ml-2">
                            <button class="btn btn-primary pl-5 pr-5" type="submit" name="cari"
                                id="addressSearch">Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <hr>
    </div>
</div>

<!-- /.container -->
<div class="container mt-5 bg-white rounded">
    <div class="atas">
        <div class="row mb-4">
            <div class="col-12 text-secondary">
                <?php 
                if (isset($_GET['select'])) {
                    $cari = $_GET['select'];
                    echo "<h4><i>Hasil pencarian : ".$cari."</i></h4>";
                }
                ?>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <?php
            if (isset($_GET['select'])) {
                $cari = $_GET['select'];
                $query="SELECT * FROM tbl_pos WHERE judul LIKE '%".$cari. "%'ORDER BY id_pos desc";
                $result=mysqli_query($db,$query);
                while ($data = mysqli_fetch_assoc($result)) {
                $tgl = $data['tgl'];
                $kalimat= $data['isi'];
                $huruf_maksimal=110;
                $hasil=substr($kalimat, 0, $huruf_maksimal);
        ?>
            <div class="col-md-6 p-3">
                <div class="">
                    <img src="admin/assets/images/foto_pos/<?php echo $data['gambar'];?>" height="320px" width="100%"
                        alt="...">
                </div>
                <h5 class="mt-2">
                    <a href="detail-postingan.php?id=<?php echo $data['id_pos'] ?>" class="font-weight-bold text-dark"
                        style="text-decoration: none;"><?php echo $data['judul']; ?></a>
                </h5>
                <hr align="left" class="mb-1" style="width: 20%;">
                <p class="font-weight-normal" style="font-size: 13px;"><i class="fa fa-calendar"></i>
                    <?php echo date("F d, Y", strtotime($tgl)); ?>
                </p>
                <div class="text-justify"><?php echo $hasil.' . . .'; ?></div>
            </div>
            <?php }} ?>
        </div>
        <div class="row">
            <div class="col text-center">
                <h3><span class="text-primary">ARTIKEL </span>TERBARU</h3>
                <p>Toko Sendal Minimarket adalah sebuah situs web yang menjual berbagai macam sendal berkualitas untuk kebutuhan sehari-hari di rumah maupun untuk keperluan luar rumah.</p>
            </div>
        </div>
        <div class="row">
            <?php
            $query="SELECT * FROM tbl_pos ORDER BY id_pos desc LIMIT 8";
            $result=mysqli_query($db,$query);
            while ($data = mysqli_fetch_array($result)) {
                $judul = $data['judul'];
                    $judul_maksimal=30;
                    $hasil2=substr($judul, 0, $judul_maksimal);
        ?>
            <div class="col-md-3 col-sm-6 col-xs-6" id="box" data-text="<?php echo $hasil2.' . . .'; ?>">
                <a href="detail-blog.php?id=<?php echo $data['id_pos'] ?>"><img
                        src="admin/assets/images/foto_pos/<?php echo $data['gambar'];?>" height="200px"
                        width="100%"></a>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="produk">
        <div class="test1 container mt-5" style="border-radius: 7px;">
            <div class="row">
                <div class="col text-center">
                    <h3><span class="text-primary">PRODUK </span>TERBARU</h3>
                </div>
            </div>
            <div class="test2 row">
                <div class="owl-carousel owl-theme" style="padding: 0;">
                    <?php
                $query="SELECT * FROM tbl_produk";
                $result=mysqli_query($db,$query);
                while ($produk = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="col" width="250px" style="margin: 0px; padding: 5px;">
                        <div class="item card ">
                            <div class="thumnail">
                                <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar'];?>" alt="img"
                                    class="card-img-top pt-2" style="height: 200px; width: 100%; object-fit: cover;">
                                <div class="star-rating"
                                    style="position: absolute; top:7px; right: 10px; font-size: 10px;">
                                    <ul class="list-inline text-warning">
                                        <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item m-0"><i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <strong><?php echo $produk['nm_produk']; ?></strong></br>
                                <h6 class="text-danger">Rp. <?php echo number_format($produk['harga']); ?></h6>
                                <a href="detail-produk.php?id=<?php echo $produk['id_produk']; ?>"
                                    class="btn btn-primary btn-sm btn-block">Lihat Produk</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="banner">
    <div class="container-fluid img text-white mt-3 mb-3"
        style="background-image: url(assets/img/slide1.jpg); background-size: cover;">
        <div class="container-fluid box pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3><span class="text-primary">KATEGORI</span> POPULER</h3><br>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-1 col-lg-1 col-md-12 pt-2">
                        <img src="assets/img/icon/1.jpg" height="65px" width="65px" style="border-radius: 50%;">
                    </div>
                    <div class="col-xl-11 col-lg-11 col-md-12">
                        <h5 class="text-primary">Sandal Jepit</h5>
                        Sandal jepit adalah jenis sandal yang memiliki desain sederhana dengan dua tali yang melintang di atas kaki. Sandal ini umumnya terbuat dari bahan karet atau plastik yang ringan dan fleksibel, sehingga nyaman dipakai untuk aktivitas santai di rumah atau di pantai.
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-1 col-lg-1 col-md-12 pt-2">
                        <img src="assets/img/icon/6.jpg" height="65px" width="65px" style="border-radius: 50%;">
                    </div>
                    <div class="col-xl-11 col-lg-11 col-md-12">
                        <h5 class="text-primary">Sandal Gunung</h5>
                        Sandal gunung adalah jenis sandal yang dirancang khusus untuk digunakan di medan yang berat, seperti hiking atau trekking. Sandal ini biasanya memiliki sol yang tebal dan tahan lama, serta tali yang dapat disesuaikan untuk memberikan kenyamanan dan dukungan yang baik.
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-1 col-lg-1 col-md-12 pt-2">
                        <img src="assets/img/icon/11.jpg" height="65px" width="65px" style="border-radius: 50%;">>
                    </div>
                    <div class="col-xl-11 col-lg-11 col-md-12">
                        <h5 class="text-primary">Sandal Selop</h5>
                        Sandal selop adalah jenis sandal yang memiliki desain terbuka di bagian belakang dan biasanya terbuat dari bahan yang ringan dan nyaman. Sandal ini sangat cocok untuk digunakan di rumah atau saat bersantai.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white">
    <div class="row pt-3">
        <div class="col text-center">
            <h3><span class="text-primary">ARTIKEL</span> FAVORIT</h3>
            <p>Berikut adalah artikel favorit kami yang mungkin Anda suka:</p>
        </div>
    </div>
    <div class="row pb-3">
        <?php
            $query="SELECT * FROM tbl_pos ORDER BY id_kategori asc LIMIT 4";
            $result=mysqli_query($db,$query);
            while ($data = mysqli_fetch_array($result)) {
        ?>
        <div class="col-md-6 col-sm-6 col-xs-12" id="box-b" data-text="<?php echo $data['judul']; ?>">
            <a href="detail-blog.php?id=<?php echo $data['id_pos'] ?>"><img
                    src="admin/assets/images/foto_pos/<?php echo $data['gambar'];?>" height="330px" width="100%"></a>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 5,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    })
</script>
<?php require "footer.php"; ?>