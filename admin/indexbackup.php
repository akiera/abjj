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
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));
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
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
<script>
	$(function () {
    $.jqplot._noToImageButton = true;
    var prevYear = [["2011-08-01",398], ["2011-08-02",255.25], ["2011-08-03",263.9], ["2011-08-04",154.24],
    ["2011-08-05",210.18], ["2011-08-06",109.73], ["2011-08-07",166.91], ["2011-08-08",330.27], ["2011-08-09",546.6],
    ["2011-08-10",260.5], ["2011-08-11",330.34], ["2011-08-12",464.32], ["2011-08-13",432.13], ["2011-08-14",197.78],
    ["2011-08-15",311.93], ["2011-08-16",650.02], ["2011-08-17",486.13], ["2011-08-18",330.99], ["2011-08-19",504.33],
    ["2011-08-20",773.12], ["2011-08-21",296.5], ["2011-08-22",280.13], ["2011-08-23",428.9], ["2011-08-24",469.75],
    ["2011-08-25",628.07], ["2011-08-26",516.5], ["2011-08-27",405.81], ["2011-08-28",367.5], ["2011-08-29",492.68],
    ["2011-08-30",700.79], ["2011-08-31",588.5], ["2011-09-01",511.83], ["2011-09-02",721.15], ["2011-09-03",649.62],
    ["2011-09-04",653.14], ["2011-09-06",900.31], ["2011-09-07",803.59], ["2011-09-08",851.19], ["2011-09-09",2059.24],
    ["2011-09-10",994.05], ["2011-09-11",742.95], ["2011-09-12",1340.98], ["2011-09-13",839.78], ["2011-09-14",1769.21],
    ["2011-09-15",1559.01], ["2011-09-16",2099.49], ["2011-09-17",1510.22], ["2011-09-18",1691.72],
    ["2011-09-19",1074.45], ["2011-09-20",1529.41], ["2011-09-21",1876.44], ["2011-09-22",1986.02],
    ["2011-09-23",1461.91], ["2011-09-24",1460.3], ["2011-09-25",1392.96], ["2011-09-26",2164.85],
    ["2011-09-27",1746.86], ["2011-09-28",2220.28], ["2011-09-29",2617.91], ["2011-09-30",3236.63]];
    var currYear = [["2011-08-01",796.01], ["2011-08-02",510.5], ["2011-08-03",527.8], ["2011-08-04",308.48],
    ["2011-08-05",420.36], ["2011-08-06",219.47], ["2011-08-07",333.82], ["2011-08-08",660.55], ["2011-08-09",1093.19],
    ["2011-08-10",521], ["2011-08-11",660.68], ["2011-08-12",928.65], ["2011-08-13",864.26], ["2011-08-14",395.55],
    ["2011-08-15",623.86], ["2011-08-16",1300.05], ["2011-08-17",972.25], ["2011-08-18",661.98], ["2011-08-19",1008.67],
    ["2011-08-20",1546.23], ["2011-08-21",593], ["2011-08-22",560.25], ["2011-08-23",857.8], ["2011-08-24",939.5],
    ["2011-08-25",1256.14], ["2011-08-26",1033.01], ["2011-08-27",811.63], ["2011-08-28",735.01], ["2011-08-29",985.35],
    ["2011-08-30",1401.58], ["2011-08-31",1177], ["2011-09-01",1023.66], ["2011-09-02",1442.31], ["2011-09-03",1299.24],
    ["2011-09-04",1306.29], ["2011-09-06",1800.62], ["2011-09-07",1607.18], ["2011-09-08",1702.38],
    ["2011-09-09",4118.48], ["2011-09-10",1988.11], ["2011-09-11",1485.89], ["2011-09-12",2681.97],
    ["2011-09-13",1679.56], ["2011-09-14",3538.43], ["2011-09-15",3118.01], ["2011-09-16",4198.97],
    ["2011-09-17",3020.44], ["2011-09-18",3383.45], ["2011-09-19",2148.91], ["2011-09-20",3058.82],
    ["2011-09-21",3752.88], ["2011-09-22",3972.03], ["2011-09-23",2923.82], ["2011-09-24",2920.59],
    ["2011-09-25",2785.93], ["2011-09-26",4329.7], ["2011-09-27",3493.72], ["2011-09-28",4440.55],
    ["2011-09-29",5235.81], ["2011-09-30",6473.25]];
    var plot1 = $.jqplot("chart1", [prevYear, currYear], {
        seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
        title: 'Monthly Revenue',
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
            {
                fill: true,
                label: '2010'
            },
            {
                label: '2011'
            }
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%b %e",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: "2011-08-01",
                max: "2011-09-30",
                tickInterval: "7 days",
                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    formatString: "$%'d",
                    showMark: false
                }
            }
        }
    });
});
/*=================
CHART 8
===================*/
$(function(){
  var plot2 = $.jqplot ('chart8', [[3,7,9,1,5,3,8,2,5]], {
      // Give the plot a title.
      title: 'Plot With Options',
      // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
      axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
      // Likewise, seriesDefaults specifies default options for all
      // series in a plot.  Options specified in seriesDefaults or
      // axesDefaults can be overridden by individual series or
      // axes options.
      // Here we turn on smoothing for the line.
      seriesDefaults: {
		  shadow: false,   // show shadow or not.
          rendererOptions: {
              smooth: true
          }
      },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "X Axis",
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
          label: "Y Axis"
        }
      },
		grid: {
         borderColor: '#ccc',     // CSS color spec for border around grid.
        borderWidth: 2.0,           // pixel width of border around grid.
        shadow: false               // draw a shadow for grid.
    }
    });
});
</script>
</head>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div>
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
            		<li><a href="?p=test3"><span class="list-icon">&nbsp;</span>tets</a></li>
                    <li><a href="?p=test4"><span class="list-icon">&nbsp;</span>tots</a></li>
                    <li><a href="?p=tables"><span class="list-icon">&nbsp;</span>ngek</a></li>
                    <li><a href="?p=table2"><span class="list-icon">&nbsp;</span>tebel</a></li>
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
					<li><a href="?p=payment_status"><span class="list-icon">&nbsp;</span>Payment Status</a></li>
   					<li><a href="?p=list_payment"><span class="list-icon">&nbsp;</span>Payment List</a></li>
				</ul>
				</li>
                <li><a href="#"><span class="nav_icon frames"></span>Daily Report</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="?p=daily_report"><span class="list-icon">&nbsp;</span>New Daily Report</a></li>
					<li><a href="?p=list_daily_report"><span class="list-icon">&nbsp;</span>Daily Report List</a></li>
				</ul>
				</li>
				<li><a href="chart.html"><span class="nav_icon chart_8"></span>Chart/Graph</a></li>
				<li><a href="#"><span class="nav_icon bulls_eye"></span>Manager Page</span><span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="403.html" target="_blank"><span class="list-icon">&nbsp;</span>Daily Sales Report</a></li>
					<li><a href="404.html" target="_blank"><span class="list-icon">&nbsp;</span>Daily Sales Report List</a></li>
					<li><a href="?p=cash_book"><span class="list-icon">&nbsp;</span>Cash Book</a></li>
					<li><a href="500.html" target="_blank"><span class="list-icon">&nbsp;</span>Cash Book List</a></li>
					<li><a href="?p=topup_transfer" target="_blank"><span class="list-icon">&nbsp;</span>Topup Transfer</a></li>
                    <li><a href="503.html" target="_blank"><span class="list-icon">&nbsp;</span>Topup Transfer List</a></li>
                    <li><a href="503.html" target="_blank"><span class="list-icon">&nbsp;</span>Staff Salary</a></li>
                    <li><a href="503.html" target="_blank"><span class="list-icon">&nbsp;</span>Staff Salary List</a></li>
				</ul>
				</li>
				<li><a href="?p=purchase"><span class="nav_icon money_2"></span>Report</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="container">
	<div id="header" class="black_gel">
		<div class="header_left">
			<div class="logo">
				<img src="images/logoo.png" width="160" height="60" alt="Ekra">
			</div>
			<div id="responsive_mnu">
				<a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
				<div id="responsive_menu" class="hidden">
					<ul>
						<li><a href="#"> Dashboard</a>
						<ul>
							<li><a href="dashboard.html">Dashboard Main</a></li>
							<li><a href="dashboard-01.html">Dashboard 01</a></li>
							<li><a href="dashboard-02.html">Dashboard 02</a></li>
							<li><a href="dashboard-03.html">Dashboard 03</a></li>
							<li><a href="dashboard-04.html">Dashboard 04</a></li>
						</ul>
						</li>
						<li><a href="#"> Forms</a>
						<ul>
							<li><a href="form-elements.html">All Forms Elements</a></li>
							<li><a href="left-label-form.html">Left Label Form</a></li>
							<li><a href="top-label-form.html">Top Label Form</a></li>
							<li><a href="form-xtras.html">Additional Forms (3)</a></li>
							<li><a href="form-validation.html">Form Validation</a></li>
							<li><a href="signup-form.html">Signup Form</a></li>
							<li><a href="content-post.html">Content Post Form</a></li>
							<li><a href="wizard.html">wizard</a></li>
						</ul>
						</li>
						<li><a href="table.html"> Tables</a></li>
						<li><a href="ui-elements.html">User Interface Elements</a></li>
						<li><a href="buttons-icons.html">Butons And Icons</a></li>
						<li><a href="widgets.html">All Widgets</a></li>
						<li><a href="#">Pages</a>
						<ul>
							<li><a href="post-preview.html">Content</a></li>
							<li><a href="login-01.html" target="_blank">Login 01</a></li>
							<li><a href="login-02.html" target="_blank">Login 02</a></li>
							<li><a href="login-03.html" target="_blank">Login 03</a></li>
							<li><a href="forgot-pass.html" target="_blank">Forgot Password</a></li>
						</ul>
						</li>
						<li><a href="typography.html">Typography</a></li>
						<li><a href="#">Grid</a>
						<ul>
							<li><a href="content-grid.html">Content Grid</a></li>
							<li><a href="form-grid.html">Form Grid</a></li>
						</ul>
						</li>
						<li><a href="chart.html">Chart/Graph</a></li>
						<li><a href="gallery.html">Gallery</a></li>
						<li><a href="calendar.html">Calendar</a></li>
						<li><a href="file-manager.html">File Manager</a></li>
						<li><a href="#">Error Pages</a>
						<ul>
							<li><a href="403.html" target="_blank">403</a></li>
							<li><a href="404.html" target="_blank">404</a></li>
							<li><a href="505.html" target="_blank">405</a></li>
							<li><a href="500.html" target="_blank">500</a></li>
							<li><a href="503.html" target="_blank">503</a></li>
						</ul>
						</li>
						<li><a href="invoice.html">Invoice</a></li>
						<li><a href="#">Email Templates</a>
						<ul>
							<li><a href="email-templates/forgot-pass-email-template.html" target="_blank">Forgot Password</a></li>
							<li><a href="email-templates/registration-confirmation-email-template.html" target="_blank">Registaion Confirmation</a></li>
						</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="header_right">
			<div id="top_notification">
				<ul>
					<li class="dropdown">
					  <div class="notification_list dropdown-menu pull-left black_gel">
						<div class="white_lin nlist_block">
							<ul>
								<li>
								<div class="nlist_thumb">
									<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
								</div>
								<div class="list_inf">
									<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
								</div>
								</li>
								<li>
								<div class="nlist_thumb">
									<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
								</div>
								<div class="list_inf">
									<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
								</div>
								</li>
								<li>
								<div class="nlist_thumb">
									<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
								</div>
								<div class="list_inf">
									<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
								</div>
								</li>
							</ul>
							<span class="btn_24_blue"><a href="#">View All</a></span>
						</div>
					</div>
					</li>
				  <li class="inbox dropdown">
			      <div class="notification_list dropdown-menu black_gel">
						<div class="white_lin nlist_block">
							<ul>
								<li>
								<div class="nlist_thumb">
									<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
								</div>
								<div class="list_inf">
									<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
								</div>
								</li>
								<li>
								<div class="nlist_thumb">
									<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
								</div>
								<div class="list_inf">
									<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
								</div>
								</li>
								<li>
								<div class="nlist_thumb">
									<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
								</div>
								<div class="list_inf">
									<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
								</div>
								</li>
							</ul>
							<span class="btn_24_blue"><a href="#">View All</a></span>
						</div>
					</div>
				  </li>
			  </ul>
			</div>
			<div id="user_nav">
				<ul>
					<li class="user_thumb"><a href="#"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></a></li>
					<li class="user_info"><span class="user_name">Administrator</span><span><a href="#">Profile</a> &#124; <? echo $_SESSION['staff_name']; ?> &#124;<a href=""> Time    </a><a href="" class=""><?php echo $time; ?> &#124; <?php echo $date; ?></a></span></li>
					<li class="logout"><a href="logout.php"><span class="icon"></span>Logout</a></li>
				</ul>
		  </div>
		</div>
	</div>
	<div class="page_title gray_sai">
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Home Page</h3>
	</div>
	<div class="switch_bar">
		<ul>
		  <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="stats_icon user_sl"><span class="alert_notify orange">30</span></span><span class="label"> Users</span></a>
			<div class="notification_list dropdown-menu black_gel">
				<div class="white_lin nlist_block">
					<ul>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
						</div>
						</li>
					</ul>
					<span class="btn_24_blue"><a href="#">View All</a></span>
				</div>
			</div>
			</li>
			<li><a href="#"><span class="stats_icon administrative_docs_sl"></span><span class="label">Content</span></a></li>
			<li><a href="#"><span class="stats_icon finished_work_sl"><span class="alert_notify blue">30</span></span><span class="label">Task List</span></a></li>
			<li><a href="#"><span class="stats_icon config_sl"></span><span class="label">Settings</span></a></li>
			<li><a href="#"><span class="stats_icon archives_sl"></span><span class="label">Archive</span></a></li>
			<li><a href="#"><span class="stats_icon address_sl"></span><span class="label">Contact</span></a></li>
			<li><a href="#"><span class="stats_icon folder_sl"></span><span class="label">Media</span></a></li>
			<li><a href="#"><span class="stats_icon category_sl"></span><span class="label">Explorer</span></a></li>
			<li><a href="#"><span class="stats_icon calendar_sl"><span class="alert_notify orange">30</span></span><span class="label">Events</span></a></li>
			<li><a href="#"><span class="stats_icon lightbulb_sl"></span><span class="label">Support</span></a></li>
			<li><a href="#"><span class="stats_icon bank_sl"><span class="alert_notify blue">30</span></span><span class="label">Order List</span></a></li>
		</ul>
	</div>
	<div id="content">
	  <div class="grid_container" align="left"><span class="clear"></span>
	    <div class="grid_12">
				<div class="widget_wrap collapsible_widget">
					<div class="widget_top active">
						<span class="h_icon"></span>
						<h6>&nbsp;</h6>
				  </div>
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