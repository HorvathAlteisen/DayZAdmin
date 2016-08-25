<?php if(!defined('ROOT')) exit;?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<title><?php echo(ACMS::config('appName')); ?></title>
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

		<!-- Map -->
		<link rel="stylesheet" href="css/leaflet.css" type="text/css" />
		<link rel="stylesheet" href="css/map.css" type="text/css" />
		
	</head>
	<body>
		<?php include('main/modal.php'); ?>
		<?php include('main/navbar.php') ?>
		<div class="container"><!--
			<header class="container-fluid jumbotron page-header">
				<h1>Dead SeriouZ</h1>
				<p>We take Surviving to another level!</p>
			</header>-->
	  		<!--<nav class="navbar navbar-inverse">
	    		<div class="container-fluid">
	    			<div class="navbar-header">
	        			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
	        				<span class="sr-only">Toggle navigation</span>
	        				<span class="icon-bar"></span>
	        				<span class="icon-bar"></span>
    	    				<span class="icon-bar"></span>
    	    			</button>
    	    			<a class="navbar-brand" href="https://deadseriouz.rocks"><img src="images/DayZAdmin.png" alt="Dispute Bills"></a>
    	  			</div>
    	  			<div id="navbar1" class="navbar-collapse collapse">
    	    			<ul class="nav navbar-nav">
    	      				<li>
    	      					<a href="<?php echo('index.php?module=dashboard'); ?>">
    	      					<i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
    	      				</li>
    	      				<li>
    	      					<a href="<?php echo('index.php?module=map'); ?>">
    	      					<i class="glyphicon glyphicon-map-marker"></i> Map</a>
    	      				</li>
    	      				<li>
    	      					<a href="index.php?module=config">
    	      					<i class="glyphicon glyphicon-file"></i> View Config</a>
    	      				</li>
    	    			</ul>
      				</div>
    			</div>
  			</nav>-->
  			<div class="row">
  				<div class="col-md-9">
  					<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error! </strong><span>Wrong username or password.</span>
					</div>