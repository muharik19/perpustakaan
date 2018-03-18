<?php
switch(@$_GET['act']) {
  default:

if(!isset($_SESSION)) {
  session_start();
}

$Num_Rows = mysqli_num_rows(mysqli_query($link, "SELECT * FROM tbuku"));

?>
<!-- Example DataTables Card-->
      <a href="?page=buku&act=tambahbuku" class="btn btn-primary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-plus"></li>&nbsp; Tambah Data Buku</a> <a href ="page/laporan/laporan_buku_excel.php" target="blank" class="btn btn-secondary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-download"></li> ExportToExcel</a> <a href ="page/laporan/laporan_buku_pdf.php" target="blank" class="btn btn-secondary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-download"></li> ExportToPDF</a>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Buku Perpustakaan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>ISBN</th>
                  <th>Jumlah Buku</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  $no = 1;

                  $sql = mysqli_query($link, "SELECT * FROM tbuku");
                  while ($data = mysqli_fetch_array($sql)) {

                ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['Judul']; ?></td>
                  <td><?php echo $data['Pengarang']; ?></td>
                  <td><?php echo $data['Penerbit']; ?></td>
                  <td><?php echo $data['Isbn']; ?></td>
                  <td><?php echo $data['JumlahBuku']; ?></td>
                  <td><a href="?page=buku&act=edit_buku&id=<?php echo $data['Id']; ?>" class="btn btn-info btn-xs"><li class="fa fa-magic" title="Edit"></li> Edit</a>
                      <a href="page/buku/aksi_buku.php?page=buku&act=hapus_buku&id=<?php echo $data['Id']; ?>&Judul=<?php echo $data['Judul']; ?>" onclick="return confirm('Anda yakin ingin menghapus buku <?php echo $data['Judul']; ?>?');" class="btn btn-danger btn-xs"><li class="fa fa-trash" title="Hapus"></li> Delete</a>
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

  case 'tambahbuku':
    echo "<form method='POST' action='page/buku/aksi_buku.php?page=buku&act=input'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Tambah Data Buku</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Judul</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Judul' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Pengarang</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Pengarang' /></td>
                          </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Penerbit</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Penerbit' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'><b>Tahun Terbit</b></td>
                      <td>:</td>
                      <td><select class='form-control' name='TahunTerbit'><option value='tahun' selected>Pilih Tahun</option>";
                            
                            $tahun = date('Y');

                            for ($i=$tahun-29; $i <= $tahun; $i++) {
                              echo "<option value='$i'>$i</option>";
                            }
                    echo " </select> </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>ISBN</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Isbn' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Jumlah Buku</b></td>
                        <td>:</td>
                        <td><input class='form-control' type='number' name='JumlahBuku' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Lokasi</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='Lokasi' />
                                  <option value='Lokasi'>Lokasi</option>
                                  <option value='Computer'>Computer</option>
                                  <option value='Bisnis'>Bisnis</option>
                                  <option value='Management'>Management</option>
                                  <option value='Masak'>Masak</option>
                            </select>
                        </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Input</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalInput' type='date' /></td>
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

  case "edit_buku":
  $data = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM tbuku WHERE Id = '$_GET[id]'"));
  if ($data['Lokasi'] == 'Computer') {
    $a = 'selected';
  }
  elseif ($data['Lokasi'] == 'Bisnis') {
    $b = 'selected';
  }
  elseif ($data['Lokasi'] == 'Management') {
    $c = 'selected';
  }
  elseif ($data['Lokasi'] == 'Masak') {
    $d = 'selected';
  }
  else {
    $a = '';
    $b = '';
    $c = '';
    $d = '';
  }

$tahun2 = $data['TahunTerbit'];

    echo "<form method='POST' action='page/buku/aksi_buku.php?page=buku&act=update&id=$_GET[id]'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Edit Data Buku</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                    <form>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Judul</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Judul' value='$data[Judul]' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Pengarang</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Pengarang' value='$data[Pengarang]' /></td>
                          </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Penerbit</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Penerbit' value='$data[Penerbit]' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'><b>Tahun Terbit</b></td>
                      <td>:</td>
                      <td><select class='form-control' name='TahunTerbit'><option value='tahun' selected>Pilih Tahun</option>";
                            
                        $tahun = date('Y');

                        for ($i = $tahun-29; $i <= $tahun; $i++) {
                          if ($i == $tahun2) {        
                            echo "<option value='$i' selected>$tahun2</option>";
                          }
                          else {
                           echo "<option value='$i'>$i</option>";
                          }
                        
                        }
                             
                    echo " </select> </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>ISBN</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Isbn' value='$data[Isbn]' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Jumlah Buku</b></td>
                        <td>:</td>
                        <td><input class='form-control' type='number' name='JumlahBuku' value='$data[JumlahBuku]' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Lokasi</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='Lokasi' />
                                  <option value='Lokasi'>Pilih Lokasi</option>
                                  <option value='Computer' $a>Computer</option>
                                  <option value='Bisnis' $b>Bisnis</option>
                                  <option value='Management' $c>Management</option>
                                  <option value='Masak' $d>Masak</option>
                            </select>
                        </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Input</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalInput' type='date' value='$data[TanggalInput]' /></td>
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