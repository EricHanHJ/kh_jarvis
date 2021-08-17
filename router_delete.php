<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$location = $_POST['select_inf'];	# Type

$ip1 = $_POST['ip1'];	# IP
$ip2 = $_POST['ip2'];
$ip3 = $_POST['ip3'];
$ip4 = $_POST['ip4'];
$iparr = array($ip1, $ip2, $ip3, $ip4);
$chkip = implode("", $iparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='router.php';</script>";
	exit;
} else {
	if(($ip1 > 255) || ($ip2 > 255) || ($ip3 > 255) || ($ip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='router.php';</script>";
		exit;
	}
}
$ipaddr = implode(".", $iparr);	# 문자열 합치기


$mask1 = $_POST['mask1'];	# mask
$mask2 = $_POST['mask2'];
$mask3 = $_POST['mask3'];
$mask4 = $_POST['mask4'];
$maskarr = array($mask1, $mask2, $mask3, $mask4);
$chknm = implode("", $maskarr);
if(!preg_match("/^[0-9]+$/", $chknm)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='router.php';</script>";
	exit;
} else {
	if(($mask1 > 255) || ($mask2 > 255) || ($mask3 > 255) || ($mask4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='router.php';</script>";
		exit;
	}
}
$netmask = implode(".", $maskarr);
?>

<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
$sql = "DELETE FROM router WHERE targetip='".$ipaddr."';";
$result = mysql_query($sql);

mysql_close($conn);

exec("./routedel $ipaddr $netmask $location");

flush(); sleep(1);
echo "<script> document.location.href='router.php';</script>";
?>
</body>
</html>