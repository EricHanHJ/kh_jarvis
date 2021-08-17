<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
}

$domain = $_POST['domain'];  

$ip1 = $_POST['ip1'];   # IP
$ip2 = $_POST['ip2'];
$ip3 = $_POST['ip3'];
$ip4 = $_POST['ip4'];

$netmask = $_POST['netmask'];

$iparr = array($ip1, $ip2, $ip3, $ip4);
$chkip = implode("", $iparr);
if(!preg_match("/^[0-9]+$/", $chkip)) {
	echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall_web.php';</script>";
	exit;
} else {
	if(($ip1 > 255) || ($ip2 > 255) || ($ip3 > 255) || ($ip4 > 255)) {
		echo "<Script>alert('입력 불가능한 IP'); document.location.href='firewall_web.php';</script>";
		exit;
	}
}
$ipaddr = implode(".", $iparr); # 문자열 합치기
?>
<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
$sql = "DELETE FROM firewall_web WHERE domain='".$domain."'&&ip='".$ipaddr."'&&netmask='".$netmask."'";
$result=mysql_query($sql);

flush(); sleep(0.5);

exec("./firewall_web_delete $ipaddr $netmask $domain");

echo "<script> document.location.href='firewall_web.php';</script>";
mysql_close($conn);
?>
</body>
</html>
