<?php
switch(@$_GET['act']) {
  default:

if(!isset($_SESSION)) {
  session_start();
}

$Num_Rows = mysqli_num_rows(mysqli_query($link, "SELECT * FROM ttransaksi"));

?>
<!-- Example DataTables Card-->
        <a href="?page=transaksi&act=tambahtransaksi" class="btn btn-primary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-plus"></li>&nbsp; Tambah Data Transaksi Pinjam Buku</a> <a href ="page/laporan/laporan_transaksi_excel.php" target="blank" class="btn btn-secondary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-download"></li> ExportToExcel</a> <a href ="page/laporan/laporan_transaksi_pdf.php" target="blank" class="btn btn-secondary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-download"></li> ExportToPDF</a>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Pinjaman Buku Perpustakaan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Terlambat</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  $no = 1;

                  $sql = mysqli_query($link, "SELECT tbuku.Judul as Judul, tanggota.NIM as NIM, tanggota.Nama as Nama, ttransaksi.TanggalPinjam as TanggalPinjam, ttransaksi.TanggalKembali as TanggalKembali, ttransaksi.Status as Status, ttransaksi.Id as Id  FROM ttransaksi,tbuku,tanggota WHERE ttransaksi.idBuku=tbuku.Id and ttransaksi.NIM=tanggota.NIM");
                  while ($data = mysqli_fetch_array($sql)) {

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
                  <td><a href="page/transaksi/aksi_transaksi.php?page=transaksi&act=kembali&Id=<?php echo $data['Id']; ?>&Judul=<?php echo $data['Judul']; ?>" class="btn btn-info btn-xs"><li class="fa fa-sign-in" title="Kembali"></li> Kembali</a>

                      <a href="page/transaksi/aksi_transaksi.php?page=transaksi&act=perpanjang&Id=<?php echo $data['Id']; ?>&Judul=<?php echo $data['Judul']; ?>&lambat=<?php echo $lambat ?>&TanggalKembali=<?php echo $data['TanggalKembali'] ?>" onclick="return confirm('Anda yakin ingin perpanjang pinjaman buku <?php echo $data['Nama']; ?>?');" class="btn btn-danger btn-xs"><li class="fa fa-sign-out" title="Perpanjang"></li> Perpanjang</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php

          $data = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM tuser WHERE IdUser = '$_SESSION[IdUser]'"));

        ?>
         <div class="card-footer small text-muted"> Date Login: <?php echo $data['LastLogin']; ?> </div>
      </div>
<?php
  break;

  case 'tambahtransaksi':

  $tgl_pinjam = date('d-m-Y');
  $tujuh_hari = mktime(0,0,0, date('n'), date('j')+7, date('Y'));
  $kembali = date('d-m-Y', $tujuh_hari);

    echo "<form method='POST' action='page/transaksi/aksi_transaksi.php?page=transaksi&act=input'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Tambah Transaksi Pinjam Buku</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Judul Buku</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='buku'>
                                  <option value='Judul'>Pilih Judul Buku</option>";
                                      $sql = mysqli_query($link, "SELECT * FROM tbuku ORDER BY Id ASC");
                                        while ($data = mysqli_fetch_array($sql)){
                                      echo "<option value='$data[Id].$data[Judul]'>$data[Judul]</option>";
                                    }
                            echo "  </select> </td> </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Nama Anggota</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='Nama'>
                                  <option value='Judul'>Pilih Nama Anggota</option>";
                                      $sql = mysqli_query($link, "SELECT * FROM tanggota ORDER BY NIM ASC");
                                        while ($data = mysqli_fetch_array($sql)){
                                      echo "<option value='$data[NIM].$data[Nama]'>$data[NIM]_$data[Nama]</option>";
                                    }
                            echo "  </select> </td> </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Pinjam</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalPinjam' type='text' id='tgl' value='$tgl_pinjam' readonly /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Kembali</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalKembali' type='text' id='tgl' value='$kembali' readonly /></td>
                          </div>
                    </tr>
                    <tr>
                      <td colspan=3><b>*) Isikan Secara lengkap</b></td>
                    </tr>
                    <tr><br><br>
                      <input type='submit' name='simpan' value='Simpan' class='btn btn-primary' style='margin-bottom: 10px;' />
                      <a href='javascript:history.go(-1)'><input type='button' name='cancel' value='Cancel' class='btn btn-secondary' data-dismiss='modal' style='margin-bottom: 10px;' /></a>
                    </tr>
                </div>
            </div>
          </div>
    </form>

    ";
  echo "<p>&nbsp;</p>";
    break;
?>
<?php
}
?>