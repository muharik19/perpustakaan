<style type="text/css">
    table{
        border: 1px solid black;
        border-collapse: collapse;
    }
    th{
        background-color:#cccccc;
    }
    th, td {
        padding: 15px 15px 15px 15px;
    }
    th, td {
        text-align: center;
    }
    table {
        border-spacing: 5px;
    }
</style>

<page>
    <h2>Laporan Data Transaksi</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Terlambat</th>
            <th>Status</th>
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

        $query = "SELECT tbuku.Judul as Judul, tanggota.NIM as NIM, tanggota.Nama as Nama, ttransaksi.TanggalPinjam as TanggalPinjam, ttransaksi.TanggalKembali as TanggalKembali, ttransaksi.Status as Status, ttransaksi.Id as Id  FROM ttransaksi,tbuku,tanggota WHERE ttransaksi.idBuku=tbuku.Id and ttransaksi.NIM=tanggota.NIM";
        $result = $mysqli->query($query);

        // $sql = mysql_query("SELECT tbuku.Judul as Judul, tanggota.NIM as NIM, tanggota.Nama as Nama, ttransaksi.TanggalPinjam as TanggalPinjam, ttransaksi.TanggalKembali as TanggalKembali, ttransaksi.Status as Status, ttransaksi.Id as Id  FROM ttransaksi,tbuku,tanggota WHERE ttransaksi.idBuku=tbuku.Id and ttransaksi.NIM=tanggota.NIM");
        while ($data = $result->fetch_array()) {

        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['Judul']; ?></td>
            <td><?php echo $data['NIM']; ?></td>
            <td><?php echo $data['Nama']; ?></td>
            <td><?php echo $data['TanggalPinjam']; ?></td>
            <td><?php echo $data['TanggalKembali']; ?></td>
            <td>
                <?php

                    include "../../fungsi/function.php";

                    $denda = 1000;
                    $tgl_dateline = $data['TanggalKembali'];
                    $tgl_kembali  = date('Y-m-d');

                    $lambat = terlambat($tgl_dateline, $tgl_kembali);
                    $denda1 = $lambat*$denda;

                    if ($lambat>0) {
                        echo "<font color='red'>$lambat hari<br>(Rp $denda1)</font> ";
                    }
                    else {
                        echo $lambat." "."Hari";
                    }

                ?>
            </td>
            <td><?php echo $data['Status']; ?></td>
        </tr>

        <?php

            }

        ?>
    </table>
</page>
<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
 include '../../vendor/html2pdf/html2pdf.class.php';
 try
{
    $html2pdf = new HTML2PDF('L', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_transaksi.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>