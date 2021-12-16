<?php
include "../../config.php";

mysqli_query($conn, "UPDATE mahasiswa SET `status` = 11 WHERE `status` > 9");

header("Location:../index.php?page=mahasiswa");
