<?php include "header.php"; ?>

<body class=" ">
    <a id="start"></a>

    <?php include "navbar.php";

    $page = '';
    if (!isset($_GET['page'])) {
        require_once "home.php";
    } elseif ($_GET['page'] == 'home') {
        require_once 'home.php';
    } elseif ($_GET['page'] == 'product') {
        require_once 'product.php';
    } elseif ($_GET['page'] == 'about') {
        require_once 'about.php';
    } else require_once "home.php";
    ?>


    <!--<div class="loader"></div>-->
    <a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
        <i class="stack-interface stack-up-open-big"></i>
    </a>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/flickity.min.js"></script>
    <script src="js/easypiechart.min.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/typed.min.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/ytplayer.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/granim.min.js"></script>
    <script src="js/jquery.steps.min.js"></script>
    <script src="js/countdown.min.js"></script>
    <script src="js/twitterfetcher.min.js"></script>
    <script src="js/spectragram.min.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
<?php include "footer.php" ?>

</html>