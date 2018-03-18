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
    <h2>Laporan Data Buku</h2>
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
    $html2pdf->Output('laporan_buku.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>