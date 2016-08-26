<div class="panel panel-default">
	<div class="panel-body">
		<div class="page-header">
		<h3><?php echo $pagetitle; ?></h3>
			
		</div>
		<div class="row">
			<div class="col-md-2 pull-right">
				<select class="form-control" name="limit">
					<option selected="selected">10</option>
					<option>20</option>
					<option>30</option>
					<option>40</option>
					<option>50</option>            
				</select>
			</div>
		</div>
	</div>
	<table class="table table-bordered table-striped">
		<thead>
			<th class="sorting">#</th>
			<th class="sorting">Name</th>
			<th class="sorting">Z Kills</th>
			<th class="sorting">Murders</th>
			<th class="sorting">B Kills</th>
			<th class="sorting">Z Headshots</th>
			<th class="sorting">Humanity</th>
			<th class="sorting">Deaths</th>
			<th class="sorting">Points</th>
		</thead>
		<tbody>
			<?php if (sizeof($result) != 0) ?>
				<?php foreach($result as $rowl) ?>
					<?php $points = $rowl['KillsZ']+$rowl['KillsB']-$rowl['KillsH']-($rowl['Generation'] - 1);
						  $deaths = $rowl['Generation'] - 1;?>
					<?php if(isset($_SESSION['user_id'])) ?>
						<tr>
							<td>{$rank}</td>
							<td><a href=\"".$security.".php?view=info&show=1&CharacterID={$rowl['CharacterID']}\">{$rowl['playerName']}</a></td>
							<td>{$rowl['KillsZ']}</td>
							<td>{$rowl['KillsH']}</td>
							<td>{$rowl['KillsB']}</td>
							<td>{$rowl['HeadshotsZ']}</td>
							<td>{$rowl['Humanity']}</td>
							<td>{$deaths}</td>
							<td>{$points}</td>
						</tr>";
					<?php else ?>
						<tr>
							<td>{$rank}</td>
							<td>{$rowl['playerName']}</td>
							<td>{$rowl['KillsZ']}</td>
							<td>{$rowl['KillsH']}</td>
							<td>{$rowl['KillsB']}</td>
							<td>{$rowl['HeadshotsZ']}</td>
							<td>{$rowl['Humanity']}</td>
							<td>{$deaths}</td>
							<td>{$points}</td>
						</tr>
					<?php endif ?>
							<?php $rank++; ?>
				<?php endforeach?>
			</tbody>
		</table>
</div>
