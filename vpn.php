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
	<!--<meta charset="utf-8" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="js/jquery.mobile-1.4.5.css" />
	<link rel="stylesheet" href="panel-list.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<div data-role="page" id="vpn_index">

	<div data-role="header">
		<h1>PPTP VPN User</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<form name="userDel" method="POST" action="vpn_delete.php">
		<table class="ui-responsive table-stroke" id="table-column-toggle" style="width: 60%" data-role="table" align="center">
			<thead>
				<tr>
					<th>User ID</th>
					<th>Type</th>
					<th width='100px'>
					<?php 
					$sql = "select * from vpn_u";
					$return = mysql_query($sql);
					$result = mysql_fetch_array($return);
					
					if(!$result) {
						echo "<input disabled='' type='submit' value='Delete' data-mini='true'>";
					} else {
						echo "<input type='submit' value='Delete' data-mini='true'>";
					}
					?>
					</th>
				</tr>
			</thead>
		
			<tbody>
				<?php
				$num = 0;
				$sql = "select * from vpn_u";
				$return = mysql_query($sql);
				while($result=mysql_fetch_array($return)){
					echo "<tr style='text-align: center;'>";
					echo "<th>".$result['id']."</th>";
					echo "<input type='hidden' name='id".$num."' value='".$result['id']."'>";
					echo "<th>".$result['vpntype']."</th>";
					echo "<th style='width: 100px;'><input name='check".$num."' type='checkbox' data-mini='true'></th>";
					echo "</tr>";
					$num++;
				}
				?>
			</tbody>
		</table>
			<?php
			$num;
			echo "<input type='hidden' name='nCheck' value='".$num."'>";
			?>
		</form>
		<br>
		<div class="ui-body ui-body-b ui-corner-all"> User Add </div>
			<!-- 사용자 추가 -->
		<div class="ui-body ui-body-a ui-corner-all">
			<form name="useradd" method="POST" action="vpn_insert.php">
			<div class="ui-grid-b">
				<div class="ui-block-a"><input name="id" type="text" placeholder="User ID" data-mini="true"></div>
				<div class="ui-block-b"><input name="pw" type="password" placeholder="Password" data-mini="true"></div>
				<div class="ui-block-c"><select name="select_vpn" data-mini="true" data-native-menu="false" >
					<option value="">-- Select VPN --</option>
					<option value="pptp">pptp</option>
				</select></div>
			</div>
			<div class="ui-grid-d">
				<div class="ui-block-a"> </div><div class="ui-block-b"> </div><div class="ui-block-c"> </div>
				<div class="ui-block-d"><input type="submit" value="Add" data-mini="true"></div>
				<div class="ui-block-e"><input type="reset" value="Delete" data-mini="true"></div>
			</form>
			</div>
		</div>
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
<?php
mysql_close($conn);
?>
