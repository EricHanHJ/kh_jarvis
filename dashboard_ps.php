<html>
<head></head>
<body style="font-size:14px;">
<?php
$handle = popen('ps -ef 2>&1', 'r');
while(!feof($handle)) {
	$buffer = fgets($handle);
	echo "$buffer<br/>\n";
	ob_flush();
	flush();
}
pclose($handle);
flush();
sleep(1);
echo "<script> document.location.href='dashboard_ps.php';</script>";
?>
</html>
