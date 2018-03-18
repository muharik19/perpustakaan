<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
<page backtop="14mm" backbottom="14mm" backleft="1mm" backright="10mm">
  <page_header>
    <!-- Setting Header -->
    <table class="page_header">
      <tr>
        <td style="text-align: left;    width: 10%">SICUMIL</td>
        <td style="text-align: center;    width: 80%">LAPORAN PENJUALAN CUCI MOBIL KESELURUHAN</td>
        <td style="text-align: right;    width: 10%"><?php echo date('d/m/Y'); ?></td>
      </tr>
    </table>
  </page_header>
  <!-- Setting Footer -->
  <page_footer>
    <table class="page_footer">
      <tr>
        <td style="width: 33%; text-align: left">
          <?php echo "$base_url"."laporan_penjualan_all.php" ?>
        </td>
        <td style="width: 34%; text-align: center">
          Dicetak oleh: <?php echo $sesen_username ?>
        </td>
        <td style="width: 33%; text-align: right">
          Halaman [[page_cu]]/[[page_nb]]
        </td>
      </tr>
    </table>
  </page_footer>
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;
  }
  </style>
  <table>
    <tr>
      <th rowspan="3"><img src="images/logo.jpg" style="width:120px;height:100px" /></th>
      <td align="center" style="width: 800px;"><font style="font-size: 18px"><br><b>SAHIL AUTO CAR WASH</b></font>
        <br><br>Supply & Service Auto Equipment | Cuci Steam - Salon Mobil - Spare Part - Accessories
        <br><br>Jalan Demang Lebar Daun No. 69, Palembang | Telp: (0711) 367769</td>
    </tr>
  </table>
  <hr><br><br>
  <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; background: #ddd"><b>No.</b></td>
        <td style="text-align: center; background: #ddd"><b>Nama Pembeli</b></td>
        <td style="text-align: center; background: #ddd"><b>Tipe Mobil</b></td>
        <td style="text-align: center; background: #ddd"><b>NOPOL</b></td>
        <td style="text-align: center; background: #ddd"><b>No. HP</b></td>
        <td style="text-align: center; background: #ddd"><b>Harga</b></td>
        <td style="text-align: center; background: #ddd"><b>Pencuci 1</b></td>
        <td style="text-align: center; background: #ddd"><b>Pencuci 2</b></td>
        <td style="text-align: center; background: #ddd"><b>Waktu & Tanggal</b></td>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = mysqli_query($conn, "SELECT * FROM penjualan_detail ORDER BY no_penjualan ASC");  
      $i   = 1;
      while($data=mysqli_fetch_array($sql))
      {
      ?>
      <tr>
        <td style="text-align: center; width=50px;"><?php echo $data['no_penjualan']; ?></td>
        <td style="text-align: center; width=100px;"><?php echo $data['nama_pembeli']; ?></td>
        <td style="text-align: center; width=100px;"><?php echo $data['tipe_mobil']; ?></td>
        <td style="text-align: center; width=87px;"><?php echo $data['nopol']; ?></td>
        <td style="text-align: center; width=75px;"><?php echo $data['no_hp']; ?></td>
        <td style="text-align: center; width=100px;"><?php echo $data['harga']; ?></td>
        <td style="text-align: center; width=95px;"><?php echo $data['pencuci_1']; ?></td>
        <td style="text-align: center; width=95px;"><?php echo $data['pencuci_2']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo tgl_indo($data['tgl_upload']); ?></td>
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
</page>
<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
 include 'html2pdf/html2pdf.class.php';
 try
{
    $html2pdf = new HTML2PDF('L', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_penjualan_keseluruhan.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>