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
<div data-role="page" id="fw_index">
	<div data-role="header">
		<h1>SNAT Setting</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<script>
		function sbmt(mode){
			if(mode == "add"){
				iptb.action = "firewall_snat_insert.php";
			} else if(mode == "delete"){
				iptb.action = "firewall_snat_delete.php";
			}
			iptb.submit();
		}
		</script>

		<!-- Data Transfer -->
		<form name="iptb" method="POST">
			<div class="ui-grid-d">
				<div class="ui-block-a" style="padding: 10px;">Internal IP</div>
				<div class="ui-block-b"><input name="inip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-c"><input name="inip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-d"><input name="inip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-e"><input name="inip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
			</div><!-- /grid-d -->

			<div class="ui-grid-d">
				<div class="ui-block-a" style="padding: 10px;">Internal Netmask</div>
				<div class="ui-block-b">
					<select name="inmask" data-mini="true" data-native-menu="false">
						<option value="">Netmask</option>
						<option value="0">&nbsp;&nbsp;0&nbsp;&nbsp;</option>
						<option value="8">&nbsp;&nbsp;8&nbsp;&nbsp;</option>
						<option value="16">&nbsp;&nbsp;16&nbsp;&nbsp;</option>
						<option value="24">&nbsp;&nbsp;24&nbsp;&nbsp;</option>
						<option value="32">&nbsp;&nbsp;32&nbsp;&nbsp;</option>
					</select>
				</div><!-- /block-b -->
			</div><!-- /grid-d -->

			<div class="ui-grid-d">
				<div class="ui-block-a" style="padding: 10px;">External Interface</div>
				<div class="ui-block-b">
					<select name="exinf" data-mini="true" data-native-menu="false" >
						<option value="">Interface</option>
						<option value="eth0">eth0</option>
						<option value="eth1">eth1</option>
					</select>
				</div>
			</div><!-- /grid-d -->

			<div class="ui-grid-d">
				<div class="ui-block-a" style="padding: 10px;">External IP</div>
				<div class="ui-block-b"><input name="exip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-b"><input name="exip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-c"><input name="exip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-d"><input name="exip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
			</div><!-- /grid-d -->	
			
			<div class="ui-grid-d">
				<div class="ui-block-a"> </div><div class="ui-block-b"> </div><div class="ui-block-c"> </div>
				<div class="ui-block-d"><input type="button" value="Add" data-mini="true" onClick="sbmt('add')"></div>
				<div class="ui-block-e"><input type="button" value="Delete" data-mini="true" onClick="sbmt('delete')"></div>
			</div><!-- /grid-d -->
		</form>
		<br>

		<table class="ui-responsive table-stroke" id="table-column-toggle" data-role="table" >
			<thead>
				<tr>
					<th>NAT</th>
					<th>Internal IP</th>
					<th>Internal Netmask</th>
					<th>External IP</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$conn = mysql_connect("localhost","root","qwer1234");
				mysql_select_db("Avengers");

				$sql = "select * from firewall_snat";
				$return = mysql_query($sql);

				while($result=mysql_fetch_array($return)){
					echo "<tr>";
					echo "<th>".$result['nat']."</th>";
					echo "<th>".$result['inip']."</th>";
					echo "<th>".$result['inmask']."</th>";
					echo "<th>".$result['exinf']."</th>";
					echo "<th>".$result['exip']."</th>";
					echo "</tr>";
				}
				mysql_close($conn);
				?>
			</tbody>
		</table>

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
