<!DOCTYPE html>
<html>
<head>
        <!--<meta charset="utf-8" />-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="jquery.mobile-1.4.5.css" />
        <link rel="stylesheet" href="panel-list.css">
        <link rel="stylesheet" href="test.css">

        <script src="jquery-1.11.3.js"></script>
        <script src="jquery.mobile-1.4.5.js"></script>
</head>
<body>
<div data-role="page" id="index">
        <div data-role="header">
                <h1>DashBoard</h1>
                <a href="#left-panel" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-bars">메뉴</a>
                <a href="index.php" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-right ui-icon-home" data-transition="slidedown">홈</a>
        </div><!-- /header -->

        <div role="main" class="ui-content" class="my-page">



	<?php

                echo "<br><br>PS<br>";
                echo "<iframe src='http://".$_SERVER['SERVER_NAME']."/kh/dashboard_ps.php' width='1400' height='2000' frameborder='1' scrolling='no' onload='javascript_:fncSetTop();'></iframe>";
		echo "<br>";
		
		$srv_status;
		chk_srv(vsftpd);
		chk_srv(sshd);
		chk_srv(iptables);
		chk_srv(crond);
		chk_srv(httpd);
		chk_srv(openvpn);


		function chk_srv($srv){
			exec("/var/www/html/kh/chk_srv $srv");
			exec("/var/www/html/kh/chk_srv.py", $output, $return_var);
			echo $srv;
			echo '-';
			echo $output[0];
			echo "<br>";
			GLOBAL $srv_status;
			if ($output[0] == "run")	$srv_status="1";
			else				$srv_status="0";
		}
	?>
	</div>

	</div>


        </div><!-- /content -->

        <div data-role="footer">
                <h4 style="color: #bbbbbb;">Hello</h4>
        </div><!-- /footer -->

        <div data-role="panel" id="left-panel" data-position="left" data-display="overlay" style="background-color: #f2f2f2;">
        <ul data-role="listview">
                <li data-icon="delete" data-theme="b"><a href="#" data-rel="close">Close</a></li>
                <li data-icon="back" data-theme="b"><a href="#" data-rel="back">Back</a></li>
                        <li data-role="list-divider">Menu</li>
                        <li><a href="network.php">Network</a></li>
                        <li><a href="router.php">Routing</a></li>
                        <li><a href="firewall.php">Firewall</a></li>
                        <li data-role="collapsible" data-inset="false" data-iconpos="right">
                                <h2>VPN</h2>
                                <ul data-role="listview">
                                        <li><a href="vpn.php">User</a></li>
                                        <li><a href="vpn_pptp.php">pptp</a></li>
                                </ul>
                        </li>
                        <li><a href="log.php">Log</a></li>
                        <li><a href="monitoring.php">Monitoring</a></li>
                </ul>
    </div><!-- /panel -->

</div><!-- /page -->
</body>
</html>

