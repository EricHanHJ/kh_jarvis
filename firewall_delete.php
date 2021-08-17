<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
$nCR = $_POST['nCR']; # 생성된 라디오버튼 개수
?>

<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
if($nCR) {
	$num = $_POST['radio'];
	
	$conn = mysql_connect("localhost","root","qwer1234");
	mysql_select_db("Avengers");

	$sql = "DELETE FROM firewall WHERE srcip='".$_POST['srcip'.$num]."'&&dstip='".$_POST['dstip'.$num]."'&&srcport='".$_POST['srcport'.$num]."'&&dstport='".$_POST['dstport'.$num]."'";
	$result = mysql_query($sql);

	mysql_close($conn);
}

flush(); sleep(0.5);
echo "<script> document.location.href='firewall.php';</script>";
?>
</body>
</html>
