<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}
?> 
﻿<!DOCTYPE html>
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
		<h1>Monitoring</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content" class="my-page">
		<center>
		<div id='divFrm' style='width:675px; height:640px; overflow-x:hidden; overflow-y:hidden;'>
		<?php
		echo "<iframe src='http://".$_SERVER['SERVER_NAME'].":8080' style='width:820px; height:800px;' scrolling='no' frameborder='0'></iframe>";
		?>
		</div>

		<?php
		echo "<br><br>PACKET LOG<br>";
		echo "<iframe src='http://".$_SERVER['SERVER_NAME']."/kh/monitor_packet_log.php' width='1400' height='200' frameborder='1' scrolling='no' onload='javascript_:fncSetTop();'></iframe>";

		echo "<br><br>HTTP ACCESS LOG<br>";
		echo "<iframe src='http://".$_SERVER['SERVER_NAME']."/kh/monitor_httpd_access_log.php' width='1400' height='200' frameborder='1' scrolling='no' onload='javascript_:fncSetTop();'></iframe>";

		echo "<br><br>HTTP ERROR LOG<br>";
		echo "<iframe src='http://".$_SERVER['SERVER_NAME']."/kh/monitor_httpd_error_log.php' width='1400' height='200' frameborder='1' scrolling='no' onload='javascript_:fncSetTop();'></iframe>";

		echo "<br><br>FTP LOG<br>";
		echo "<iframe src='http://".$_SERVER['SERVER_NAME']."/kh/monitor_xferlog_log.php' width='1400' height='100' frameborder='1' scrolling='no' onload='javascript_:fncSetTop();'></iframe>";

		echo "<br><br>SECURE LOG<br>";
		echo "<iframe src='http://".$_SERVER['SERVER_NAME']."/kh/monitor_secure_log.php' width='1400' height='100' frameborder='1' scrolling='no' onload='javascript_:fncSetTop();'></iframe>";
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
