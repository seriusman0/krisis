<?php
session_start();
// error_reporting(0);
include "functions.php";
include "config.php";
if (!isset($_SESSION["loginAdmin"])) {
	include "login.php";
} else {

	include "content.php";
}
