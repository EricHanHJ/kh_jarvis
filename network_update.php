<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
$eth = $_POST['select_interface']; # interface

$ip1 = $_POST['ip1'];	# IP
$ip2 = $_POST['ip2'];
$ip3 = $_POST['ip3'];
$ip4 = $_POST['ip4'];
$ip_temp = array($ip1, $ip2, $ip3, $ip4);
$chkip = implode("", $ip_temp);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
	exit;
} else {
	if(($ip1 > 255) || ($ip2 > 255) || ($ip3 > 255) || ($ip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
		exit;
	}
}
$ip_addr = implode(".", $ip_temp);

$mask1 = $_POST['mask1'];	# mask
$mask2 = $_POST['mask2'];
$mask3 = $_POST['mask3'];
$mask4 = $_POST['mask4'];
$mask_temp = array($mask1, $mask2, $mask3, $mask4);
$chkip = implode("", $mask_temp);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
	exit;
} else {
	if(($mask1 > 255) || ($mask2 > 255) || ($mask3 > 255) || ($mask4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
		exit;
	}
}
$mask_addr = implode(".", $mask_temp);

$gw1 = $_POST['gw1'];	# gw
$gw2 = $_POST['gw2'];
$gw3 = $_POST['gw3'];
$gw4 = $_POST['gw4'];
$gw_temp = array($gw1, $gw2, $gw3, $gw4);
$chkip = implode("", $gw_temp);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('gw'); document.location.href='network.php';</script>";
	exit;
} else {
	if(($gw1 > 255) || ($gw2 > 255) || ($gw3 > 255) || ($gw4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
		exit;
	}
}
$gw_addr = implode(".", $gw_temp);

$dns1 = $_POST['dns1'];	# dns
$dns2 = $_POST['dns2'];
$dns3 = $_POST['dns3'];
$dns4 = $_POST['dns4'];
$dns_temp = array($dns1, $dns2, $dns3, $dns4);
$chkip = implode("", $dns_temp);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
	exit;
} else {
	if(($dns1 > 255) || ($dns2 > 255) || ($dns3 > 255) || ($dns4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='network.php';</script>";
		exit;
	}
}
$dns_addr = implode(".", $dns_temp);
?>

<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

$sql = "update Network set IP='".$ip_addr."', Netmask='".$mask_addr."', Gateway='".$gw_addr."', DNS='".$dns_addr."' where Interface='".$eth."'";
$result = mysql_query($sql);

if($mask1 == "0"){
	$ip_route_temp=array("0", "0", "0", "0");
	$ip_route_addr=implode(".",$ip_route_temp);
	$sql = "update router set targetip='".$ip_route_addr."', netmask='".$mask_addr."'  where inf='".$eth."' and init='yes'";
	$result = mysql_query($sql);
}
else if($mask2 == "0"){
	$ip_route_temp=array($ip1, "0", "0", "0");
	$ip_route_addr=implode(".",$ip_route_temp);
	$sql = "update router set targetip='".$ip_route_addr."', netmask='".$mask_addr."' where inf='".$eth."' and init='yes'";
	$result = mysql_query($sql);
}
else if($mask3 == "0"){
	$ip_route_temp=array($ip1, $ip2, "0", "0");
	$ip_route_addr=implode(".",$ip_route_temp);
	$sql = "update router set targetip='".$ip_route_addr."', netmask='".$mask_addr."' where inf='".$eth."' and init='yes'";
	$result = mysql_query($sql);
}
else if($mask4 == "0"){
	$ip_route_temp=array($ip1, $ip2, $ip3, "0");
	$ip_route_addr=implode(".",$ip_route_temp);
	$sql = "update router set targetip='".$ip_route_addr."', netmask='".$mask_addr."' where inf='".$eth."' and init='yes'";
	$result = mysql_query($sql);
}

if($eth == "eth0"){
	exec("./mac_finder_eth0");
}
if($eth == "eth1"){
	exec("./mac_finder_eth1");
}
#    $eth  /  $ip_addr  /  $mask_addr  /  $gw_addr  /  $dns_addr
exec("./ip_set $eth $ip_addr $mask_addr $gw_addr $dns_addr ");
exec("./ipforward");

mysql_close($conn);
flush(); sleep(1);	# 페이지가 너무 빨리 넘어가서 1초 지연시킴
echo "<script> document.location.href='network.php';</script>";
?>
</body>
</html>
