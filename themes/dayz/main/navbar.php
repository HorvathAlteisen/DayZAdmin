<?php if(!defined('ROOT')) exit;?>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php?module=news"><i class="glyphicon glyphicon-home"></i> News</a></li>
				<li><a href="index.php?module=leaderboard"><i class="glyphicon glyphicon-stats"></i> Leaderboard</a></li>
				<li><a href="index.php?module=table"><i class="glyphicon glyphicon-book"></i> Database</a></li>
				<?php //Temporarely set ?>
				<?php if (isset($_SESSION['userid'])) { ?>
				<li class="divider-vertical"></li>
				<li><a href="<?php echo ($page == 'cpanel' ? ' ../'.$security.'.php ' : ' '.$security.'.php '); ?>"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>
				<?php } ?>	
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" data-toggle="modal" data-target="#SignUp"><i class="glyphicon glyphicon-user"></i> Sign up</a></li>
       			<li><a href="#" data-toggle="modal" data-target="#Login"><i class="glyphicon glyphicon-log-in"></i> Sign in</a></li>
			</ul>
		</div>
	</div>
</div>