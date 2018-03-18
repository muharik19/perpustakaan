<br>
<?php
switch($_GET[act]){
	default:
	session_start();
?>
	<form method='POST' action='page/buku/aksi_transaksi.php?page=transaksi&act=input'>
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
        </div>
    </div>
</div>
</form>
<?php
	if($_POST[submit]){
		echo "<meta http-equiv='refresh' content='0; URL=master.php?module=manajemen_nilai&act=nilai&NIM=$_POST[NIM]'>";
	}
	break;
	
	case "tambahtransaksi":
	?>
	<form method='POST' action='page/buku/aksi_transaksi.php?page=transaksi&act=input'>
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
        </div>
    </div>
</div>
</form>
<?php
	$data = mysql_fetch_array(mysql_query("SELECT * FROM tbuku,tanggota,ttransaksi WHERE ttransaksi.Judul = '$_GET[Judul]' AND
												ttransaksi.NIM = tanggota.NIM AND
												ttransaksi.Nama = ta.IdJurusan AND
												tmahasiswa.IdKelas = tkelas.IdKelas"));
		echo "<table>
				<tr>
					<th colspan=6>Data Mahasiswa</th>
				</tr>
				<tr>
					<td> NIM </td>
					<td>:</td>
					<td><b>$data[NIM]</b></td>
					<td> Jenis Kelamin </td>
					<td>:</td>
					<td><b>$data[JK]</b></td>
				</tr>
				<tr>
					<td> Nama </td>
					<td>:</td>
					<td><b>$data[NamaMahasiswa]</b></td>
					<td> Aktif </td>
					<td>:</td>
					<td><b>$data[Aktif]</b></td>
				</tr>
				<tr>
					<td> Program Studi </td>
					<td>:</td>
					<td><b>$data[NamaProdi]</b></td>
					<td> Kategori Kelas </td>
					<td>:</td>
					<td><b>$data[KategoriKelas]</b></td>
				</tr>
				<tr>
					<td> Jurusan </td>
					<td>:</td>
					<td><b>$data[NamaJurusan]</b></td>
					<td> Kelas </td>
					<td>:</td>
					<td><b>$data[NamaKelas]</b></td>
				</tr>
			  </table>";
		echo "<table>
				<tr>
					<th colspan=9><input type='button' value='Tambah Nilai' onclick=\"window.location.href='?module=manajemen_nilai&act=tambahnilai&NIM=$_GET[NIM]';\"></th>
				</tr>
				<tr>
					<th colspan=9>Data Nilai Mahasiswa</th>
				</tr>
				<tr>
					<th rowspan=2><div align=center> Kode Mata Kuliah </div></th>
					<th rowspan=2><div align=center> Mata Kuliah </div></th>
					<th rowspan=2><div align=center> UTS </div></th>
					<th rowspan=2><div align=center> UAS </div></th>
					<th colspan=3><div align=center> Kredit </div></th>
					<th rowspan=2><div align=center> Predikat </div></th>
					<th rowspan=2><div align=center>Aksi</div></th>
				</tr>
				<tr>
					<th><div align=center>Nilai</div></th>
					<th><div align=center>SKS</div></th>
					<th><div align=center>Mutu</div></th>
				</tr>";
				$sqlNilai = mysql_query("SELECT * FROM tnilai,tmakul WHERE NIM = '$_GET[NIM]' AND tmakul.IdMakul = tnilai.IdMakul");
				while($dataNilai = mysql_fetch_array($sqlNilai)){
					if($dataNilai[Nilai] == '4'){
						$predikat = 'A';
					}
					elseif($dataNilai[Nilai] == '3'){
						$predikat = 'B';
					}
					elseif($dataNilai[Nilai] == '2'){
						$predikat = 'C';
					}
					elseif($dataNilai[Nilai] == '1'){
						$predikat = 'D';
					}
					else{
						$predikat = 'E';
					}
					echo "<tr>
							<td>$dataNilai[KdMakul]</td>
							<td>$dataNilai[NamaMakul]</td>
							<td>$dataNilai[UTS]</td>
							<td>$dataNilai[UAS]</td>
							<td>$dataNilai[Nilai]</td>
							<td>$dataNilai[SKS]</td>
							<td>$dataNilai[Mutu]</td>
							<td>$predikat</td>
							<td><a href=?module=manajemen_nilai&act=editnilai&id=$dataNilai[IdNilai]&NIM=$_GET[NIM]>Edit</a> | ";
							?>
							<a href="modul/mod_nilai/aksi_nilai.php?module=manajemen_nilai&act=hapusnilai&id=<?php echo $dataNilai[IdNilai]; ?>&NIM=<?php echo $_GET[NIM]; ?>" onclick="return confirm('Anda yakin ingin menghapus Nilai ini?');">Hapus</a>
							<?php
							echo "</td>
						  </tr>";
					$sksTotal += $dataNilai[SKS];
					$mutuPoint += $dataNilai[Mutu];
				}
				
		$ipk = Round(($mutuPoint / $sksTotal),2);		
		echo "  </table>";
		echo "	<table>
					<th><table>
							<tr>
								<td width=180>Total SKS</td><td><b>$sksTotal</b></td>
							</tr>
							<tr>
								<td>Total Point</td><td><b>$mutuPoint</b></td>
							</tr>
							<tr>
								<td>Indeks Prestasi Kumulatif (IPK)</td><td><b>$ipk</b></td>
							</tr>
						</table>
					</th>
				</table>
				<table>
					<tr>
						<th><a href='modul/mod_nilai/export_to_pdf.php?NIM=$data[NIM]'><input type=button value='Export to PDF'></a>
							<a href='modul/mod_nilai/export_to_excel.php?NIM=$data[NIM]'><input type=button value='Export to Excel'></a></th>
					</tr>
				</table>
				";
	break;
	
	case "tambahnilai":
	$data = mysql_fetch_array(mysql_query("SELECT * FROM tmahasiswa WHERE NIM = '$_GET[NIM]'"));
	echo "<br><h2><span>Tambah Nilai Mahasiswa</span></h2>";
	echo "<form method='POST' action='modul/mod_nilai/aksi_nilai.php?module=manajemen_nilai&act=input&NIM=$data[NIM]'>
			<table>
				<tr>
					<td> NIM </td>
					<td>:</td>
					<td><input type='text' name='NIM' size='30' value='$data[NIM]' disabled> *)</td>
				</tr>
				<tr>
					<td width='150'> Nama Mahasiswa </td>
					<td width='15'>:</td>
					<td><input type='text' name='NamaMahasiswa' size='30' value='$data[NamaMahasiswa]' disabled></td>
				</tr>
				<tr>
					<td> Mata Kuliah </td>
					<td>:</td>
					<td><select name='IdMakul'><option value='++'>++ Pilih Makul ++</option>";
					
					$sql = mysql_query("SELECT * FROM tmakul WHERE IdJurusan = '$data[IdJurusan]' ORDER BY NamaMakul");
					while ($data2 = mysql_fetch_array($sql)){
						echo "<option value='$data2[IdMakul]'>$data2[NamaMakul]</option>";
					}
				echo "</select>	*)</td>
				</tr>
				<tr>
					<td> UTS </td>
					<td>:</td>
					<td><input type='text' name='UTS' size='30' maxlength='10'></td>
				</tr>
				<tr>
					<td> UAS </td>
					<td>:</td>
					<td><input type='text' name='UAS' size='30' maxlength='10'></td>
				</tr>
				<tr>
					<td> Nilai </td>
					<td>:</td>
					<td><select name='Nilai'>
							<option value='++'>++ Pilih Nilai Mutu ++</option>
							<option value='0'>0</option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
						</select></td>
				</tr>
				<tr>
					<th colspan='6'><input type='submit' value='Simpan'><a href='javascript:history.go(-1)'><input type='button' value='Cancel'></a></th>
				</tr>
			</table>
		</form>
	
		";
	echo "<p>&nbsp;</p>";
	break;
	
	case "editnilai":
	$data = mysql_fetch_array(mysql_query("SELECT * FROM tmahasiswa,tnilai,tmakul WHERE tnilai.IdNilai = '$_GET[id]' AND tmahasiswa.NIM = tnilai.NIM AND tmakul.IdMakul = tnilai.IdMakul"));
	if($data[Nilai] == '1'){
		$a = 'selected';
	}
	elseif($data[Nilai] == '2'){
		$b = 'selected';
	}
	elseif($data[Nilai] == '3'){
		$c = 'selected';
	}
	elseif($data[Nilai] == '4'){
		$d = 'selected';
	}
	else{
		$e = 'selected';
	}
	echo "<br><h2><span>Tambah Nilai Mahasiswa</span></h2>";
	echo "<form method='POST' action='modul/mod_nilai/aksi_nilai.php?module=manajemen_nilai&act=update&id=$_GET[id]&NIM=$data[NIM]'>
			<table>
				<tr>
					<td> NIM </td>
					<td>:</td>
					<td><input type='text' name='NIM' size='30' value='$data[NIM]' disabled> *)</td>
				</tr>
				<tr>
					<td width='150'> Nama Mahasiswa </td>
					<td width='15'>:</td>
					<td><input type='text' name='NamaMahasiswa' size='30' value='$data[NamaMahasiswa]' disabled></td>
				</tr>
				<tr>
					<td> Mata Kuliah </td>
					<td>:</td>
					<td><input type='text' name='IdMakul' size='30' value='$data[NamaMakul]' DISABLED></td>
				</tr><input type='hidden' name='IdMakul' size='30' value='$data[IdMakul]'>
				<tr>
					<td> UTS </td>
					<td>:</td>
					<td><input type='text' name='UTS' size='30' maxlength='10' value='$data[UTS]'></td>
				</tr>
				<tr>
					<td> UAS </td>
					<td>:</td>
					<td><input type='text' name='UAS' size='30' maxlength='10' value='$data[UAS]'></td>
				</tr>
				<tr>
					<td> Nilai </td>
					<td>:</td>
					<td><select name='Nilai'>
							<option value='0' $e>0</option>
							<option value='1' $a>1</option>
							<option value='2' $b>2</option>
							<option value='3' $c>3</option>
							<option value='4' $d>4</option>
						</select></td>
				</tr>
				<tr>
					<th colspan='6'><input type='submit' value='Simpan'><a href='javascript:history.go(-1)'><input type='button' value='Cancel'></a></th>
				</tr>
			</table>
		</form>
	
		";
	echo "<p>&nbsp;</p>";
	
	break;
}
?>