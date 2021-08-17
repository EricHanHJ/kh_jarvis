<?php
session_start();

if(!$_SESSION['LoginID']) {
	echo "<script>alert('로그인이 필요한 서비스입니다.'); </script>";
	echo "<script> document.location.href='http://".$_SERVER['SERVER_NAME']."/kh';</script>";
	exit;
} else {
	$conn = mysql_connect("localhost","root","qwer1234");
	mysql_select_db("Avengers");
}

#### 패킷 필터 사용 여부를 DB에 저장하여 사용한다.
#### DB에 저장된 필터링 사용 여부를 확인하기 위한 작업
$id = $_SESSION['LoginID'];
$sql = "SELECT id FROM filter WHERE id='$id'";
$return = mysql_query($sql);
$result = mysql_fetch_array($return);

#### 로그인된 아이디에 대한 튜플(행)이 없다면 새로 생성한다.
if(!$result) {
	$sql = "INSERT INTO filter VALUES('$id', '0', '0', '0', '0', '0');";
	$result = mysql_query($sql);
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
		<h1>Packet Filtering</h1>
		<a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">Menu</a>
		<a href="main.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">Home</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<div class="ui-grid-b">
			<div class="ui-block-a"><button onClick="location.replace('firewall_reset.php')" class="ui-btn ui-corner-all ui-shadow ui-mini" style="width: 150px;">RESET Rules</button></div>
			<div class="ui-block-b">&nbsp;&nbsp;<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#reset_info" data-rel="popup" data-transition="flip">Flip</a></div>
		</div>
			<div id="reset_info" data-role="popup">
				<pre>
------------------------------------- INITIAL SET -----------------------------------------

Chain INPUT (policy DROP)
target     prot opt source               destination
ACCEPT     all  --  anywhere             anywhere	     lo
ACCEPT     all  --  anywhere             anywhere            state RELATED,ESTABLISHED
DROP       all  --  anywhere             anywhere            state INVALID
ACCEPT     tcp  --  anywhere             anywhere            tcp spt:1:65535 dpt:ssh
ACCEPT     tcp  --  anywhere             anywhere            tcp spt:1:65535 dpt:http
ACCEPT     tcp  --  anywhere             anywhere            tcp spt:1:65535 dpt:webcache

Chain FORWARD (policy ACCEPT)
target     prot opt source               destination

Chain OUTPUT (policy DROP)
target     prot opt source               destination
ACCEPT     tcp  --  anywhere             anywhere            tcp spt:ssh dpt:1:65535
ACCEPT     tcp  --  anywhere             anywhere            tcp spt:http dpt:1:65535
ACCEPT     tcp  --  anywhere             anywhere            tcp spt:webcache dpt:1:65535

-------------------------------------------------------------------------------------------
				</pre>
			</div><!-- div reset_info -->

		<script>
		function tcpMov() {
			location.replace("firewall_tcpchk.php");
		}
		</script>
		
		<div class="ui-grid-b">
			<div class="ui-block-a">
			<?php
			$sql = "SELECT tcp FROM filter WHERE id='$id'";
			$return = mysql_query($sql);
			$result = mysql_fetch_array($return);
			
			if($result['tcp'] == 1) {
				echo "<input id='tcpfiter' type='checkbox' onclick='tcpMov()' data-mini='true' checked><label for='tcpfiter'>Abnormal TCP-Flags Block</label>";
			} else {
				echo "<input id='tcpfiter' type='checkbox' onclick='tcpMov()' data-mini='true'><label for='tcpfiter'>Abnormal TCP-Flags Block</label>";
			}
			?>
			</div>
			&nbsp;&nbsp;
			<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#tcpchk_Info" data-rel="popup" data-transition="flip">Flip</a>
			<div id="tcpchk_Info" data-role="popup">
				<pre>
----------------------------------------------- ADD BELOW -----------------------------------------------------

Chain INPUT (policy DROP)
target     prot opt source               destination
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,SYN
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,PSH
DROP       tcp  --  anywhere             anywhere            tcp flags:!FIN,SYN,RST,ACK/SYN state NEW
DROP       tcp  --  anywhere             anywhere            tcp flags:!SYN,RST,ACK/SYN state NEW
DROP       tcp  --  anywhere             anywhere            tcp flags:!FIN,SYN,RST,PSH,ACK,URG/SYN state NEW

---------------------------------------------------------------------------------------------------------------
				</pre>
			</div>
		</div>
		
		<script>
		function nmapMov() {
			location.replace("firewall_nmapchk.php");
		}
		function httpMov() {
			location.replace("firewall_httpchk.php");
		}
		</script>
		
		<div class="ui-grid-b">
			<div class="ui-block-a">
			<?php
			$sql = "SELECT nmap FROM filter WHERE id='$id'";
			$return = mysql_query($sql);
			$result = mysql_fetch_array($return);
			
			if($result['nmap'] == 1) {
				echo "<input id='nmapfiter' type='checkbox' onclick='nmapMov()' data-mini='true' checked><label for='nmapfiter'>nmap Protect</label>";
			} else {
				echo "<input id='nmapfiter' type='checkbox' onclick='nmapMov()' data-mini='true'><label for='nmapfiter'>nmap Protect</label>";
			}
			?>
			</div>
			<div class="ui-block-b">&nbsp;&nbsp;<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#nmapchk_info" data-rel="popup" data-transition="flip">Flip</a></div>
			<div id="nmapchk_info" data-role="popup">
				<pre>
--------------------------------------------------- ADD BELOW ---------------------------------------------------------

Chain INPUT (policy DROP)
target     prot opt source               destination
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,ACK/FIN
DROP       tcp  --  anywhere             anywhere            tcp flags:PSH,ACK/PSH
DROP       tcp  --  anywhere             anywhere            tcp flags:ACK,URG/URG
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,SYN,RST,PSH,ACK,URG
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/NONE
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,SYN,RST,ACK,URG
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN/FIN,SYN
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,RST/FIN,RST
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,SYN
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,PSH,URG
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN
DROP       tcp  --  anywhere             anywhere            tcp flags:FIN,SYN,RST,PSH,ACK,URG/FIN,SYN,PSH,URG
DROP       tcp  --  anywhere             anywhere            tcp flags:SYN,RST/SYN,RST

-----------------------------------------------------------------------------------------------------------------------
				</pre>
			</div>
		</div>
			
		<div class="ui-grid-b">
			<div class="ui-block-a">
				<?php
                $sql = "SELECT http FROM filter WHERE id='$id'";
				$return = mysql_query($sql);
				$result = mysql_fetch_array($return);
			
				if($result['http'] == 1) {
					echo "<input id='httpfiter' type='checkbox' onclick='httpMov()' data-mini='true' checked><label for='httpfiter'>http Protect</label>";
				} else {
					echo "<input id='httpfiter' type='checkbox' onclick='httpMov()' data-mini='true'><label for='httpfiter'>http Protect</label>";
				}
				?>
			</div>
			<div class="ui-block-d">&nbsp;&nbsp;<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#httpchk_info" data-rel="popup" data-transition="flip">Flip</a></div>
			<div id="httpchk_info" data-role="popup">
				<pre>
------------------------------------------------------------- ADD BELOW -------------------------------------------------------------------

Chain INPUT (policy DROP)
target     prot opt source               destination
DROP       tcp  --  anywhere             anywhere            tcp dpt:http recent: UPDATE seconds: 1 hit_count: 15 name: HTTP side: source

-------------------------------------------------------------------------------------------------------------------------------------------
				</pre>
			</div>
		</div>

		<script>
		function icmpMov() {
			location.replace("firewall_icmpchk.php");
		}
		function dosMov() {
			location.replace("firewall_doschk.php");
		}
		</script>
		
		<div class="ui-grid-b">
			<div class="ui-block-a">
				<?php
				$sql = "SELECT icmp FROM filter WHERE id='$id'";
				$return = mysql_query($sql);
				$result = mysql_fetch_array($return);
			
				if($result['icmp'] == 1) {
					echo "<input id='icmpfiter' type='checkbox' onclick='icmpMov()' data-mini='true' checked><label for='icmpfiter'>icmp Protect</label>";
				} else {
					echo "<input id='icmpfiter' type='checkbox' onclick='icmpMov()' data-mini='true'><label for='icmpfiter'>icmp Protect</label>";
				}
				?>
			</div>
			<div class="ui-block-b">&nbsp;&nbsp;<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#icmpchk_info" data-rel="popup" data-transition="flip">Flip</a></div>
			<div id="icmpchk_info" data-role="popup">
				<pre>
------------------------------- ADD BELOW -------------------------------------

Chain INPUT (policy DROP)
target     prot opt source               destination
ICMP       icmp --  anywhere             anywhere


Chain ICMP (1 references)
target     prot opt source               destination
DROP       icmp --  anywhere             anywhere            icmp echo-request

-------------------------------------------------------------------------------
				</pre>
			</div>
		</div>
		<div class="ui-grid-b">
			<div class="ui-block-a">
 				<?php
				$sql = "SELECT dos FROM filter WHERE id='$id'";
				$return = mysql_query($sql);
				$result = mysql_fetch_array($return);
			
				if($result['dos'] == 1) {
					echo "<input id='dosfiter' type='checkbox' onclick='dosMov()' data-mini='true' checked><label for='dosfiter'>dos Protect</label>";
				} else {
					echo "<input id='dosfiter' type='checkbox' onclick='dosMov()' data-mini='true'><label for='dosfiter'>dos Protect</label>";
				}
				?>
			</div>
			<div class="ui-block-d">&nbsp;&nbsp;<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#doschk_info" data-rel="popup" data-transition="flip">Flip</a></div>
			<div id="doschk_info" data-role="popup">
				<pre>
-------------------------------------- ADD BELOW ----------------------------------------

Chain INPUT (policy DROP)
target     prot opt source               destination
DROP       tcp  --  anywhere             anywhere            limit: avg 10/sec burst 5
DROP       tcp  --  anywhere             anywhere            limit: avg 100/min burst 10

-----------------------------------------------------------------------------------------
				</pre>
			</div>
		</div>

		<br>

		<form name="iptb" method="POST" action="firewall_insert.php">
			<h3 class="ui-bar ui-bar-a ui-corner-all">
				<div class="ui-grid-b">
				<div class="ui-block-a"><select name="select_inf" data-mini="true" data-native-menu="false" >
					<option value="">Interface</option>
					<option value="eth0">eth0</option>
					<option value="eth1">eth1</option>
				</select></div>
				<div class="ui-block-b"><select name="select_chain" data-mini="true" data-native-menu="false" >
					<option value="">Input / Output</option>
					<option value="INPUT">Input</option>
					<option value="OUTPUT">Output</option>
				</select></div>
				<div class="ui-block-c"><select name="select_proto" data-mini="true" data-native-menu="false" >
					<option value="">Protocol</option>
					<option value="all">ALL</option>
					<option value="tcp">TCP</option>
					<option value="udp">UDP</option>
					<option value="icmp">ICMP</option>
				</select></div>
				</div><!-- /grid-b -->
			</h3>
			
			<div class="ui-body">
				<div class="ui-grid-d">
					<div class="ui-block-a">&nbsp;&nbsp;Allow Src IP</div>
					<div class="ui-block-b"> </div> <div class="ui-block-c"> </div> <div class="ui-block-d"> </div>
					<div class="ui-block-e" style="text-align: center;">Netmask</div>
				</div><!-- /grid-d -->
		
				<div class="ui-grid-d">
					<div class="ui-block-a"><input name="ip1" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
					<div class="ui-block-b"><input name="ip2" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
					<div class="ui-block-c"><input name="ip3" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
					<div class="ui-block-d"><input name="ip4" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
					<div class="ui-block-e" style="text-align: center;">
						<fieldset data-role="controlgroup" data-type="horizontal">
							<select name="select_srcmask" data-mini="true" data-native-menu="false">
								<option value="0">&nbsp;&nbsp;0&nbsp;&nbsp;</option>
								<option value="8">&nbsp;&nbsp;8&nbsp;&nbsp;</option>
								<option value="16">&nbsp;&nbsp;16&nbsp;&nbsp;</option>
								<option value="24">&nbsp;&nbsp;24&nbsp;&nbsp;</option>
								<option value="32">&nbsp;&nbsp;32&nbsp;&nbsp;</option>
							</select>
						</fieldset>
					</div><!-- /block-e -->
				</div><!-- /grid-d -->
			
				<div class="ui-grid-d">
					<div class="ui-block-a"> </div><div class="ui-block-b"> </div>
					<div class="ui-block-c" style="text-align: right; padding: 13px;">Src Port</div>
					<div class="ui-block-d"><input name="srcport" type="text" maxlength="11" data-mini="true" data-clear-btn="true"></div>
					<div class="ui-block-e" style="text-align: left;">
						<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#portInfo" data-rel="popup" data-transition="flip">Flip</a>
						<div id="portInfo" data-role="popup"><p>Port Num or Range. cf. 1:65535</p></div>
					</div>
				</div><!-- /grid-d -->

			<br>
			
			<div class="ui-grid-d">
				<div class="ui-block-a">&nbsp;&nbsp;Allow Dst IP</div>
				<div class="ui-block-b"> </div> <div class="ui-block-c"> </div> <div class="ui-block-d"> </div>
				<div class="ui-block-e" style="text-align: center;">Netmask</div>
			</div><!-- /grid-d -->
		
			<div class="ui-grid-d">
				<div class="ui-block-a"><input name="ip5" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-b"><input name="ip6" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-c"><input name="ip7" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-d"><input name="ip8" type="text" maxlength="3" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-e" style="text-align: center;">
					<fieldset data-role="controlgroup" data-type="horizontal">
						<select name="select_dstmask" data-mini="true" data-native-menu="false">
							<option value="0">&nbsp;&nbsp;0&nbsp;&nbsp;</option>
							<option value="8">&nbsp;&nbsp;8&nbsp;&nbsp;</option>
							<option value="24">&nbsp;&nbsp;24&nbsp;&nbsp;</option>
							<option value="32">&nbsp;&nbsp;32&nbsp;&nbsp;</option>
						</select>
					</fieldset>
				</div><!-- /block-e -->
			</div><!-- /grid-d -->
			
			<div class="ui-grid-d">
				<div class="ui-block-a"> </div><div class="ui-block-b"> </div>
				<div class="ui-block-c" style="text-align: right; padding: 13px;">Dst Port</div>
				<div class="ui-block-d"><input name="dstport" type="text" maxlength="13" data-mini="true" data-clear-btn="true"></div>
				<div class="ui-block-e" style="text-align: left;">
					<a class="ui-shadow ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-inline" href="#portInfo" data-rel="popup" data-transition="flip">Flip</a>
					<div id="portInfo" data-role="popup"><p>Port Num or Range. cf. 1:65535</p></div>
				</div>
			</div><!-- /grid-d -->

			<br>
			
			<div class="ui-grid-d">
				<div class="ui-block-a"> </div><div class="ui-block-b"> </div><div class="ui-block-c"> </div><div class="ui-block-d"> </div>
				<div class="ui-block-e"><input type="submit" value="Add" data-mini="true"></div>
			</div><!-- /grid-d -->
		</form>
			<br>
			<form name="fw_del" method="POST" action="firewall_delete.php">
			<li data-role="collapsible" data-inset="false" data-iconpos="right" style="background-color: #f9f9f9;">
			<h2>INPUT</h2>
				<ul data-role="listview">
				<table class="ui-responsive table-stroke" id="table-column-toggle" data-role="table" >
				<thead>
					<tr>
						<th>Interface</th>
						<th>Protocol</th>
						<th>SrcIP</th>
						<th>SrcPort</th>
						<th>DstIP</th>
						<th>DstPort</th>
						<th width='10px'>
						<?php 
						$sql = "select * from firewall";
						$return = mysql_query($sql);
						$result = mysql_fetch_array($return);
						
						if(!$result) {
							echo "<input disabled='' type='submit' value='Delete' data-mini='true' style='font-size: 10px;'>";
						} else {
							echo "<input type='submit' value='Delete' data-mini='true' style='font-size: 10px;'>";
						}
						?></th>
					</tr>
				</thead>
			
				<tbody>
					<?php
					$num = 0;
					$sql = "select * from firewall WHERE chain='INPUT'";
					$return = mysql_query($sql);
					while($result=mysql_fetch_array($return)){
						echo "<tr>";
						echo "<th>".$result['interface']."</th>";
						echo "<th>".$result['protocol']."</th>";
						echo "<th>".$result['srcip']."/".$result['srcnetmask']."</th>";
						echo "<input type='hidden' name='srcip".$num."' value='".$result['srcip']."'>";
						echo "<th>".$result['srcport']."</th>";
						echo "<input type='hidden' name='srcport".$num."' value='".$result['srcport']."'>";
						echo "<th>".$result['dstip']."/".$result['dstnetmask']."</th>";
						echo "<input type='hidden' name='dstip".$num."' value='".$result['dstip']."'>";
						echo "<th>".$result['dstport']."</th>";
						echo "<input type='hidden' name='dstport".$num."' value='".$result['dstport']."'>";
						echo "<th><input name='radio' type='radio' data-mini='true' value='".$num."'></th>";
						echo "</tr>";
					}
					
					mysql_close($conn);
					?>
				</tbody>
			</table>
			<?php
			$num;
			echo "<input type='hidden' name='nCheck' value='".$num."'>";
			?>
				</ul>
			</li>
			</form>
		
		</div><!-- /body-a -->

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
