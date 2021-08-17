<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$num = $_POST['num'];	# 인원수
$id = $_POST['id'];		# id
$pw = $_POST['pw'];		# pw

$ip1 = $_POST['ip1'];
$ip2 = $_POST['ip2'];
$ip3 = $_POST['ip3'];
$ip4 = $_POST['ip4'];
$iparr = array($ip1, $ip2, $ip3, $ip4);
$chkip = implode("", $iparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
	exit;
} else {
	if(($ip1 > 255) || ($ip2 > 255) || ($ip3 > 255) || ($ip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
		exit;
	}
}
$ipaddr = implode(".", $iparr);

$mask1 = $_POST['mask1'];
$mask2 = $_POST['mask2'];
$mask3 = $_POST['mask3'];
$mask4 = $_POST['mask4'];
$maskarr = array($mask1, $mask2, $mask3, $mask4);
$chkip = implode("", $maskarr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
	exit;
} else {
	if(($mask1 > 255) || ($mask2 > 255) || ($mask3 > 255) || ($mask4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
		exit;
	}
}
$netmask = implode(".", $maskarr);

########################################추가▼
$inip1 = $_POST['inip1'];
$inip2 = $_POST['inip2'];
$inip3 = $_POST['inip3'];
$inip4 = $_POST['inip4'];
$iniparr = array($inip1, $inip2, $inip3, $inip4);
$chkip = implode("", $iniparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
	exit;
} else {
	if(($inip1 > 255) || ($inip2 > 255) || ($inip3 > 255) || ($inip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
		exit;
	}
}
$inipaddr = implode(".", $iniparr);

$inmask1 = $_POST['inmask1'];
$inmask2 = $_POST['inmask2'];
$inmask3 = $_POST['inmask3'];
$inmask4 = $_POST['inmask4'];
$inmaskarr = array($inmask1, $inmask2, $inmask3, $inmask4);
$chkip = implode("", $inmaskarr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
	exit;
} else {
	if(($inmask1 > 255) || ($inmask2 > 255) || ($inmask3 > 255) || ($inmask4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
		exit;
	}
}
$innetmask = implode(".", $inmaskarr);

$cip1 = $_POST['cip1'];
$cip2 = $_POST['cip2'];
$cip3 = $_POST['cip3'];
$cip4 = $_POST['cip4'];
$ciparr = array($cip1, $cip2, $cip3, $cip4);
$chkip = implode("", $ciparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
	exit;
} else {
	if(($cip1 > 255) || ($cip2 > 255) || ($cip3 > 255) || ($cip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
		exit;
	}
}
$cipaddr = implode(".", $ciparr);

$cmask1 = $_POST['cmask1'];
$cmask2 = $_POST['cmask2'];
$cmask3 = $_POST['cmask3'];
$cmask4 = $_POST['cmask4'];
$cmaskarr = array($cmask1, $cmask2, $cmask3, $cmask4);
$chkip = implode("", $cmaskarr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
	exit;
} else {
	if(($cmask1 > 255) || ($cmask2 > 255) || ($cmask3 > 255) || ($cmask4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='vpn_openvpn.php';</script>";
		exit;
	}
}
$cnetmask = implode(".", $cmaskarr);


?>
<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

$sql = "INSERT INTO openvpn VALUES('".$num."','".$ipaddr."','".$netmask."','".$id."','".$pw."');";
$result = mysql_query($sql);

mysql_close($conn);

flush(); sleep(1);
echo "<script> document.location.href='vpn_openvpn.php';</script>";
?>
</body>
</html>
