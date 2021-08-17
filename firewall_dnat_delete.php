<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$nat = "PREROUTING";

$exip1 = $_POST['exip1'];   # IP
$exip2 = $_POST['exip2'];
$exip3 = $_POST['exip3'];
$exip4 = $_POST['exip4'];
$exiparr = array($exip1, $exip2, $exip3, $exip4);
$chkip = implode("", $exiparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall_dnat.php';</script>";
	exit;
} else {
	if(($exip1 > 255) || ($exip2 > 255) || ($exip3 > 255) || ($exip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall_dnat.php';</script>";
		exit;
	}
}
$exipaddr = implode(".", $exiparr); # 문자열 합치기

$exinf = $_POST['exinf'];    # interface

$inip1 = $_POST['inip1'];   # IP
$inip2 = $_POST['inip2'];
$inip3 = $_POST['inip3'];
$inip4 = $_POST['inip4'];
$iniparr = array($inip1, $inip2, $inip3, $inip4);
$chkip = implode("", $iniparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall_dnat.php';</script>";
	exit;
} else {
	if(($inip1 > 255) || ($inip2 > 255) || ($inip3 > 255) || ($inip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall_dnat.php';</script>";
		exit;
	}
}
$inipaddr = implode(".", $iniparr); # 문자열 합치기

$inmask = $_POST['inmask'];
?>

<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
$sql = "DELETE FROM firewall_dnat WHERE nat='".$nat."'&&exip='".$exipaddr."'&&exinf='".$exinf."'&&inip='".$inipaddr."'&&inmask='".$inmask."'";
$result=mysql_query($sql);

exec("./firewall_dnat_delete $exipaddr $exinf $inipaddr $inmask");
exec("./firewallsave");

mysql_close($conn);
flush(); sleep(1);
echo "<script> document.location.href='firewall_dnat.php';</script>";

?>
</body>
</html>
