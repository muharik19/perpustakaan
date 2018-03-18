<?php
if(!isset($_SESSION)) {
	session_start();
}

// ==================== LEVEL USER : ADMINISTRATOR ====================//

?>
	<h2><span>Welcome to Administrator System</span></h2>

			<tr>
				<td>
					Hai.. <i><b><?php echo $_SESSION['NamaLengkap']; ?></b></i>, Selamat datang di halaman utama sistem Perpustakaan <i><b>Universitas Pamulang</b></i>,
					Anda dapat mengolah segala aktifitas dalam sistem ini. semua aktifitas yang Anda lakukan akan terekam dalam database.
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</td>
			</tr>
		
			<tr>
				<td>

					<?php

						$data = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM tuser WHERE IdUser = '$_SESSION[IdUser]'"));

					?>

					<div class="card-footer small text-muted"> Date Login: <?php echo $data['LastLogin']; ?> </div>
					
				</td>
			</tr>