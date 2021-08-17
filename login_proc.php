<?php
session_start();

$id = $_POST['id'];
$pw = $_POST['pw'];

if(!$id) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
?>
<html>
<head></head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php
#echo "<pre>";
#print_r($_POST);
#echo "</pre>";

exec("./mysqld_restart");
$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");

$sql = "SELECT id, passwd FROM atbl WHERE id='$id' AND passwd='$pw'";
$return = mysql_query($sql);
$result = mysql_fetch_array($return);

if(!$result) {
	echo "<script>alert('아이디 또는 비밀번호가 옳지 않습니다.'); </script>";
	echo "<script> document.location.href='login.html'; </script>";
} else {
	session_start();
	$_SESSION['LoginID'] = $id;

	#echo print_r($_SESSION);

	flush(); sleep(0.5);
	echo "<script> document.location.href='main.php';</script>";
}

mysql_close();
?>
</body>
</html>
