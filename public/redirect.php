<?php

include "../app/config.php";
$link = $_GET['link'];
mysqli_query($conn, "UPDATE media SET media_seen = (media_seen+1) WHERE media_id = '$_GET[id]'");
header('location:' . $_GET['link']);
