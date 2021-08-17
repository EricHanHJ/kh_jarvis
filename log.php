<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--<meta charset="utf-8" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="js/jquery.mobile-1.4.5.css" />
	<link rel="stylesheet" href="panel-list.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<div data-role="page" id="index">

	<div data-role="header">
		<h1>Log</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<form method="GET" action="log.php">
			<div style="width: 100%;">
				<div style="float: left;">
				<select name="select_protocol" data-native-menu="false" data-mini="true">
					<option value="maillog_log">maillog</option>
					<option value="messages_log">messages</option>
					<option value="secure_log">secure</option>
					<option value="boot_log">boot.log</option>
					<option value="dmesg_log">dmesg</option>
					<option value="cron_log">cron</option>
					<option value="xferlog_log">xferlog</option>
					<option value="http_access_log">httpd_access_log</option>
					<option value="http_error_log">httpd_error_log</option>
				</select>
				</div>
				<div style="float: left;"><input type="text" name="datepic" value="<? echo date("m/d/Y"); ?>" data-mini="true"></div>
				<div style="float: left;"><input type="submit" value="search" data-mini="true"></div>
				<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#portInfo" data-rel="popup" data-transition="flip">Flip</a>
				<div id="portInfo" data-role="popup"><p>cf. mm/dd/yyyy</p></div>
			</div>
		</form>
		<br>
	<?php
		exec("./darkstat_start");
		## Get Selected Inf

		$day = $_GET['datepic'];
		$srvc = $_GET['select_protocol'];

		echo ("<div id='temp' style='padding-left: 7px;'>Time: $day / Log: $srvc</div>");
		
		## Divide Time in to Year, Month, Date
		$strTok = explode('/', $day);
		$year = $strTok[2];
		$month = $strTok[0];
		$date = $strTok[1];

		switch($month){
			case 01 : $month="Jan"; break;	
			case 02 : $month="Feb"; break;	
			case 03 : $month="Mar"; break;	
			case 04 : $month="Apr"; break;	
			case 05 : $month="May"; break;	
			case 06 : $month="Jun"; break;
			case 07 : $month="Jul"; break;	
			case 08 : $month="Aug"; break;	
			case 09 : $month="Sep"; break;	
			case 10 : $month="Oct"; break;	
			case 11 : $month="Nov"; break;	
			case 12 : $month="Dec"; break;	
			default : echo "error"; break;
		}	
		if(!strcmp($srvc, "dmesg_log")){
			$log_txt = shell_exec("cat /var/log/dmesg");
			echo "<pre>$log_txt</pre>";
		}
		else{
			## DB Connect And Select
			$conn = mysql_connect("localhost","root","qwer1234");
			mysql_select_db("Avengers");
				$sql = "select * from ".$srvc." where year='".$year."' and month='".$month."' and date='".$date."'";
				$return = mysql_query($sql);
			while($result=mysql_fetch_array($return)){
				echo "<br>";
				echo $result['year'];
				echo " ";
				echo $result['month'];
				echo " ";
				echo $result['date'];
				echo " ";
				echo $result['time'];
				echo " ";
				echo $result['msg'];
			}
		mysql_close($conn);
		}
        ?>
	</div><!-- /content -->

	<div data-role="footer">
		<h4 style="color: #bbbbbb;">Team Avengers. Project Jarvis</h4>
	</div><!-- /footer -->
	
	<div data-role="panel" id="left-panel" data-position="left" data-display="overlay" style="background-color: #f2f2f2;">
        <ul data-role="listview">
        	<li data-icon="delete" data-theme="b"><a href="#" data-rel="close">Close</a></li>
        	<li data-icon="back" data-theme="b"><a href="logout.php">Logout</a></li>
			<li data-role="list-divider">Menu</li>
			<li><a href="network.php">Network</a></li>
			<li><a href="router.php">Routing</a></li>
			<li data-role="collapsible" data-inset="false" data-iconpos="right">
				<h2>Firewall</h2>
				<ul data-role="listview">
					<li style="text-indent: 20px;"><a href="firewall.php">PacketFilter</a></li>
					<li style="text-indent: 20px;"><a href="firewall_web.php">WebFilter</a></li>
					<li data-role="collapsible" data-inset="false" data-iconpos="right">
					<h2 style="text-indent: 20px;">NAT</h2>
					<ul data-role="listview">
						<li style="text-indent: 40px;"><a href="firewall_snat.php">SNAT</a></li>
						<li style="text-indent: 40px;"><a href="firewall_dnat.php">DNAT</a></li>
						<li style="text-indent: 40px;"><a href="firewall_masquerade.php">MASQUERADE</a></li>
					</ul>
				</ul>
			</li>
			<li data-role="collapsible" data-inset="false" data-iconpos="right">
				<h2>VPN</h2>
				<ul data-role="listview">
					<li data-role="collapsible" data-inset="false" data-iconpos="right">
					<h2 style="text-indent: 20px;">PPTP</h2>
					<ul data-role="listview">
						<li style="text-indent: 40px;"><a href="vpn.php">PPTP USER</a></li>
						<li style="text-indent: 40px;"><a href="vpn_pptp.php">PPTP Setting</a></li>
					</ul>
					<li style="text-indent: 20px;"><a href="vpn_openvpn.php">OPEN VPN</a></li>
				</ul>
			</li>
			<li><a href="log.php">Log</a></li>
			<li><a href="monitoring.php">Monitoring</a></li>
		</ul>
    </div><!-- /panel -->

</div><!-- /page -->
</body>
</html>
