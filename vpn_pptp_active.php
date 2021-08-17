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

$sql_u = "SELECT * FROM vpn_u where id='$b'";
$query_u = mysql_query($sql_u);
$result_u = mysql_fetch_array($query_u);
$sql = "SELECT * FROM pptp where id='$b'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
exec("/var/www/html/kh/pptpd_reset");
exec("/var/www/html/kh/chap_reset");
exec("/var/www/html/kh/dns_reset");
exec("/var/www/html/kh/pptpd_l $result[local]");
exec("/var/www/html/kh/pptpd_r $result[remote_from] $result[remote_end]");
exec("/var/www/html/kh/options_dns $result[DNS]");
exec("/var/www/html/kh/ppp_chap $result_u[id] $result_u[pw]");


mysql_close($conn);

flush(); sleep(1);
echo "<script> document.location.href='vpn_pptp.php';</script>";
?>
</body>
</html>
