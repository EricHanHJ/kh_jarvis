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
<div data-role="page" id="vpn_pptp">

	<div data-role="header">
		<h1>PPTP VPN Setting</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">PPTP On / Off</div>
		<div class="ui-block-b"><img class="btn-img" src="icon/turnon.png" onclick="location.href='vpn_pptp_on.php'" title="on"></div>
		<div class="ui-block-c"><img class="btn-img" src="icon/turnoff.png" onclick="location.href='vpn_pptp_off.php'" title="off"></div>
		<div class="ui-block-d"> </div><div class="ui-block-e"> </div>
		</div>
		
		<form method="POST" action="vpn_pptp_insert.php">
			<fieldset data-role="controlgroup" data-type="horizontal">
				<select name="select_user" data-mini="true" data-native-menu="false">
					<option value="">User List</option>
					<?php
					$sql = "select id from vpn_u";
					$return = mysql_query($sql);
					while($result=mysql_fetch_array($return)){
						echo "<option value='".$result['id']."'>";
						echo $result['id'];
						echo "</option>";
					}
					?>
				</select>
			</fieldset>
		<br>	
		
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">Local IP</div>
		<div class="ui-block-b"><input name="lip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="lip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="lip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="lip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		<br>
		
		&nbsp;Remote IP
		<center>
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px; font-size:13px; text-align: right;">From</div>
		<div class="ui-block-b"><input name="rip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="rip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="rip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="rip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px; font-size:13px; text-align: right;">To</div>
		<div class="ui-block-b"><input name="rip5" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="rip6" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="rip7" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="rip8" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		</center>
		<br>
				
		<div class="ui-grid-d">
		<div class="ui-block-a" style="padding: 10px;">DNS</div>
		<div class="ui-block-b"><input name="dnsip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-c"><input name="dnsip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-d"><input name="dnsip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		<div class="ui-block-e"><input name="dnsip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
		</div><!-- /grid-d -->
		<br>

		<div class="ui-grid-d center">
		<div class="ui-block-a"> </div><div class="ui-block-b"> </div><div class="ui-block-c"> </div>
		<div class="ui-block-d"><input type="submit" value="Add" data-mini="true"></div>
		<div class="ui-block-e"><input type="reset" value="Reset" data-mini="true"></div>
		</div><!-- /grid-d -->
		</form>
		
		<br>
		
		<script>
		function sbmt(mode){
			if(mode == "active"){
				pptpTb.action = "vpn_pptp_active.php";
			} else if(mode == "delete"){
				pptpTb.action = "vpn_pptp_delete.php";
			}
			pptpTb.submit();
		}
		</SCRIPT>
		<form name="pptpTb" method="POST">
		<table class="ui-responsive table-stroke" id="table-column-toggle" data-role="table" >
			<thead>
				<tr>
					<th>USER ID</th>
					<th>Local IP</th>
					<th>Remote IP (from)</th>
					<th>Remote IP (to)</th>
					<th>DNS</th>
					<th style='width: 70px;'><input type="button" value="Active" data-mini="true" onClick="sbmt('active')"></th>
					<th style='width: 70px;'><input type="button" value="Delete" data-mini="true" onClick="sbmt('delete')"></th>
				</tr>
			</thead>
			
			<tbody>
				<?php
				$num = 0;
				$sql = "select * from pptp";
				$return = mysql_query($sql);
				while($result=mysql_fetch_array($return)){
					echo "<th>".$result['id']."</th>";
					echo "<input type='hidden' name='id".$num."' value='".$result['id']."'>";
					echo "<th>".$result['local']."</th>";
					echo "<input type='hidden' name='local".$num."' value='".$result['local']."'>";
					echo "<th>".$result['remote_from']."</th>";
					echo "<th>".$result['remote_to']."</th>";
					echo "<th>".$result['DNS']."</th>";
					echo "<th><input name='radio' type='radio' data-mini='true' value='".$num."'> </th>";
					echo "<th><input name='check".$num."' type='checkbox' data-mini='true'></th>";
					echo "</tr>";
					$num++;
				}
				?>
			</tbody>
		</table>
			<?php
			#echo $num;
			echo "<input type='hidden' name='nCR' value='".$num."'>"; # check box, radio button 개수
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
<html>
<?php
mysql_close($conn);
?>
