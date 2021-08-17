<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
$id = $_POST['select_user'];	# User ID

$lip1 = $_POST['lip1'];	# local IP
$lip2 = $_POST['lip2'];
$lip3 = $_POST['lip3'];
$lip4 = $_POST['lip4'];

$liparr = array($lip1, $lip2, $lip3, $lip4);
$chkip = implode("", $liparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_pptp.php';</script>";
	exit;
} else {
	if(($lip1 > 255) || ($lip2 > 255) || ($lip3 > 255) || ($lip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_pptp.php';</script>";
		exit;
	}
}
$lipaddr = implode(".", $liparr);	# 문자열 합치기

$rip1 = $_POST['rip1'];	# remote IP (start)
$rip2 = $_POST['rip2'];
$rip3 = $_POST['rip3'];
$rip4 = $_POST['rip4'];

$riparr_s = array($rip1, $rip2, $rip3, $rip4);
$chkip = implode("", $riparr_s);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_pptp.php';</script>";
	exit;
} else {
	if(($rip1 > 255) || ($rip2 > 255) || ($rip3 > 255) || ($rip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_pptp.php';</script>";
		exit;
	}
}
$ripaddr_s = implode(".", $riparr_s);

$rip5 = $_POST['rip5'];	# remote IP (end)
$rip6 = $_POST['rip6'];
$rip7 = $_POST['rip7'];
$rip8 = $_POST['rip8'];

$riparr_e = array($rip5, $rip6, $rip7, $rip8);
$chkip = implode("", $riparr_e);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('숫자만 입력해주시기 바랍니다.'); document.location.href='vpn_pptp.php';</script>";
	exit;
} else {
	if(($rip5 > 255) || ($rip6 > 255) || ($rip7 > 255) || ($rip8 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_pptp.php';</script>";
		exit;
	}
}
$ripaddr_e = implode(".", $riparr_e);

$dnsip1 = $_POST['dnsip1'];	# DNS server IP
$dnsip2 = $_POST['dnsip2'];
$dnsip3 = $_POST['dnsip3'];
$dnsip4 = $_POST['dnsip4'];

$dnsiparr = array($dnsip1, $dnsip2, $dnsip3, $dnsip4);
$chkip = implode("", $dnsiparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('숫자만 입력해주시기 바랍니다.'); document.location.href='vpn_pptp.php';</script>";
	exit;
} else {
	if(($dnsip1 > 255) || ($dnsip2 > 255) || ($dnsip3 > 255) || ($dnsip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_pptp.php';</script>";
		exit;
	}
}
$dnsipaddr = implode(".", $dnsiparr);

?>
<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

$sql = "INSERT INTO pptp VALUES('".$id."','".$lipaddr."','".$ripaddr_s."','".$ripaddr_e."','".$rip8."','".$dnsipaddr."')";

$result = mysql_query($sql);

mysql_close($conn);
flush(); sleep(2);	# 2초 지연
echo "<script> document.location.href='vpn_pptp.php';</script>";
?>
</body>
</html>
