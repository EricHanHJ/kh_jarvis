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
	<!-- <meta charset="utf-8" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="js/jquery.mobile-1.4.5.css" />
	<link rel="stylesheet" href="panel-list.css">
	<script src="js/jquery-1.11.3.js"></script>
	<script src="js/jquery.mobile-1.4.5.js"></script>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<div data-role="page" id="vpn_setting">
	<div data-role="header">
		<h1>VPN Setting</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">메뉴</a>
		<a href="main.php" class='ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home' data-transition='slidedown'>홈</a>
	</div><!-- /header -->

	<div role="main" class="ui-content" class="my-page">
		<form name="openvpn" method="POST" action="vpn_openvpn_insert.php">
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">인원수</div>
		<div class="ui-block-b"><input type="text" name="num" maxlength="4" placeholder="인원수" size="5px" data-mini="true" data-clear-btn="true"></div>
		</div>
		
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">IP</div>
		<div class="ui-block-b"><input name="ip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="ip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="ip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="ip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->

		<!-- Netmask -->
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Netmask</div>
		<div class="ui-block-b"><input name="mask1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="mask2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="mask3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="mask4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">ID</div>
		<div class="ui-block-b"><input type="text" name="id" placeholder="아이디 입력" maxlength="20" size="30px" data-mini="true" data-clear-btn="true"></div>
		</div>
		
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Password</div>
		<div class="ui-block-b"><input type="password" name="pw" placeholder="비밀번호 입력" maxlength="20" size="30px" data-mini="true" data-clear-btn="true"></div>
		</div>
		
		<div class="ui-grid-d">
		<div class="ui-block-a"></div>
		<div class="ui-block-b"></div>
		<div class="ui-block-c"></div>
		<div class="ui-block-d"></div>
		<div class="ui-block-e"><input type="submit" value="Add" data-mini="true"></div>
		</div>
		</form>
		
	</div><!-- /content -->

	<div data-role="footer">
		<h4 style="color: #bbbbbb;">Hello</h4>
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
					<li><a href="firewall.php">PacketFilter</a></li>
					<li><a href="firewall_web.php">WebFilter</a></li>
					<li><a href="firewall_snat.php">SNAT</a></li>
					<li><a href="firewall_dnat.php">DNAT</a></li>
					<li><a href="firewall_masquerade.php">MASQUERADE</a></li>
				</ul>
			</li>
			<li data-role="collapsible" data-inset="false" data-iconpos="right">
				<h2>VPN</h2>
				<ul data-role="listview">
					<li><a href="vpn.php">User</a></li>
					<li><a href="vpn_pptp.php">pptp</a></li>
					<li><a href="vpn_openvpn.php">openvpn</a></li>
				</ul>
			</li>
			<li><a href="log.php">Log</a></li>
			<li><a href="monitoring.php">Monitoring</a></li>
		</ul>
    </div><!-- /panel -->

</div><!-- /page -->
</body>
</html>
