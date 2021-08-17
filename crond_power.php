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
exec("service crond status", $output, $return_var);

if($output[0]=="방화벽이 정지됨") {
	echo "<script>alert('crond 켜기')</script>";
	exec("./crondon");
} else {
	echo "<script>alert('crond 끄기')</script>";
	exec("./crondoff");
}
flush(); sleep(0.3);
echo "<script> document.location.href='main.php';</script>";
?>
</body>
</html>
