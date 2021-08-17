<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
?>
<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
$a = $_POST['radio'];
$b = $_POST["id$a"];

$sql = "SELECT * FROM openvpn where id='$b'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
exec("/var/www/html/kh/openvpn_reset");
exec("/var/www/html/kh/openvpn_nop $result[nop]");
exec("/var/www/html/kh/openvpn_server $result[ip] $result[netmask]");
exec("/var/www/html/kh/openvpn_useradd $result[passwd] $result[id]");
exec("/var/www/html/kh/openvpn_restart");


mysql_close($conn);

flush(); sleep(1);
echo "<script> document.location.href='vpn_openvpn.php';</script>";
?>
</body>
</html>
