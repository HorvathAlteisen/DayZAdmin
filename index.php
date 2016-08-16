<?php
	if (version_compare(PHP_VERSION, '5.2.1', '<')) {
		echo '<h2>Error</h2>';
		echo '<p>PHP 5.2.1 or higher is required to use ACMS.</p>';
		echo '<p>You are running '.PHP_VERSION.'</p>';
		exit;
	}

	session_start();

	require_once('lib/acms.inc.php');
	require_once('config.php');
	require_once('db.php');
	include('queries.php');

	// Here I start to OOP the whole CP

	$app = ACMS::initialize('config/app.json');

	// End of OOP'ing
	$page = 'home';

	$KillsZ = 0;
	$KillsB = 0;
	$KillsH = 0;
	$HeadshotsZ = 0;
	$Killshero = 0;

	$res = $db->Execute($stats_totalkills);
	foreach($res as $row) {
		$KillsZ += $row['KillsZ'];
		$KillsB += $row['KillsB'];
		$KillsH += $row['KillsH'];
		$HeadshotsZ += $row['HeadshotsZ'];
	}
		
	$totalAlive = $db->GetOne($stats_totalAlive);
	$num_totalplayers = $db->GetOne($stats_totalplayers);
	$num_deaths = $db->GetOne($stats_deaths);
	$num_alivebandits = $db->GetOne($stats_alivebandits);
	$num_aliveheros = $db->GetOne($stats_aliveheros);
	$num_totalVehicles = $db->GetOne($stats_totalVehicles[0], $stats_totalVehicles[1]);
	$num_Played24h = $db->GetOne($stats_Played24h);
	$totalwalked = $db->GetOne($stats_totalwalked);	
	$avg_duration = $db->GetOne($stats_duration);
	
	

	//$leaderboardplayers .= '<tr><td>'.$kunt.'</td></tr>';

	if(isset($_GET['leaderboard'])) {
		$page = 'leaderboard';
	} else {
		$page = 'home';
	}
?>
				<?php include('modules/stats-header.php'); ?>
				<div class="row">
					<div class="col-lg-9">
						<div class="alert alert-danger fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Error! </strong><span>Wrong username or password.</span>
						</div>
						<?php
							if(isset($_GET['leaderboard'])) {
								include('modules/leaderboard.php');
							} else if($_GET['module'] == 'news') {
								include('modules/news.php');
							}
						?>
					</div>
				<div class="col-md-3">
					<?php include('modules/stats.php') ?>
				</div> 	
				<?php
					include('modules/footer.php');
				?>
			</div>
		</div>
	</body>
</html>
