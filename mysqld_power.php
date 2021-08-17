<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
?>
<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
exec("service mysqld status", $output, $return_var);

if($output[0]=="mysqld가 정지됨") {
	echo "<script>alert('mysqld 켜기')</script>";
	exec("./mysqld_on");
} else {
	echo "<script>alert('mysqld 끄기')</script>";
	exec("./mysqld_off");
}
flush(); sleep(0.3);
echo "<script> document.location.href='main.php';</script>";
?>
</body>
</html>
