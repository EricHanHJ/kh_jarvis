﻿<?php
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
$id = $_SESSION['LoginID'];

$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

$sql = "SELECT dos FROM filter WHERE id='$id'";
$return = mysql_query($sql);
$result = mysql_fetch_array($return);

if($result['dos'] == 0)  {
	exec("./firewalldos");
	$sql = "UPDATE filter SET dos='1' WHERE id='$id'";
	$result = mysql_query($sql);
} else if($result['dos'] == 1) {
	exec("./firewallnodos");
	$sql = "UPDATE filter SET dos='0' WHERE id='$id'";
	$result = mysql_query($sql);
} else {
	$sql = "UPDATE filter SET dos='0' WHERE id='$id'";
	$result = mysql_query($sql);
}
mysql_close($conn);
flush(); sleep(1);
echo "<script> document.location.href='firewall.php';</script>";
?>
</body>
</html>
