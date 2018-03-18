<?php
include "koneksi.php";

function antiinjection($data){
 $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
 return $filter_sql;
}

$username = antiinjection($_POST['username']);
$pass = antiinjection(md5($_POST['password']));

$login=mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
 session_start();

 $_SESSION[namauser] = $r[username];
 $_SESSION[passuser] = $r[password];
 
 header('location:index.php');
}
else{
 // echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
 echo "<center>LOGIN GAGAL! <br> 
 Username atau Password Anda tidak benar.<br>";
 echo "<a href=login.php><b>ULANGI LAGI</b></a></center>";
}
?>