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
$nCheck = $_POST['nCheck']; # 체크박스 개수
$s = 0;
?>
<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

if($nCheck) {
	for($i = 0; $i <= $nCheck; $i++) {
		$temp = 'check'.$i;
		$temp2 = 'id'.$i;
		# echo $_POST[$temp]." ,".$_POST[$temp2]."<br>";
		if($_POST[$temp]=="on") {
			$s++;
			$sql = "DELETE FROM vpn_u WHERE id='".$_POST[$temp2]."'";
			$result = mysql_query($sql);
			if($result) {
				$_SESSION['dbResult'] = "1"; # 삭제 성공
			} else {
				$_SESSION['dbResult'] = "0"; # 삭제 실패
			}
		}
	}
}


$nSleep = $s * 0.5;
mysql_close($conn);

flush(); sleep($nSleep);
echo "<script> document.location.href='vpn.php';</script>";
?>
</body>
</html>
