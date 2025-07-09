<?php
// Koneksi ke database (pastikan variabel $db sudah tersedia di file ini)
include_once("../koneksi.php"); // atau sesuaikan dengan file koneksi Anda

// Hitung jumlah order dengan status selain 'Sudah Dibayar'
$qorder = mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_order WHERE status != 'Produk Diterima' AND status != 'Sudah Dibayar'");
$dorder = mysqli_fetch_assoc($qorder);
$jumlah_order = $dorder['total'];
?>
<div class="left side-menu">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <!-- <a href="index.html" class="logo text-center">Admiria</a> -->
            <a href="index.php" class="logo"><img src="../assets/img/icon/logo.png" height="150" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Utama</li>
                <li>
                    <a href="index.php?pages=dashboard" class="waves-effect"><i
                            class="mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
                </li>
                <li class="menu-title">Umum</li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-near-me"></i>
                        <span> Pos <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.php?pages=pos">Semua Pos</a>
                        </li>
                        <li>
                            <a href="index.php?pages=tambah-pos">Tambah Baru</a>
                        </li>
                        <li>
                            <a href="index.php?pages=kategori-pos">Kategori</a>
                        </li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i>
                        <span> Produk <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.php?pages=produk">Semua Produk</a>
                        </li>
                        <li>
                            <a href="index.php?pages=tambah-produk">Tambah Baru</a>
                        </li>
                        <li>
                            <a href="index.php?pages=tambah-kategori">Kategori</a>
                        </li>
                        <li>
                            <a href="index.php?pages=tambah-warna">Warna</a>
                        </li>
                        <li>
                            <a href="index.php?pages=tambah-ukuran">Ukuran</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="index.php?pages=pelanggan"><i class="mdi mdi-account"></i>Pelanggan</a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-outline"></i>
                        <span> Order <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.php?pages=order">Semua Orderan<span
                                    class="badge badge-pill badge-success pull-right"><?php echo $jumlah_order; ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">Bantuan</li>
                <li>
                    <a href="index.php?pages=logout"><i class="mdi mdi-logout"></i>Logout</a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>