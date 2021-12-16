<div class="main-container">
    <section class="switchable switchable--switch space--xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="height-50 imagebg border--round" data-overlay="2">
                        <div class="background-image-holder">
                            <img alt="background" src="img/bg/logo.png" />
                        </div>
                        <div class="pos-vertical-center col-md-6 col-lg-5 pl-5">
                            <div class="typed-headline">
                                <span class="h1 inline-block">Selamat datang di </span>
                                <span class="h1 inline-block typed-text typed-text--cursor color--primary" data-typed-strings="Web Krisis Shop.,">Web Krisis Shop.</span>
                            </div>
                            <p class="lead">
                                </br>
                                <a href="index.php?page=about">Baca Selengkapnya</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="space--sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                            $getProduk = mysqli_query($conn, "SELECT * FROM product ORDER BY product_seen DESC LIMIT 12");
                            while ($r = mysqli_fetch_array($getProduk)) {
                            ?>
                                <div class="masonry__item col-md-6 col-lg-3" data-masonry-filter="<?= productCategory($r['product_category']) ?>">
                                    <div class="product">
                                        <a href="index.php?page=product&act=detail&id=<?= $r['product_id'] ?>">
                                            <img alt="Image" src="../admin/img/product/<?= $r['product_img'] ?>" />
                                        </a>
                                        <a class="block" href="index.php?page=product&act=detail&id=<?= $r['product_id'] ?>">
                                            <div>
                                                <h5 style="overflow: hidden;white-space: normal;text-overflow: clip;">
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
                        <!--end masonry container-->
                    </div>
                    <!--end masonry-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->



    </section>

</div>