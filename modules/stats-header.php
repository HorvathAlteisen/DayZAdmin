<!DOCTYPE html>
<html lang="EN">
<head>
	<title><?php echo $app->config('appName') ?></title>
	<!--<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />-->
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
	<!-- New design (Bootstrap - font-awesome) -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-dayz.css">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css" />
	
	<!-- Graphs -->
	<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/excanvas.js"></script><![endif]-->
	<script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.jqplot.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.canvasTextRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>	
	<script type="text/javascript" src="js/plugins/jqplot.bubbleRenderer.min.js"></script>	
	<script type="text/javascript" src="js/plugins/jqplot.dateAxisRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.jqplot.donutRenderer.min.js"></script>
	
	<script>
		$(document).ready(function(){
		 
			var arr = [[1, <?php echo $totalAlive; ?>, <?php echo $totalAlive; ?>, "Alive"], [2, <?php echo $num_deaths; ?>, <?php echo $num_deaths; ?>, "Dead"]];
			 
			var plot1 = $.jqplot('chart1',[arr],{
				title: 'Dead vs Alive Players',
				seriesDefaults:{
					renderer: $.jqplot.BubbleRenderer,
					rendererOptions: {
						bubbleAlpha: 0.6,
						highlightAlpha: 0.8
					},
					shadow: true,
					shadowAlpha: 0.05
				}
			});
			
			var arr2 = [[1, <?php echo $num_aliveheros; ?>, <?php echo $num_aliveheros; ?>, "Heroes"], [2, <?php echo $num_alivebandits; ?>, <?php echo $num_alivebandits; ?>, "Bandits"]];
			var plot2 = $.jqplot('chart2',[arr2],{
				title: 'Bandits vs Heroes',
				seriesDefaults:{
					renderer: $.jqplot.BubbleRenderer,
					rendererOptions: {
						bubbleAlpha: 0.6,
						highlightAlpha: 0.8
					},
					shadow: true,
					shadowAlpha: 0.05
				}
			});
			
			var arr3 = [[1, <?php echo $KillsZ; ?>, <?php echo $KillsZ; ?>, "Zombie Kills"], [2, <?php echo $HeadshotsZ; ?>, <?php echo $HeadshotsZ; ?>, "Headshots"]];
			var plot3 = $.jqplot('chart3',[arr3],{
				title: 'Zombie Statistics',
				seriesDefaults:{
					renderer: $.jqplot.BubbleRenderer,
					rendererOptions: {
						bubbleAlpha: 0.6,
						highlightAlpha: 0.8
					},
					shadow: true,
					shadowAlpha: 0.05
				}
			});
			
			var arr4 = [[1, <?php echo $KillsZ; ?>, <?php echo $KillsZ; ?>, "Bandits Alive"], [2, <?php echo $HeadshotsZ; ?>, <?php echo $HeadshotsZ; ?>, "Bandits Killed"]];
			var plot4 = $.jqplot('chart4',[arr4],{
				title: 'Bandit Statistics',
				seriesDefaults:{
					renderer: $.jqplot.BubbleRenderer,
					rendererOptions: {
						bubbleAlpha: 0.6,
						highlightAlpha: 0.8
					},
					shadow: true,
					shadowAlpha: 0.05
				}
			});
			
			var arr5 = [[1, <?php echo $num_totalplayers; ?>, <?php echo $num_totalplayers; ?>, "Total"], [2, <?php echo $totalAlive; ?>, <?php echo $totalAlive; ?>, "Alive"]];
			var plot5 = $.jqplot('chart5',[arr5],{
				title: 'Total vs Alive Players',
				seriesDefaults:{
					renderer: $.jqplot.BubbleRenderer,
					rendererOptions: {
						bubbleAlpha: 0.6,
						highlightAlpha: 0.8
					},
					shadow: true,
					shadowAlpha: 0.05
				}
			});
		});
	</script>
</head>
<body>
	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php?module=news"><i class="glyphicon glyphicon-home"></i> News</a></li>
				<li><a href="<?php echo ($page == 'cpanel' ? ' ../index.php?leaderboard ' : ' index.php?leaderboard '); ?>"><i class="glyphicon glyphicon-stats"></i> Leaderboard</a></li>
				<?php if ($ManuPanelLink == 1) { ?>
				<li>
					<a href="<?php echo ($page == 'cpanel' ? ' ../'.$security.'.php ' : ' '.$security.'.php '); ?>"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
				</li>
				<?php } ?>	
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" data-toggle="modal" data-target="#SignUp"><i class="glyphicon glyphicon-user"></i> Sign Up</a></li>
        			<li><a href="#" data-toggle="modal" data-target="#Login"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<header class="container-fluid jumbotron page-header">
			<h1>Dead SeriouZ</h1>
			<p>We take Surviving to another level!</p>
		</header>
		<?php if (isset($_SESSION['user_id'])) {?>
  		<nav class="navbar navbar-inverse">
    		<div class="container-fluid">
    			<div class="navbar-header">
        			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        			</button>
        			<a class="navbar-brand" href="http://disputebills.com"><img src="images/DayZAdmin.png" alt="Dispute Bills"></a>
      			</div>
      			<div id="navbar1" class="navbar-collapse collapse">
        			<ul class="nav navbar-nav">
          				<li><a href="<?php echo ($page == 'cpanel' ? ' ../'.$security.'.php ' : ' '.$security.'.php '); ?>"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>
        			</ul>
        			<div class="row">
        				<div class="col-sm-3 col-md-3 pull-right">
        				<form class="navbar-form">
    						<div class="input-group">
    							<input type="text" class="form-control" placeholder="Search for" aria-label="...">
    							<div class="input-group-btn">
    							    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Player <span class="caret"></span></button>
        							<ul class="dropdown-menu dropdown-menu-right">
        								<li><a href="#">Player</a></li>
        								<li><a href="#">Vehicle</a></li>
        								<li><a href="#">Something else here</a></li>
        								<li role="separator" class="divider"></li>
        								<li><a href="#">Separated link</a></li>
       								</ul>
      							</div><!-- /btn-group -->
    						</div><!-- /input-group -->
        				</form>
        			</div>
        			</div>
      			</div>
    		</div>
  		</nav>
		<?php } ?>