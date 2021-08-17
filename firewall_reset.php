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
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
exec("./firewall_reset"); ## iptables -Z -F 로 변경필요

$conn=mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
$sql = "DELETE FROM firewall;";
$result=mysql_query($sql);
$sql = "INSERT INTO firewall VALUES('INPUT','eth0','tcp','0.0.0.0','0','0.0.0.0','0','1:65535','80');";
$result=mysql_query($sql);
$sql = "INSERT INTO firewall VALUES('INPUT','eth0','tcp','0.0.0.0','0','0.0.0.0','0','1:65535','22');";
$result=mysql_query($sql);
$sql = "INSERT INTO firewall VALUES('OUTPUT','eth0','tcp','0.0.0.0','0','0.0.0.0','0','80','1:65535');";
$result=mysql_query($sql);
$sql = "INSERT INTO firewall VALUES('OUTPUT','eth0','tcp','0.0.0.0','0','0.0.0.0','0','22','1:65535');";
$result=mysql_query($sql);
$sql = "INSERT INTO firewall VALUES('INPUT','eth0','tcp','0.0.0.0','0','0.0.0.0','0','1:65535','80');";
$result=mysql_query($sql);
$sql = "INSERT INTO firewall VALUES('OUTPUT','eth0','tcp','0.0.0.0','0','0.0.0.0','0','8080','1:65535');";
$result=mysql_query($sql);


flush(); sleep(1);
echo "<script> document.location.href='firewall.php';</script>";
?>
</body>
</html>
