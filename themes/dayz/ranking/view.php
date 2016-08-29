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
			<th>#</th>
			<th>Name</th>
			<th>Z Kills</th>
			<th>Murders</th>
			<th>B Kills</th>
			<th>Z Headshots</th>
			<th>Humanity</th>
			<th>Deaths</th>
			<th>Points</th>
		</thead>
		<tbody>
		<?php foreach($result as $rowl): ?>
			<tr>
				<td>rank</td>
				<td><a href="#"></a></td>
				<td>KillZ</td>
				<td>KillsH</td>
				<td>KillsB</td>
				<td>HeadshotsZ</td>
				<td>Humanity</td>
				<td>death</td>
				<td>points</td>
			</tr>
			<?php $rank++; ?>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
