<?php
switch(@$_GET['act']) {
  default:

if(!isset($_SESSION)) {
  session_start();
}

  $Num_Rows = mysqli_num_rows(mysqli_query($link, "SELECT * FROM tanggota"));

?>
<!-- Example DataTables Card-->
      <a href="?page=anggota&act=tambahanggota" class="btn btn-primary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-plus"></li>&nbsp; Tambah Data Anggota</a> <a href ="page/laporan/laporan_anggota_excel.php" target="blank" class="btn btn-secondary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-download"></li> ExportToExcel</a> <a href ="page/laporan/laporan_anggota_pdf.php" target="blank" class="btn btn-secondary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-download"></li> ExportToPDF</a>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Anggota Perpustakaan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Prodi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  $no = 1;

                  $sql = mysqli_query($link, "SELECT * FROM tanggota");
                  while ($data = mysqli_fetch_array($sql)) {

                ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['NIM']; ?></td>
                  <td><?php echo $data['Nama']; ?></td>
                  <td><?php echo $data['TempatLahir']; ?></td>
                  <td><?php echo $data['TanggalLahir']; ?></td>
                  <td><?php echo $data['JK']; ?></td>
                  <td><?php echo $data['Prodi']; ?></td>
                  <td><a href="?page=anggota&act=edit_anggota&NIM=<?php echo $data['NIM']; ?>" class="btn btn-info btn-xs"><li class="fa fa-magic" title="Edit"></li> Edit</a>
                      <a href="page/anggota/aksi_anggota.php?page=anggota&act=hapus_anggota&NIM=<?php echo $data['NIM']; ?>&Nama=<?php echo $data['Nama']; ?>" onclick="return confirm('Anda yakin ingin menghapus anggota <?php echo $data['Nama']; ?>?');" class="btn btn-danger btn-xs"><li class="fa fa-trash" title="Hapus"></li> Delete</a>
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

  case 'tambahanggota':
    echo "<form method='POST' action='page/anggota/aksi_anggota.php?page=anggota&act=input'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Tambah Data Anggota</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>NIM</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='NIM' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Nama</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Nama' /></td>
                          </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Tempat Lahir</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TempatLahir' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Lahir</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalLahir' type='date' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Jenis Kelamin</b></td>
                        <td>:</td><br>
                        <td><input type='radio' name='JK' value='Laki-laki' /> Laki-laki &nbsp;
                            <input type='radio' name='JK' value='Perempuan' /> Perempuan
                        </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Prodi</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='Prodi' />
                                  <option value='Prodi'>Pilih Prodi</option>
                                  <option value='Teknik Informatika'>Teknik Informatika</option>
                                  <option value='Teknik Mesin'>Teknik Mesin</option>
                                  <option value='Sistem Informasi'>Sistem Informasi</option>
                                  <option value='Management'>Management</option>
                                  <option value='Akutansi'>Akutansi</option>
                                  <option value='Sastra Inggris'>Sastra Inggris</option>
                                  <option value='Sastra Indonesia'>Sastra Indonesia</option>
                            </select>
                        </td>
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

  case "edit_anggota":
  $data = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM tanggota WHERE NIM = '$_GET[NIM]'"));

    echo "<form method='POST' action='page/anggota/aksi_anggota.php?page=anggota&act=update&NIM=$_GET[NIM]'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Edit Data Anggota</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                    <form>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>NIM</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='NIM' value='$data[NIM]' readolny /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Nama</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Nama' value='$data[Nama]' /></td>
                          </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Tempat Lahir</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TempatLahir' value='$data[TempatLahir]' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Lahir</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalLahir' type='date' value='$data[TanggalLahir]' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Jenis Kelamin</b></td>
                        <td>:</td><br>";
                        $JK=$data['JK'];
                        if ($JK=='Laki-laki') {
                          echo "<td><input type='radio' name='JK' value='Laki-laki' checked /> Laki-laki &nbsp";
                          echo "    <input type='radio' name='JK' value='Perempuan' /> Perempuan";
                        }
                        else if ($JK=='Perempuan') {
                          echo "<td><input type='radio' name='JK' value='Laki-laki' /> Laki-laki &nbsp";
                          echo "    <input type='radio' name='JK' value='Perempuan' checked /> Perempuan";
                        }
                    echo "   </td></div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Prodi</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='Prodi' />
                                  <option value='Prodi'>Pilih Prodi</option>";
                                  $Prodi=$data['Prodi'];
                                  if ($Prodi=='Teknik Informatika') {
                                  echo "<option value='Teknik Informatika' selected>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi'>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin'>Teknik Mesin</option>";
                                  echo "<option value='Management'>Management</option>";
                                  echo "<option value='Akutansi'>Akutansi</option>";
                                  echo "<option value='Sastra Inggris'>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia'>Sastra Indonesia</option>";
                                  }
                                  else if ($Prodi=='Sistem Informasi') {
                                  echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi' selected>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin'>Teknik Mesin</option>";
                                  echo "<option value='Management'>Management</option>";
                                  echo "<option value='Akutansi'>Akutansi</option>";
                                  echo "<option value='Sastra Inggris'>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia'>Sastra Indonesia</option>";
                                  }
                                  else if ($Prodi=='Teknik Mesin') {
                                  echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi'>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin' selected>Teknik Mesin</option>";
                                  echo "<option value='Management'>Management</option>";
                                  echo "<option value='Akutansi'>Akutansi</option>";
                                  echo "<option value='Sastra Inggris'>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia'>Sastra Indonesia</option>";
                                  }
                                  else if ($Prodi=='Management') {
                                  echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi'>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin'>Teknik Mesin</option>";
                                  echo "<option value='Management' selected>Management</option>";
                                  echo "<option value='Akutansi'>Akutansi</option>";
                                  echo "<option value='Sastra Inggris'>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia'>Sastra Indonesia</option>";
                                  }
                                  else if ($Prodi=='Akutansi') {
                                  echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi'>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin'>Teknik Mesin</option>";
                                  echo "<option value='Management'>Management</option>";
                                  echo "<option value='Akutansi' selected>Akutansi</option>";
                                  echo "<option value='Sastra Inggris'>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia'>Sastra Indonesia</option>";
                                  }
                                  else if ($Prodi=='Sastra Inggris') {
                                  echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi'>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin'>Teknik Mesin</option>";
                                  echo "<option value='Management'>Management</option>";
                                  echo "<option value='Akutansi'>Akutansi</option>";
                                  echo "<option value='Sastra Inggris' selected>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia'>Sastra Indonesia</option>";
                                  }
                                  else if ($Prodi=='Sastra Indonesia') {
                                  echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                                  echo "<option value='Sistem Informasi'>Sistem Informasi</option>";
                                  echo "<option value='Teknik Mesin'>Teknik Mesin</option>";
                                  echo "<option value='Management'>Management</option>";
                                  echo "<option value='Akutansi'>Akutansi</option>";
                                  echo "<option value='Sastra Inggris'>Sastra Inggris</option>";
                                  echo "<option value='Sastra Indonesia' selected>Sastra Indonesia</option>";
                                  }
                    echo "  </select>
                        </td> </div>
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