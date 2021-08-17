<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
$chain = $_POST['select_chain'];  # INPUT/OUTPUT
$inf = $_POST['select_inf'];    # interface
$proto = $_POST['select_proto'];
$srcmask = $_POST['select_srcmask'];
$dstmask = $_POST['select_dstmask'];
$srcport = $_POST['srcport'];
$dstport = $_POST['dstport'];

$ip1 = $_POST['ip1'];   # IP
$ip2 = $_POST['ip2'];
$ip3 = $_POST['ip3'];
$ip4 = $_POST['ip4'];

$ip5 = $_POST['ip5'];   # IP
$ip6 = $_POST['ip6'];
$ip7 = $_POST['ip7'];
$ip8 = $_POST['ip8'];

$srciparr = array($ip1, $ip2, $ip3, $ip4);
$chkip = implode("", $srciparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall.php';</script>";
	exit;
} else {
	if(($ip1 > 255) || ($ip2 > 255) || ($ip3 > 255) || ($ip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall.php';</script>";
		exit;
	}
}
$srcipaddr = implode(".", $srciparr); # 문자열 합치기

$dstiparr = array($ip5, $ip6, $ip7, $ip8);
$chkip = implode("", $dstiparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall.php';</script>";
	exit;
} else {
	if(($ip5 > 255) || ($ip6 > 255) || ($ip7 > 255) || ($ip8 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall.php';</script>";
		exit;
	}
}
$dstipaddr = implode (".", $dstiparr);
?>
<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
$sql = "INSERT INTO firewall VALUES('".$chain."','".$inf."','".$proto."','".$srcipaddr."','".$srcmask."','".$dstipaddr."','".$dstmask."','".$srcport."','".$dstport."');";
$result=mysql_query($sql);

switch($chain) {
	case "INPUT":
	exec("./firewall $chain $inf $proto $srcipaddr $srcmask $dstipaddr $dstmask $srcport $dstport");
	exec("./firewallsave");
		break;
	case "OUTPUT":
	exec("./firewalloutput $chain $inf $proto $srcipaddr $srcmask $dstipaddr $dstmask $srcport $dstport");
	exec("./firewallsave");
		break;
	default:
		exec("./firewall $chain $inf $proto $srcipaddr $srcmask $dstipaddr $dstmask $srcport $dstport");
		exec("./firewallsave");
		break;
}
flush(); sleep(0.7);
echo "<script> document.location.href='firewall.php';</script>";
mysql_close($conn);
?>
</body>
</html>
