<?php
//error_reporting(0);
session_start();
if (empty($_SESSION['Username']) AND empty($_SESSION['Password'])) {
	header('location: index.php');
}
else {
	if (@$_SESSION['admin'] == 'admin') {
	}
	else {
		include "master/master_admin.php";
	}
}
?>