<?php
set_time_limit(1800);
$namaFile = "buku_excel(".date('d-m-Y').").xls";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$namaFile");
header("Content-Transfer-Encoding: binary ");

?>

<h2>Laporan Buku</h2>

<table border="1">
	<tr>
		<th>No</th>
		<th>Judul</th>
		<th>Pengarang</th>
		<th>Penerbit</th>
		<th>ISBN</th>
		<th>Jumlah Buku</th>
    </tr>

    <?php

    $mysqli = mysqli_connect("127.0.0.1", "root", "", "dbperpus");

    // $hostName = "localhost";
    // $userName = "root";
    // $passWord = "";
    // $dataBase = "dbperpus";

    // mysql_connect($hostName,$userName,$passWord) or die('Koneksi Gagal');
    // mysql_select_db($dataBase) or die('Database tidak ditemukan');

    $no = 1;

    $query = "SELECT * FROM tbuku";
    $result = $mysqli->query($query);

    // $sql = mysql_query("SELECT * FROM tbuku");
    while ($data = $result->fetch_array()) {

    ?>

    <tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $data['Judul']; ?></td>
		<td><?php echo $data['Pengarang']; ?></td>
		<td><?php echo $data['Penerbit']; ?></td>
		<td><?php echo $data['Isbn']; ?></td>
		<td><?php echo $data['JumlahBuku']; ?></td>
    </tr>

    <?php

        }

    ?>

</table>