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
    <h2>Laporan Data Anggota</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Prodi</th>
        </tr>
        <?php

        $mysqli = mysqli_connect("127.0.0.1", "root", "", "dbperpus");
        // $hostName = "localhost";
        // $userName = "root";
        // $passWord = "";
        // $dataBase = "dbperpus";

        // mysqli_connect($hostName,$userName,$passWord) or die('Koneksi Gagal');
        // mysqli_select_db($dataBase) or die('Database tidak ditemukan');

        $no = 1;

        $query = "SELECT * FROM tanggota";
        $result = $mysqli->query($query);

        // $sql = mysqli_query($mysqli, "SELECT * FROM tanggota");
        while ($data = $result->fetch_array()) {

        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['NIM']; ?></td>
            <td><?php echo $data['Nama']; ?></td>
            <td><?php echo $data['TempatLahir']; ?></td>
            <td><?php echo $data['TanggalLahir']; ?></td>
            <td><?php echo $data['JK']; ?></td>
            <td><?php echo $data['Prodi']; ?></td>
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
    $html2pdf->Output('laporan_anggota.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>