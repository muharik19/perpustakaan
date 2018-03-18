<?php

	
?>
	<h2><span>Manajemen Nilai Mahasiswa</span></h2>
	<form method=POST action=?page=transaksi>
	<input class='form-control' type='text' name='NIM' placeholder='Search for NIM'>
              <span class='input-group-btn'>
                <button class='btn btn-primary' type='button'>
                  <i class='fa fa-search'></i>
                </button>
              </span>
            </div>
	</form>
<?php
	if($_POST[submit]){
		echo "<meta http-equiv='refresh' content='0; URL=master.php?page=transaksi&act=transaksi&NIM=$_POST[NIM]'>";
	}

	

	?>
	<h2><span>Manajemen Nilai Mahasiswa</span></h2>
	<form method=POST action=?module=manajemen_nilai>
	<table>
		<tr>
			<td>Masukkan NIM : <input type=text name=NIM> <input type=submit name=submit value=Go></td>
		</tr>
	</table>
	</form>

	case 'tambahtransaksi':
    echo "<form method='POST' action='page/buku/aksi_transaksi.php?page=transaksi&act=input'>
          <div class='card mb-3'>
            <div class='card-header'><strong>Tambah Transaksi Pinjam Buku</strong></div>
            <div class='panel-body'>
                <div class='col-md-12'>&nbsp;
                <div class='input-group' style='margin-bottom:10px;'>
              <input class='form-control' type='text' name='NIM' placeholder='Search for NIM'>
              <span class='input-group-btn'>
                <button class='btn btn-primary' type='button'>
                  <i class='fa fa-search'></i>
                </button>
              </span>
            </div>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>NIM</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='NIM' value='$data[NIM]' disabled /></td>
                          </div>
                    </tr>
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Nama</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Nama' value='$data[Nama]' disabled /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Judul</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='Judul' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Jumlah Buku</b></td>
                        <td>:</td>
                        <td><input class='form-control' type='number' name='JumlahBuku' /></td>
                          </div>
                    </tr>
                    
                      <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Pinjam</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalPinjam' type='text' /></td>
                          </div>
                    </tr>
                    <tr>
                      <td><div class='form-group'>&nbsp;<b>Tanggal Kembali</b></td>
                        <td>:</td>
                        <td><input class='form-control' name='TanggalKembali' type='text' /></td>
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


<div class='input-group' style='margin-bottom:10px;'>
              <input class='form-control' type='text' name='NIM' placeholder='Search for NIM'>
              <span class='input-group-btn'>
                <button class='btn btn-primary' type='button'>
                  <i class='fa fa-search'></i>
                </button>
              </span>
            </div>