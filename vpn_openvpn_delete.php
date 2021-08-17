<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
$nCR = $_POST['nCR']; # 생성된 체크박스 개수
$s = 0;
?>
<html>
<head></head>
<body>
<?php
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

if($nCR) {
	for($i = 0; $i <= $nCR; $i++) {
		$temp = 'check'.$i;		# on 상태인 체크박스 번호
		$temp2 = 'id'.$i;		# 체크박스 번호에 해당되는 id
		#echo $_POST[$temp]." ,".$_POST[$temp2]."<br>";
		if($_POST[$temp]=="on") {
			$s++;
			$sql = "DELETE FROM openvpn WHERE id='".$_POST[$temp2]."'";
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
echo "<script> document.location.href='vpn_openvpn.php';</script>";
?>
</body>
</html>
