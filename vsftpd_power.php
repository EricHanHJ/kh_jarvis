<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
}
?>
<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
exec("service vsftpd status", $output, $return_var);

if($output[0]=="vsftpd가 정지됨") {
	echo "<script>alert('vsftpd 켜기')</script>";
	exec("./vsftpd_on");
} else {	# vsftpd 는 종료되었으나 subsys가 잠겨있음 <- 포함
	echo "<script>alert('vsftpd 끄기')</script>";
	exec("./vsftpd_off");
}
flush(); sleep(0.3);
echo "<script> document.location.href='main.php';</script>";

####vi vsftpd_on.c
####include stdio.h
####int main { setuid(0); system("service vsftpd restart"); return 0;}
####:wq
####gcc vsftpd_on.c -o vsftpd_on
####chmod 4755 vsftpd_on

?>
</body>
</html>
