<?php
switch (@$_GET['act']) {
  default:

if(!isset($_SESSION)) {
  session_start();
}

$Num_Rows = mysqli_num_rows(mysqli_query($link,"SELECT * FROM tuser"));

?>
<!-- Example DataTables Card-->
      <a href="?page=user&act=tambahuser" class="btn btn-primary btn-xs" style="margin-bottom: 10px;"><li class="fa fa-plus"></li>&nbsp; Tambah Data User Admin</a>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data User Admin Perpustakaan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama Lengkap</th>
                  <th>Aktif</th>
                  <th>Username</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  $no = 1;

                  $sql = mysqli_query($link,"SELECT * FROM tuser");
                  while ($data = mysqli_fetch_array($sql)) {

                ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['NIP']; ?></td>
                  <td><?php echo $data['NamaLengkap']; ?></td>
                  <td><?php echo $data['Aktif']; ?></td>
                  <td><?php echo $data['Username']; ?></td>
                  <td><a href="?page=user&act=edit_user&id=<?php echo $data['IdUser']; ?>" class="btn btn-info btn-xs"><li class="fa fa-magic" title="Edit"></li> Edit</a>
                      <a href="page/user/aksi_user.php?page=user&act=hapus_user&id=<?php echo $data['IdUser']; ?>&Username=<?php echo $data['Username']; ?>" onclick="return confirm('Anda yakin ingin menghapus user admin <?php echo $data['NamaLengkap']; ?>?');" class="btn btn-danger btn-xs"><li class="fa fa-trash" title="Hapus"></li> Delete</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php

          $data = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM tuser WHERE IdUser = '$_SESSION[IdUser]'"));

        ?>
         <div class="card-footer small text-muted"> Date Login: <?php echo $data['LastLogin']; ?> </div>
      </div>
<?php
  break; 

  case 'tambahuser':
    echo "<form method='POST' action='page/user/aksi_user.php?page=user&act=input'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Tambah Data User Admin</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>NIP</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='NIP' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Nama Lengkap</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='NamaLengkap' /></td>
                          </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Alamat</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Alamat' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Telepon</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Telepon' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Hp</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='CellPhone' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Agama</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='Agama' />
                                  <option value='Agama'>Pilih Agama</option>
                                  <option value='Islam'>Islam</option>
                                  <option value='Kristen'>Kristen</option>
                                  <option value='Katolik'>Katolik</option>
                                  <option value='Budha'>Budha</option>
                                  <option value='Hindu'>Hindu</option>
                            </select>
                        </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Email</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Email' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Aktif</b></td>
                        <td>:</td><br>
                        <td><input type='radio' name='Aktif' value='Y' /> Y &nbsp;
                            <input type='radio' name='Aktif' value='N' /> N
                        </td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Pendidikan Terakhir</b></td>
                        <td>:</td>
                        <td><select class='form-control' name='PendidikanTerakhir'>
                                  <option value='PendidikanTerakhir'>Pilih Pendidikan Terakhir</option>";
                                      $sql = mysqli_query($link,"SELECT * FROM tpendidikan_terakhir ORDER BY IdPendidikanTerakhir ASC");
                                        while ($data = mysqli_fetch_array($sql)){
                                      echo "<option value='$data[IdPendidikanTerakhir]'>$data[PendidikanTerakhir]</option>";
                                    }
                            echo "  </select> </td> </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Username</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Username' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Password</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Password' /></td>
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

  case "edit_user":
  $data = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM tuser WHERE IdUser = '$_GET[id]'"));

  if($data['Aktif'] == 'Y') {
      $Y = 'checked';
    }
    elseif ($data['Aktif'] == 'N') {
      $N = 'checked';
    }
    else {
      $Y = '';
      $N = '';
    }

    echo "<form method='POST' action='page/user/aksi_user.php?page=user&act=update&IdUser=$_GET[id]'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Edit Data User Admin</strong></div>
              <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Id User</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='IdUser' value='$data[IdUser]' readonly /></td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>NIP</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='NIP' value='$data[NIP]' readonly /></td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Nama Lengkap</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='NamaLengkap' value='$data[NamaLengkap]' /></td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Alamat</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='Alamat' value='$data[Alamat]' /></td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Telepon</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='Telepon' value='$data[Telepon]' /></td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Hp</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='CellPhone' value='$data[CellPhone]' /></td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Agama</b></td>
                    <td>:</td>
                    <td><select class='form-control' name='Agama'>
                                  <option value='Agama'>Pilih Agama</option>";
                                  $Agama=$data['Agama'];
                                  if ($Agama==Islam) {
                                    echo "<option value='Islam' selected>Islam</option>";
                                    echo "<option value='Kristen' $b>Kristen</option>";
                                    echo "<option value='Katolik' $c>Katolik</option>";
                                    echo "<option value='Budha' $d>Budha</option>";
                                    echo "<option value='Hindu' $e>Hindu</option>";
                                  }
                                  else if ($Agama==Kristen) {
                                    echo "<option value='Islam'>Islam</option>";
                                    echo "<option value='Kristen' selected>Kristen</option>";
                                    echo "<option value='Katolik' $c>Katolik</option>";
                                    echo "<option value='Budha' $d>Budha</option>";
                                    echo "<option value='Hindu' $e>Hindu</option>";
                                  }
                                  else if ($Agama==Katolik) {
                                    echo "<option value='Islam'>Islam</option>";
                                    echo "<option value='Kristen'>Kristen</option>";
                                    echo "<option value='Katolik' selected>Katolik</option>";
                                    echo "<option value='Budha' $d>Budha</option>";
                                    echo "<option value='Hindu' $e>Hindu</option>";
                                  }
                                  else if ($Agama==Budha) {
                                    echo "<option value='Islam'>Islam</option>";
                                    echo "<option value='Kristen'>Kristen</option>";
                                    echo "<option value='Katolik'>Katolik</option>";
                                    echo "<option value='Budha' selected>Budha</option>";
                                    echo "<option value='Hindu' $e>Hindu</option>";
                                  }
                                  else if ($Agama==Hindu) {
                                    echo "<option value='Islam'>Islam</option>";
                                    echo "<option value='Kristen'>Kristen</option>";
                                    echo "<option value='Katolik'>Katolik</option>";
                                    echo "<option value='Budha'>Budha</option>";
                                    echo "<option value='Hindu' selected>Hindu</option>";
                                  }
                        echo " </select>
                    </td></div>
                  </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Email</b></td>
                    <td>:</td>
                    <td><input class='form-control' name='Email' value='$data[Email]' /></td></div>
                  </tr>
                  <tr>
                      <td><div class='form-group'>&nbsp;<b>Aktif</b></td>
                        <td>:</td><br>
                        <td><input type='radio' name='Aktif' value='Y' $Y /> Y &nbsp;
                            <input type='radio' name='Aktif' value='N' $N /> N
                        </td></div>
                    </tr>
                  <tr>
                    <td><div class='form-group'>&nbsp;<b>Pendidikan Terakhir</b></td>
                    <td>:</td>
                    <td><select class='form-control' name='PendidikanTerakhir'>
                                  <option value='PendidikanTerakhir' selected>Pilih Pendidikan Terakhir</option>";
                                      $sql = mysqli_query($link,"SELECT * FROM tpendidikan_terakhir ORDER BY IdPendidikanTerakhir ASC");
                                        while ($r = mysqli_fetch_array($sql)) {
                                          if ($data[IdPendidikanTerakhir] == $r[IdPendidikanTerakhir]) {
                                            echo "<option value='$r[IdPendidikanTerakhir]' selected>$r[PendidikanTerakhir]</option>";
                                          }
                                          else{
                                            echo "<option value='$r[IdPendidikanTerakhir]'>$r[PendidikanTerakhir]</option>";
                                          }
                                        }
                        echo "  </select> </td> </div>
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