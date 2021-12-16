<!DOCTYPE html>
<html>

<head>
    <title>Admin Krisis</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- theme -->
    <link rel="stylesheet" type="text/css" href="css/theme/default.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/elements/signin.css" />


    <!-- open sans font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400italic,700italic,400,700" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
    <![endif]-->

</head>

<body class="onepage">
    <?php
    if (isset($_POST['login'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $r = mysqli_query($conn, "SELECT * FROM users WHERE users_email = '$user'");

        // echo $pass;
        //cek username
        if (mysqli_num_rows($r) === 1) {
            //cek password
            $row = mysqli_fetch_assoc($r);
            if ($pass == $row["users_password"]) {
                $_SESSION["loginAdmin"] = true;
                $_SESSION["users_name"] = $row["users_name"];
                $_SESSION["users_id"] = $row["users_id"];
            }
            message("Berhasil masukk di pencocockan username");
            header('location:index.php');
        } else {
            echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses ');
                        window.location('index.php');
                    </script>";
        }
    }

    ?>

    <div class="col-md-4 col-md-offset-4 text-center">
        <h2 class='logo'>FORM LOGIN</h2>

        <div>
            <p>Selamat Datang di Web Admin Krisis </p>

            <p>Silahkan Login Melalui Form Dibawah ini.</p>

            <form class="m-t" role="form" action="" method='POST'>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="" name='user' autofocus>
                    <input type="password" class="form-control" placeholder="Password" required="" name='pass'>
                </div>

                <button name='login' type="submit" class="btn btn-primary block full-width signin-btn">Masuk</button>
            </form>
            <p class="m-t"> </p>
        </div>
    </div>


    <!-- scripts -->
    <script src="js/jquery.$conn, min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/theme.js"></script>


</body>

<!-- Mirrored from istran.net/myxdashboard/signin.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 03 Jun 2015 04:33:17 GMT -->

</html>