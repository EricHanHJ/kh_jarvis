<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

if($output[0]=="pptp 정지함.") {
	# pptp 켜키
	exec("/var/www/html/kh/pptp_start");
	flush(); sleep(1);
	echo "<script> document.location.href='vpn_pptp.php';</script>";
} else {
	# pptp 끄기
	exec("/var/www/html/kh/pptp_stop");
	flush(); sleep(1);
	echo "<script> document.location.href='vpn_pptp.php';</script>";
}
?>
</body>
</html>
