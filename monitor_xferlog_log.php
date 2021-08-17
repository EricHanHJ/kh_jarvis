<html>
<head></head>
<body style="font-size:14px;">
<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$handle = popen('tail -n 5 /var/log/xferlog 2>&1', 'r');
while(!feof($handle)) {
	$buffer = fgets($handle);
	echo "$buffer<br/>\n";
	ob_flush();
	flush();
}
pclose($handle);
flush();
sleep(1);
echo "<script> document.location.href='monitor_xferlog_log.php';</script>";
?>
</body>
</html>
