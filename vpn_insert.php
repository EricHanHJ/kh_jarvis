<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$id = $_POST['id'];
$pw = $_POST['pw'];
$vpntype = $_POST['select_vpn'];
?>
<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

$sql = "INSERT INTO vpn_u VALUES('".$id."','".$pw."','".$vpntype."')";
$result = mysql_query($sql);

if($result) {
	$_SESSION['dbResult'] = "1"; # 등록 성공
}	else {
	$_SESSION['dbResult'] = "0"; # 등록 실패
}
mysql_close($conn);

flush(); sleep(1);
echo "<script> document.location.href='vpn.php';</script>";
?>
</body>
</html>
