<?php
session_start();
include "../../koneksi/koneksi.php";
$act 	= $_GET['act'];
$page 	= $_GET['page'];

if ($page == 'buku' AND $act == 'input') {
	if (empty($_POST['Judul']) || empty($_POST['Pengarang']) || empty($_POST['Penerbit']) || empty($_POST['TahunTerbit']) || empty($_POST['Isbn'])) {
		echo "<script language='javascript'>alert('Isikan form buku secara lengkap');
				window.location = '../../master.php?page=buku&act=tambahbuku'</script>";
	}
	elseif ($_POST['Lokasi'] == 'Lokasi' OR $_POST['TanggalInput'] == 'TanggalInput') {
		echo "<script language='javascript'>alert('Isikan Lokasi dan Tanggal Input'); 
				window.location = '../../master.php?page=buku&act=tambahbuku'</script>";
	}
	else {
		$numRowsJudul 	= mysqli_num_rows(mysqli_query($link, "SELECT Judul FROM tbuku WHERE Judul = '$_POST[Judul]'"));
		$numRowsIsbn 	= mysqli_num_rows(mysqli_query($link, "SELECT Isbn FROM tbuku WHERE Isbn = '$_POST[Isbn]'"));
		if ($numRowsJudul > 0) {
			echo "<script language='javascript'>alert('Judul sudah digunakan, gunakan judul lain.');
					window.location = '../../master.php?page=buku&act=tambahbuku'</script>";
		}
		elseif ($numRowsIsbn > 0) {
			echo "<script language='javascript'>alert('ISBN sudah digunakan, gunakan ISBN lain.');
					window.location = '../../master.php?page=buku&act=tambahbuku'</script>";
		}
		else {
			$createdDate = date('Y-m-d H:i:s');
			mysqli_query($link, "INSERT INTO tbuku ( Judul,
										     Pengarang,
										     Penerbit,
										     TahunTerbit,
										     Isbn,
										     JumlahBuku,
										     Lokasi,
										     TanggalInput,
										     CreatedDate,
										     CreatedUser)
									VALUES(  '$_POST[Judul]',
											 '$_POST[Pengarang]',
											 '$_POST[Penerbit]',
											 '$_POST[TahunTerbit]',
											 '$_POST[Isbn]',
											 '$_POST[JumlahBuku]',
											 '$_POST[Lokasi]',
											 '$_POST[TanggalInput]',
											 '$createdDate',
											 '$_SESSION[IdUser]')");

			echo "<script language='javascript'>alert('Judul $_POST[Judul] dengan Pengarang = $_POST[Pengarang] berhasil ditambahkan / disimpan'); 
					window.location = '../../master.php?page=buku'</script>";
		}
	}
}

elseif ($page == 'buku' AND $act == 'update') {
	if (empty($_POST['Judul']) || empty($_POST['Pengarang']) || empty($_POST['Penerbit']) || empty($_POST['TahunTerbit']) || empty($_POST['Isbn'])) {
		echo "<script language='javascript'>alert('Isikan form buku secara lengkap');
				window.location = '../../master.php?page=buku&act=updatebuku'</script>";
	}
	elseif ($_POST['Lokasi'] == 'Lokasi' OR $_POST['TanggalInput'] == 'TanggalInput') {
		echo "<script language='javascript'>alert('Isikan Lokasi dan Tanggal Input'); 
				window.location = '../../master.php?page=buku&act=updatebuku'</script>";
	}
	else {
		$lastUpdateDate = date('Y-m-d H:i:s');
		mysqli_query($link, "UPDATE tbuku SET Judul 		= '$_POST[Judul]',
									  Pengarang 	= '$_POST[Pengarang]',
									  Penerbit 		= '$_POST[Penerbit]',
									  TahunTerbit 	= '$_POST[TahunTerbit]',
									  Isbn 			= '$_POST[Isbn]',
									  JumlahBuku 	= '$_POST[JumlahBuku]',
									  Lokasi 		= '$_POST[Lokasi]',
									  TanggalInput 	= '$_POST[TanggalInput]',
									  LastUpdateDate = '$lastUpdateDate',
		                              LastUpdateUser = '$_SESSION[IdUser]'
		                          WHERE Id = '$_GET[id]'");

		echo "<script language='javascript'>alert('Judul $_POST[Judul] dengan Pengarang = $_POST[Pengarang] berhasil berhasil diupdate');
				window.location = '../../master.php?page=buku'</script>";
	}
}

elseif ($page == 'buku' AND $act == 'hapus_buku') {
	mysqli_query($link, "DELETE FROM tbuku WHERE Id = '$_GET[id]'");
	header('location: ../../master.php?page=buku');
}
?>