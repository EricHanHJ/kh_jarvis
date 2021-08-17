<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
}

$conn = mysql_connect("localhost","root","qwer1234");
mysql_select_db("Avengers");
?>

<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="utf-8" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="js/jquery.mobile-1.4.5.css" />
	<link rel="stylesheet" href="panel-list.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<div data-role="page" id="vpn_setting">
	<div data-role="header">
		<h1>Open VPN User & Setting</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class='ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home' data-transition='slidedown'>Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content" class="my-page">
		<form name="openvpn" method="POST" action="vpn_openvpn_insert.php">
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Capacity</div>
		<div class="ui-block-b"><input type="text" name="num" maxlength="4" placeholder="The Number of Clients" size="5px" data-mini="true" data-clear-btn="true"></div>
		</div>
		
		<h3 class="ui-bar ui-bar-a ui-corner-all">서버 내부 IP 대역대</h3>
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">IP</div>
		<div class="ui-block-b"><input name="inip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="inip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="inip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="inip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		
		<!-- Netmask -->
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Netmask</div>
		<div class="ui-block-b"><input name="inmask1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="inmask2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="inmask3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="inmask4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		
		<h3 class="ui-bar ui-bar-a ui-corner-all">클라이언트 내부 IP 대역대</h3>
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">IP</div>
		<div class="ui-block-b"><input name="cip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="cip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="cip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="cip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		
		<!-- Netmask -->
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Netmask</div>
		<div class="ui-block-b"><input name="cmask1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="cmask2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="cmask3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="cmask4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		
		<h3 class="ui-bar ui-bar-a ui-corner-all">VPN Subnet</h3>
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
		<div class="ui-block-b"><input type="text" name="id" placeholder="User ID" maxlength="20" size="30px" data-mini="true" data-clear-btn="true"></div>
		</div>
		
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Password</div>
		<div class="ui-block-b"><input type="password" name="pw" placeholder="Password" maxlength="20" size="30px" data-mini="true" data-clear-btn="true"></div>
		</div>
		
		<div class="ui-grid-d">
		<div class="ui-block-a"></div>
		<div class="ui-block-b"></div>
		<div class="ui-block-c"></div>
		<div class="ui-block-d"></div>
		<div class="ui-block-e"><input type="submit" value="Add" data-mini="true"></div>
		</div>
		</form>
	<br>
	
	<script>
	function sbmt(mode){
	if(mode == 'active'){
		openvpnTb.action = "vpn_openvpn_active.php";
		}
		else if(mode == 'delete'){
			openvpnTb.action = "vpn_openvpn_delete.php";
			}
		openvpnTb.submit();
	}		
	</SCRIPT>
	<form name="openvpnTb" method="POST">
	<table class="ui-responsive table-stroke" id = "table-column-toggle" data-role="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>IP</th>
				<th>NETMASK</th>
				<th>Capacity</th>
				<th style='width: 70px;'><input type="button" value="Active" data-mini="true" onClick="sbmt('active')"></th>
				<th style='width: 70px;'><input type="button" value="Delete" data-mini="true" onClick="sbmt('delete')"></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$num = 0;
		$sql = "SELECT * FROM openvpn";
		$query=mysql_query($sql);
		while($result=mysql_fetch_array($query)){
			echo "<th>".$result['id']."</th>";
			echo "<input type='hidden' name='id".$num."' value='".$result['id']."'>";
			echo "<th>".$result['ip']."</th>";
			echo "<th>".$result['netmask']."</th>";
			echo "<th>".$result['nop']."</th>";
			echo "<th><input name='radio' type='radio' data-mini='true' value='".$num."'></th>";
			echo "<th><input name='check".$num."' type='checkbox' data-mini='true'></th>";
			echo "</tr>";
			$num++;
		
			}
		?>
		</tbody>
	</table>
		<?php
			echo "<input type='hidden' name='nCR' value='".$num."'>";
		?>

	</form>	
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
