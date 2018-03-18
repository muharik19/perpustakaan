<?php
require "koneksi/koneksi.php";
function antiinjection($data) {
 $filter_sql = mysqli_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
 return $filter_sql;
}

$userName = $_POST["username"];
$passWord = md5($_POST["password"]);

$sql 	= mysqli_query($link, "SELECT * FROM tuser WHERE Username = '$userName' AND Password ='$passWord'");
$ketemu = mysqli_num_rows($sql);
$data 	= mysqli_fetch_assoc($sql);

if (empty($userName) || empty($passWord)) {
	echo "<script>alert('Anda belum memasukkan username atau password'); window.location = 'index.php'</script>";
}

// Apabila Username dan Password Ditemukan
else {
	if ($ketemu > 0) {
		$date = date('Y-m-d H:i:s');
		mysqli_query($link, "UPDATE tuser SET LastLogin = '$date' WHERE IdUser = '$data[IdUser]'");
		session_start();
		
		$_SESSION['IdUser'] 	= $data['IdUser'];
		$_SESSION['Username'] = $data['Username'];
		$_SESSION['Password'] = $data['Password'];
		$_SESSION['NIP'] 		= $data['NIP'];
		$_SESSION['NamaLengkap'] = $data['NamaLengkap'];

		header('location: master.php');
	}
	else {
		header('location: index.php');
	}
}
mysqli_close($link);
?>