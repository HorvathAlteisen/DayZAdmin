<?php
	session_start();
	require_once('config.php');
	require_once('db.php');
	include('queries.php');
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
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
				if(isset($_GET['leaderboard'])) {
					include('modules/leaderboard.php');
				}
			?>
			</div>
		</div>
	</div>
	<div class="col-md-2">
			<?php include('modules/stats.php') ?>
	</div> 	
	<?php
		include('modules/footer.php');
	?>
		</div>
	</body>
</html>
