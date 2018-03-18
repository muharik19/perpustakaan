<?php

include "koneksi/koneksi.php";
include "fungsi/function.php";
include "fungsi/fungsi_indotgl.php";
$page = isset($_GET['page']) ? $_GET['page'] : '';

// Login Administrator //

	// bagian registrasi buku
	if ($page == 'buku') {
		include "page/buku/buku.php";
	}
	//bagian registrasi transaksi
	elseif ($page == 'transaksi') {
		include "page/transaksi/transaksi.php";
	}
	// bagian registrasi user
	elseif ($page == 'user') {
		include "page/user/user.php";
	}
	// bagian registrasi anggota
	elseif ($page == 'anggota') {
		include "page/anggota/anggota.php";
	}
	// bagian report buku
	elseif ($page == 'laporan_buku') {
		include "laporan/laporan_buku.php";
	}
	// bagian report anggota
	elseif ($page == 'laporan_anggota') {
		include "page/laporan/laporan_anggota_excel.php";
		include "page/laporan/laporan_anggota_pdf.php";
	}
	// bagian report anggota
	elseif ($page == 'laporan_buku') {
		include "page/laporan/laporan_buku_excel.php";
		include "page/laporan/laporan_buku_pdf.php";
	}
	// bagian report transaksi
	elseif ($page == 'laporan_transaksi') {
		include "page/laporan/laporan_transaksi_excel.php";
		include "page/laporan/laporan_transaksi_pdf.php";
	}
	else {
		include "page/home/home.php";
	}

?>