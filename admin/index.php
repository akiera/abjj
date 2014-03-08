<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['staff_ic'] = $record1["user_ic"];

$query2= mysql_query("SELECT * FROM t_staff WHERE staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record1["user_ic"];

$nama = $_SESSION['username'];
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date('d/m/Y h:i:s a', time());
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>ABJJ Techno Solution</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/layout.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/themes.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/typography.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/shCore.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/data-table.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/form.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/wizard.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/sprite.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/gradient.css" rel="stylesheet" type="text/css" media="screen">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script><script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
</script>
</head>
<body id="theme-default" class="full_block">
<div id="left_bar">
	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">
				<li><a href="?p=home"><span class="nav_icon computer_imac"></span> Home Page</a>				</li>
			  <li><a href="#"><span class="nav_icon frames"></span> Management</span><span class="up_down_arrow">&nbsp;</span></a>
<ul class="acitem">
					<li><a href="?p=staff_list"><span class="list-icon">&nbsp;</span>Staff</a></li>
					<li><a href="?p=snarai_cawangan"><span class="list-icon">&nbsp;</span>Minimart</a></li>
					<li><a href="?p=snarai_pembekal"><span class="list-icon">&nbsp;</span>Supplier</a></li>
				</ul>
				</li>
				<li><a href="#"><span class="nav_icon documents"></span>Purchase</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="?p=purchase"><span class="list-icon">&nbsp;</span>New Purchase</a></li>
					<li><a href="?p=list_purchase"><span class="list-icon">&nbsp;</span>Purchase List</a></li>
                </ul>
				</li>
				<li><a href="#"><span class="nav_icon frames"></span>Payment</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="?p=new_payment"><span class="list-icon">&nbsp;</span>New Payment</a></li>
   					<li><a href="?p=list_payment"><span class="list-icon">&nbsp;</span>Payment List</a></li>
				</ul>
				</li>
                <li><a href="#"><span class="nav_icon frames"></span>Daily Report</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="?p=daily_report"><span class="list-icon">&nbsp;</span>New Daily Report</a></li>
					<li><a href="?p=list_daily_report"><span class="list-icon">&nbsp;</span>Daily Report List</a></li>
				</ul>
				</li>
				<li><a href="#"><span class="nav_icon bulls_eye"></span>Manager Page</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="?p=bank_in"><span class="list-icon">&nbsp;</span>Bank In</a></li>
					<li><a href="?p=list_bankin"><span class="list-icon">&nbsp;</span>Bank In List</a></li>
					<li><a href="?p=cash_book"><span class="list-icon">&nbsp;</span>Cash Book</a></li>								<li><a href="?p=list_cashbook"><span class="list-icon">&nbsp;</span>Cash Book List</a></li>
					<li><a href="?p=topup_transfer"><span class="list-icon">&nbsp;</span>Topup Transfer</a></li>
                    <li><a href="?p=list_topup"><span class="list-icon">&nbsp;</span>Topup Transfer List</a></li>
                    <li><a href="?p=salary"><span class="list-icon">&nbsp;</span>Staff Salary</a></li>
                    <li><a href="?p=list_salary"><span class="list-icon">&nbsp;</span>Staff Salary List</a></li>
				</ul>
				</li>
                <li><a href="#" target="_blank"><span class="nav_icon money_2"></span>Report</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="?p=kategori_purchase"><span class="list-icon">&nbsp;</span>Purchase Report</a></li>
					<li><a href="?p=category_daily_report"><span class="list-icon">&nbsp;</span>Daily Report</a></li>
   					<li><a href="?p=list_cashbook"><span class="list-icon">&nbsp;</span>Cash Book Report</a></li>
                    <li><a href="?p=cashbook_reconcile"><span class="list-icon">&nbsp;</span>Cash Book Reconcile</a></li>
                     <li><a href="?p=list_topup"><span class="list-icon">&nbsp;</span>Topup Book Report</a></li>
                     <li><a href="?p=list_salary"><span class="list-icon">&nbsp;</span>Salary Report</a></li>
                    
				</ul>
			</ul>
		</div>
	</div>
</div>
<div id="container">
	<div id="header" class="black_gel">
		<div class="header_left">
			<div class="logo">
				<img src="images/logoo2.png" width="160" height="60" alt="ABJJ">
			</div>
			
		</div>
		<div class="header_right">
			<div id="top_notification">
				<ul>
					<li class="dropdown">
					  <div class="notification_list dropdown-menu pull-left black_gel">
						<div class="white_lin nlist_block">														
						</div>
					</div>
					</li>
				 
			  </ul>
			</div>
			<div id="user_nav">
				<ul>
					<li class="user_thumb"><a href="#"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></a></li>
					<li class="user_info"><span class="user_name">Administrator</span><span><a href="#">Profile</a> &#124; <? echo $_SESSION['staff_name']; ?></a><?php echo $time; ?> &#124; <?php echo $date; ?></a></span></li>
					<li class="logout"><a href="logout.php"><span class="icon"></span>Logout</a></li>
				</ul>
		  </div>
		</div>
	</div>
	<div class="page_title gray_sai">
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Home Page</h3>
	</div>
	<div class=""></div>
	<div id="content">
	  <div class="grid_container" align="left">
	    <div class="widget_top active"> <span class="h_icon"></span>
	      <h6>&nbsp;</h6>
        </div>
	    <span class="clear"></span>
	    <div class="grid_12">
				<div class="widget_wrap collapsible_widget">
				  <div class="widget_content">
				    <p>
					    <?php
		$default = 'indexadmin';
		$page = isset($_GET['p']) ? $_GET['p'] : $default; //Checks if ?p is set, and puts the page in and if not, it goes to the default page.
if (!file_exists('./'.$page.'.php'))    { //Checks if the file doesn't exist
    $page = $default; //If it doesn't, it'll revert back to the default page
    //NOTE: Alternatively, you can make up a 404 page, and replace $default with whatever the page name is. Make sure it's still in the inc/ directory.
}
include('./'.$page.'.php'); //And now it's on your page!
		?>
				    </p>
						<div id="chart8" class="chart_block">
						</div>
				  </div>
				</div>
		</div>
	    <span class="clear"></span></div>
	  <span class="clear"></span>
	</div>
</div>
</body>
</html>