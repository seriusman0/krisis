<?php if (!isset($_GET['act'])) { ?>
    <section class="space--sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Semua Produk</h2>
                    <div class="masonry">
                        <div class="masonry-filter-container row justify-content-center align-items-center">
                            <span>Category:</span>
                            <div class="masonry-filter-holder">
                                <div class="masonry__filters" data-filter-all-text="All Categories"></div>
                            </div>
                        </div>

                        <div class="masonry__container row">
                            <div class="masonry__item col-md-6 col-lg-3"></div>
                            <?php
                            $getProduk = mysqli_query($conn, "SELECT * FROM product ORDER BY update_at DESC");
                            while ($r = mysqli_fetch_array($getProduk)) {
                            ?>
                                <div class="masonry__item col-md-6 col-lg-3" data-masonry-filter="<?= productCategory($r['product_category']) ?>">
                                    <div class="product">
                                        <a href="index.php?page=product&act=detail&id=<?= $r['product_id'] ?>">
                                            <img alt="Image" src="../admin/img/product/<?= $r['product_img'] ?>" />
                                        </a>
                                        <a class="block" href="index.php?page=product&act=detail&id=<?= $r['product_id'] ?>">
                                            <div>
                                                <h5 style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                                    <?= $r['product_name'] ?></h5>
                                                <p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                                    <?= $r['product_desc'] ?>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!--end item-->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Produk Terpopuler</h2>
                    <div class="slider" data-arrows="false" data-paging="true">
                        <ul class="slides">
                            <?php
                            $getPopProd = mysqli_query($conn, "SELECT * FROM product ORDER BY product_seen DESC LIMIT 6");
                            while ($row = mysqli_fetch_array($getPopProd)) {
                            ?>

                                <li class="col-md-4 col-12">
                                    <div class="feature feature-3 boxed boxed--lg boxed--border text-center">
                                        <a href="index.php?page=product&act=detail&id=<?= $row['product_id'] ?>">
                                            <img alt="Image" src="../admin/img/product/<?= $row['product_img'] ?>" />
                                        </a>
                                        <h4><?= $row['product_name'] ?></h4>
                                        <p>
                                            <?= $row['product_desc'] ?>
                                        </p>

                                    </div>
                                    <!--end feature-->
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--end of row-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Baru Ditambahkan</h2>
                    <div class="slider" data-arrows="false" data-paging="true">
                        <ul class="slides">
                            <?php
                            $getNewProd = mysqli_query($conn, "SELECT * FROM product ORDER BY update_at DESC LIMIT 6");
                            while ($row = mysqli_fetch_array($getNewProd)) {
                            ?>

                                <li class="col-md-4 col-12">
                                    <div class="feature feature-3 boxed boxed--lg boxed--border text-center">
                                        <a href="index.php?page=product&act=detail&id=<?= $row['product_id'] ?>">
                                            <img alt="Image" src="../admin/img/product/<?= $row['product_img'] ?>" />
                                        </a>
                                        <h4><?= $row['product_name'] ?></h4>
                                        <p>
                                            <?= $row['product_desc'] ?>
                                        </p>

                                    </div>
                                    <!--end feature-->
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--end of row-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
<?php
} elseif ($_GET['act'] == 'detail') {
    mysqli_query($conn, "UPDATE product SET product_seen = (product_seen+1) WHERE product_id = '$_GET[id]'");
    $getProduk = mysqli_query($conn, "SELECT * FROM product where product_id = '$_GET[id]'");
    $r = mysqli_fetch_array($getProduk);
    $pesan = "Hai seller, saya ingin memesan produk *" . $r['product_name'] . "*, Mohon info lebih lanjut . . .";
    $link = urlencode($pesan);
?>

    <div class="main-container">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?= $r['product_name'] ?></h1>
                        <ol class="breadcrumbs">
                            <li>
                                <a href="index.php?page=home">Home</a>
                            </li>
                            <li>
                                <a href="index.php?page=product">Product</a>
                            </li>
                            <li><?= $r['product_name'] ?></li>
                        </ol>
                        <hr>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
        <section class="space--lg">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-md-7 col-lg-6">
                        <div class="slider border--round boxed--border" data-paging="true" data-arrows="true">
                            <ul class="slides">
                                <li>
                                    <img alt="Image" src="../admin/img/product/<?= $r['product_img'] ?>" />
                                </li>
                            </ul>
                        </div>
                        <!--end slider-->
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <h2><?= $r['product_name'] ?></h2>
                        <div class="text-block">
                            <span class="h4 inline-block">Rp <?= rupiah($r['product_price']) ?></span>
                        </div>
                        <p>
                            <?= $r['product_desc'] ?>
                        </p>
                        <ul class="accordion accordion-2 accordion--oneopen">

                            <li class="active">
                                <div class="accordion__title">
                                    <span class="h5">Info Pemesanan</span>
                                </div>
                                <div class="accordion__content">
                                    <p>
                                        Produk bisa anda dapatkan melalui klik tombol di bawah </br>

                                    </p>
                                </div>
                            </li>

                        </ul>
                        <ul>
                            <div class="col-md-6 col-lg-8">
                                <a class="btn bg--twitter" href="http://wa.me/6281335181956?text=<?= $pesan ?>">
                                    <span class="btn__text"><i class="icon-class"></i>Pesan Sekarang</span>
                                </a>
                            </div>
                        </ul>
                        <!--end accordion-->
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Produk Lainnya</h2>
                        <div class="slider" data-arrows="false" data-paging="true">
                            <ul class="slides">
                                <?php
                                $getPopProd = mysqli_query($conn, "SELECT * FROM product ORDER BY product_seen DESC LIMIT 6");
                                while ($row = mysqli_fetch_array($getPopProd)) {
                                ?>

                                    <li class="col-md-4 col-12">
                                        <div class="feature feature-3 boxed boxed--lg boxed--border text-center">
                                            <a href="index.php?page=product&act=detail&id=<?= $row['product_id'] ?>">
                                                <img alt="Image" src="../admin/img/product/<?= $row['product_img'] ?>" />
                                            </a>
                                            <h4><?= $row['product_name'] ?></h4>
                                            <p>
                                                <?= $row['product_desc'] ?>
                                            </p>

                                        </div>
                                        <!--end feature-->
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!--end of row-->
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>

    </div>

<?php
} ?>