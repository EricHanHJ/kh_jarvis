<html>
<head></head>
<body style="font-size:14px;">
<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('�α����� �ʿ��� �����Դϴ�.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$handle = popen('tail -n 5 /var/www/html/kh/httpd_access_log 2>&1', 'r');
while(!feof($handle)) {
	$buffer = fgets($handle);
	echo "$buffer<br/>\n";
	ob_flush();
	flush();
}
pclose($handle);
flush();
sleep(1);
echo "<script> document.location.href='monitor_httpd_access_log.php';</script>";
?>
</html>
