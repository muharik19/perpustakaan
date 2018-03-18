<?php
session_start();
include "../../koneksi/koneksi.php";
$act 	= $_GET['act'];
$page 	= $_GET['page'];

if ($page == 'user' AND $act == 'input') {
	if (empty($_POST['NIP']) || empty($_POST['NamaLengkap']) || empty($_POST['Username']) || empty($_POST['Password']) || empty($_POST['Email']) || empty($_POST['Aktif'])) {
		echo "<script language='javascript'>alert('Isikan form user secara lengkap');
			  window.location = '../../master.php?page=user&act=tambahuser'</script>";
	}
	elseif ($_POST['PendidikanTerakhir'] == 'PendidikanTerakhir' OR $_POST['Agama'] == 'Agama'){
		echo "<script language='javascript'>alert('Isikan Agama dan Pendidikan Terakhir');
			  window.location = '../../master.php?page=user&act=tambahuser'</script>";
	}
	else{
		$numRowsUsername = mysqli_num_rows(mysqli_query($link, "SELECT Username FROM tuser WHERE Username = '$_POST[Username]'"));
		$numRowsNIP		 = mysqli_num_rows(mysqli_query($link, "SELECT NIP FROM tuser WHERE NIP = '$_POST[NIP]'"));
		if ($numRowsUsername > 0){
			echo "<script language='javascript'>alert('Username sudah digunakan, gunakan username lain.');
					window.location = '../../master.php?page=user&act=tambahuser'</script>";
		}
		elseif ($numRowsNIP > 0){
			echo "<script language='javascript'>alert('NIP sudah digunakan, gunakan nip lain.');
					window.location = '../../master.php?page=user&act=tambahuser'</script>";
		}
		else{
			$createdDate = date('Y-m-d H:i:s');
			$passwordEnkrip = md5($_POST['Password']);
			mysqli_query($link, "INSERT INTO tuser( NIP,
											NamaLengkap,
											Alamat,
											Telepon,
											CellPhone,
											Agama,
											Email,
											Aktif,
											Username,
											Password,
											IdPendidikanTerakhir,
											CreatedDate,
											CreatedUser)
									VALUES ('$_POST[NIP]',
											'$_POST[NamaLengkap]',
											'$_POST[Alamat]',
											'$_POST[Telepon]',
											'$_POST[CellPhone]',
											'$_POST[Agama]',
											'$_POST[Email]',
											'$_POST[Aktif]',
											'$_POST[Username]',
											'$passwordEnkrip',
											'$_POST[PendidikanTerakhir]',
											'$createdDate',
											'$_SESSION[IdUser]')");
			
			echo "<script language='javascript'>alert('User $_POST[NamaLengkap] dengan NIP = $_POST[NIP] berhasil ditambahkan / disimpan');
				window.location = '../../master.php?page=user'</script>";
		}
	}
}

elseif ($page == 'user' AND $act == 'update') {
	if (empty($_POST['NamaLengkap']) || empty($_POST['Email']) || empty($_POST['Aktif'])) {
		echo "<script language='javascript'>alert('Isikan form user secara lengkap');
			  window.location = '../../master.php?page=user&act=updateuser'</script>";
	}
	elseif ($_POST['PendidikanTerakhir'] == 'PendidikanTerakhir' OR $_POST['Agama'] == 'Agama') {
		echo "<script language='javascript'>alert('Isikan Agama dan Pendidikan Terakhir');
			  window.location = '../../master.php?page=user&act=updateuser'</script>";
	}
	else {
		$lastUpdateDate = date('Y-m-d H:i:s');
		mysqli_query($link, "UPDATE tuser SET 	NamaLengkap 		 = '$_POST[NamaLengkap]',
										Alamat				 = '$_POST[Alamat]',
										Telepon				 = '$_POST[Telepon]',
										CellPhone			 = '$_POST[CellPhone]',
										Agama				 = '$_POST[Agama]',
										Email				 = '$_POST[Email]',
										Aktif				 = '$_POST[Aktif]',
										IdPendidikanTerakhir = '$_POST[PendidikanTerakhir]',
										LastUpdateDate 		 = '$lastUpdateDate',
										LastUpdateUser 		 = '$_SESSION[IdUser]'
									WHERE IdUser 			 = '$_GET[IdUser]'");
			
		echo "<script language='javascript'>alert('User $_POST[NamaLengkap] berhasil diupdate');
				window.location = '../../master.php?page=user'</script>";
	}
}

elseif ($page == 'user' AND $act == 'hapus_user') {
	mysqli_query($link, "DELETE FROM tuser WHERE IdUser = '$_GET[id]'");
	header('location: ../../master.php?page=user');
}
?>