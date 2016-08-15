<div class="panel-default panel">	
	<div class="panel-body">		
		<div class="stats-box-inner">
			<table>
					<td width="184"><strong>Total Players:</strong></td>
					<td align="right"><?php echo $num_totalplayers;?></td>
				</tr>
				<tr>
					<td><strong><font color="#428bca">Players in Last 24h:</strong></font></td>
					<td align="right"><?php echo $num_Played24h;?></td>
				</tr>
				<tr>
					<td><strong><font color="#428bca">Alive Characters:</strong></font></td>
					<td align="right"><?php echo $totalAlive;?></td>
				</tr>
				<tr>
							<td><strong><font color="#428bca">Player Deaths:</strong></font></td>
							<td align="right"><?php echo $num_deaths;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Zombies Killed:</strong></font></td>
							<td align="right"><?php echo $KillsZ;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Zombies Headshots:</strong></font></td>
							<td align="right"><?php echo $HeadshotsZ;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Murders:</strong></font></td>
							<td align="right"><?php echo $KillsH;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Heroes Alive:</strong></font></td>
							<td align="right"><?php echo $num_aliveheros;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Bandits Alive:</strong></font></td>
							<td align="right"><?php echo $num_alivebandits;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Bandits Killed:</strong></font></td>
							<td align="right"><?php echo $KillsB;?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Total Walked:</strong></font></td>
							<td align="right"><?php echo round($totalwalked/1000);?>km</td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Average Alive:
							</strong></font></td>
							<td align="right"><?php echo $avg_duration ?></td>
						</tr>
						<tr>
							<td><strong><font color="#428bca">Vehicles:</strong></font></td>
							<td align="right"><?php echo $num_totalVehicles;?></td>
						</tr>
					</table><!--
					<br>
					<?php require_once('playersearch.php'); ?>
					<br>-->
				</div>
			</div>
		<!--</div>-->
		
		<!--<div class="col-lg-3">
			<div class="img-thumbnail" id="chart1" style="height:200px;width:200px;"></div>
			<br>
			<div class="img-thumbnail" id="chart2" style="height:200px;width:200px;"></div>	
			<br>
			<div class="img-thumbnail" id="chart4" style="height:200px;width:200px;"></div>
		</div>
		<div class="col-lg-3">
			<div class="img-thumbnail" id="chart3" style="height:200px;width:200px;"></div>
			<br>
			<div class="img-thumbnail" id="chart5" style="height:200px;width:200px;"></div>
		</div>-->
	<!--</div>-->	
</div>
