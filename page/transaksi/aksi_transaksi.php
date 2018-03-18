<?php

include "../../koneksi/koneksi.php";

	if (isset($_POST['simpan'])) {
		
		$TanggalPinjam 	= $_POST['TanggalPinjam'];
		$TanggalKembali = $_POST['TanggalKembali'];

		$buku = $_POST['buku'];
		$pecah_buku = explode(".", $buku);
		$Id = $pecah_buku[0];
		$Judul = $pecah_buku[1];

		$Nama = $_POST['Nama'];
		$pecah_nama = explode(".", $Nama);
		$NIM = $pecah_nama[0];
		$Nama = $pecah_nama[1];

		//Cek Stock Buku
		$sql = mysqli_query($link, "SELECT * FROM tbuku WHERE Judul = '$Judul'");
		while ($data = mysqli_fetch_array($sql)) {
		$sisa = $data['JumlahBuku'];
		if ($sisa == 0) {
			echo "<script language='javascript'>alert('Stok Buku Habis, Silahkan Tambah Stok Buku Terlebih Dahulu');
					window.location.href = '../../master.php?page=transaksi&act=tambahtransaksi'</script>";
		}
		
		//Simpan Transaksi
		else {
		$insert_trx = mysqli_query($link, "INSERT INTO ttransaksi (Id, idBuku, NIM, TanggalPinjam, TanggalKembali, Status) VALUES ('', '$Id', '$NIM', '$TanggalPinjam', '$TanggalKembali', 'Pinjam')");

		// Ngurangin Stock Buku
		mysqli_query($link, "UPDATE tbuku SET JumlahBuku = (JumlahBuku-1) WHERE Id='$Id'");
		if($insert_trx) {
			echo "<script language='javascript'>alert('Berhasil menyimpan transaksi');
					window.location.href = '../../master.php?page=transaksi'</script>";
		} else {
			echo "<script language='javascript'>alert('Gagal menyimpan transaksi');
					window.location.href = '../../master.php?page=transaksi&act=tambahtransaksi'</script>";
			}
		}
	}
}

if($_GET['act'] == 'kembali'){
	// Proses aksi kembali buku
	$Id 	= $_GET['Id'];
	$Judul 	= $_GET['Judul'];

	$sql = mysqli_query($link, "UPDATE ttransaksi SET Status='Kembali' WHERE Id ='$Id'");

	$sql = mysqli_query($link, "UPDATE tbuku SET JumlahBuku = (JumlahBuku+1) WHERE Judul='$Judul'");

		echo "<script language='javascript'>alert('Proses kembalikan Buku Berhasil');
				window.location.href = '../../master.php?page=transaksi&act=kembalitransaksi'</script>";	 	
} else {
	// Proses aksi perpanjang buku
	$Id 			= $_GET['Id'];
	$Judul 			= $_GET['Judul'];
	$TanggalKembali = $_GET['TanggalKembali'];
	$lambat 		= $_GET['lambat'];

	if ($lambat > 7) {
		echo "<script language='javascript'>alert('Pinjam Buku Tidak Dapat Di Perpanjang, karena lebih dari 7 hari.. Kembalikan dahulu kemudian pinjam kembali');
				window.location.href = '../../master.php?page=transaksi&act=perpanjangtransaksi'</script>";
	}
	else {
		$pecah_TanggalKembali = explode("-", $TanggalKembali);
		$next_7_hari = mktime(0,0,0, $pecah_TanggalKembali[1], $pecah_TanggalKembali[0]+7, $pecah_TanggalKembali[2]);
		$hari_next = date("d-m-Y", $next_7_hari);

		$sql = mysqli_query($link, "UPDATE ttransaksi SET TanggalKembali = '$hari_next' WHERE Id = '$Id'");

		if ($sql) {
			echo "<script language='javascript'>alert('Proses Perpanjang Buku Berhasil');
					window.location.href = '../../master.php?page=transaksi&act=perpanjangtransaksi'</script>";
		}
		else {
			echo "<script language='javascript'>alert('Proses Perpanjang Buku Gagal');
					window.location.href = '../../master.php?page=transaksi&act=perpanjangtransaksi'</script>";
		}
	}
}

?>