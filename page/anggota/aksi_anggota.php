<?php
session_start();
include "../../koneksi/koneksi.php";
$act 	= $_GET['act'];
$page 	= $_GET['page'];

if ($page == 'anggota' AND $act == 'input') {
	if (empty($_POST['NIM']) || empty($_POST['Nama']) || empty($_POST['TempatLahir']) || empty($_POST['TanggalLahir'])) {
		echo "<script language='javascript'>alert('Isikan form anggota secara lengkap');
				window.location = '../../master.php?page=anggota&act=tambahanggota'</script>";
	}
	elseif ($_POST['JK'] == 'JK' OR $_POST['Prodi'] == 'Prodi') {
		echo "<script language='javascript'>alert('Isikan Jenis Kelamin dan Prodi'); 
				window.location = '../../master.php?page=anggota&act=tambahanggota'</script>";
	}
	else {
		$numRowsNIM 	= mysqli_num_rows(mysqli_query($link, "SELECT NIM FROM tanggota WHERE NIM = '$_POST[NIM]'"));
		$numRowsNama 	= mysqli_num_rows(mysqli_query($link, "SELECT Nama FROM tanggota WHERE Nama = '$_POST[Nama]'"));
		if ($numRowsNIM > 0) {
			echo "<script language='javascript'>alert('NIM sudah digunakan, gunakan NIM lain.');
					window.location = '../../master.php?page=anggota&act=tambahanggota'</script>";
		}
		elseif ($numRowsNama > 0) {
			echo "<script language='javascript'>alert('Nama sudah digunakan, gunakan Nama lain.');
					window.location = '../../master.php?page=anggota&act=tambahanggota'</script>";
		}
		else {
			$createdDate = date('Y-m-d H:i:s');
			mysqli_query($link, "INSERT INTO tanggota ( NIM,
										     	Nama,
										     	TempatLahir,
										     	TanggalLahir,
										     	JK,
										     	Prodi,
										     	CreatedDate,
										     	CreatedUser)
										VALUES( '$_POST[NIM]',
											 	'$_POST[Nama]',
											 	'$_POST[TempatLahir]',
											 	'$_POST[TanggalLahir]',
											 	'$_POST[JK]',
											 	'$_POST[Prodi]',
											 	'$createdDate',
											 	'$_SESSION[IdUser]')");

			echo "<script language='javascript'>alert('NIM $_POST[NIM] dengan Nama $_POST[Nama] berhasil ditambahkan / disimpan'); 
					window.location = '../../master.php?page=anggota'</script>";
		}
	}
}

elseif ($page == 'anggota' AND $act == 'update') {
	if (empty($_POST['Nama']) || empty($_POST['TempatLahir']) || empty($_POST['TanggalLahir'])) {
		echo "<script language='javascript'>alert('Isikan form anggota secara lengkap');
				window.location = '../../master.php?page=anggota&act=updateanggota'</script>";
	}
	elseif ($_POST['JK'] == 'JK' OR $_POST['Prodi'] == 'Prodi') {
		echo "<script language='javascript'>alert('Isikan Jenis Kelamin dan Prodi'); 
				window.location = '../../master.php?page=anggota&act=updateanggota'</script>";
	}
	else {
		$lastUpdateDate = date('Y-m-d H:i:s');
		mysqli_query($link, "UPDATE tanggota SET Nama 				= '$_POST[Nama]',
									  	 TempatLahir 		= '$_POST[TempatLahir]',
									  	 TanggalLahir 		= '$_POST[TanggalLahir]',
									  	 JK 				= '$_POST[JK]',
									  	 Prodi 				= '$_POST[Prodi]',
									  	 LastUpdateDate 	= '$lastUpdateDate',
		                              	 LastUpdateUser 	= '$_SESSION[IdUser]'
		                          	WHERE NIM 				= '$_GET[NIM]'");

		echo "<script language='javascript'>alert('Nama $_POST[Nama] berhasil berhasil diupdate');
				window.location = '../../master.php?page=anggota'</script>";
	}
}

elseif ($page == 'anggota' AND $act == 'hapus_anggota') {
	mysqli_query($link, "DELETE FROM tanggota WHERE NIM = '$_GET[NIM]'");
	header('location: ../../master.php?page=anggota');
}
?>