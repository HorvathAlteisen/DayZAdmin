<?php


if (isset($_GET["show"])) {
		$show = $_GET["show"];
	} else {
		$show = 0;
	}

/*if (isset($_SESSION['user_id']))
{*/
	$pagetitle = "Chernarus";
?>
	
	<div class="panel panel-default">
	<div class="panel-body">
		<div class="page-header">
		<?php
			echo "<h3>".$pagetitle."</h3>";
		?>
			
		</div>
		<div id="map"></div>
	</div>
	<div class="panel-footer">
	</div>
</div>
	<script>
	InitMap();
	
	var Icon = L.Icon.extend({ options: { iconSize: [32, 37], iconAnchor: [16, 35] } });
	var car = new Icon({ iconUrl: 'images/icons/car.png' }),
		bus = new Icon({ iconUrl: 'images/icons/bus.png' }),
		atv = new Icon({ iconUrl: 'images/icons/atv.png' }),
		bike = new Icon({ iconUrl: 'images/icons/bike.png' }),
		farmvehicle = new Icon({ iconUrl: 'images/icons/farmvehicle.png' }),
		helicopter = new Icon({ iconUrl: 'images/icons/helicopter.png' }),
		largeboat = new Icon({ iconUrl: 'images/icons/largeboat.png' }),
		mediumboat = new Icon({ iconUrl: 'images/icons/mediumboat.png' }),
		smallboat = new Icon({ iconUrl: 'images/icons/smallboat.png' }),
		motorcycle = new Icon({ iconUrl: 'images/icons/motorcycle.png' }),
		pbx = new Icon({ iconUrl: 'images/icons/pbx.png' }),
		truck = new Icon({ iconUrl: 'images/icons/truck.png' }),
		plane = new Icon({ iconUrl: 'images/icons/plane.png' }),
		trap = new Icon({ iconUrl: 'images/icons/trap.png' }),
		wire = new Icon({ iconUrl: 'images/icons/wire.png' }),
		tent = new Icon({ iconUrl: 'images/icons/tent.png' }),
		DomeTentStorage = new Icon({ iconUrl: 'images/icons/dometent.png' }),
		CamoNet = new Icon({ iconUrl: 'images/icons/camonet.png' }),
		StashSmall = new Icon({ iconUrl: 'images/icons/stashsmall.png' }),
		StashMedium = new Icon({ iconUrl: 'images/icons/stashmedium.png' }),
		hedgehog = new Icon({ iconUrl: 'images/icons/hedgehog.png' }),
		Hedgehog = new Icon({ iconUrl: 'images/icons/hedgehog.png' }),
		sandbag = new Icon({ iconUrl: 'images/icons/sandbag.png' }),
		Sandbag = new Icon({ iconUrl: 'images/icons/sandbag.png' }),
		Player = new Icon({ iconUrl: 'images/icons/player.png' }),
		PlayerDead = new Icon({ iconUrl: 'images/icons/player_dead.png' });
		fence = new Icon({ iconUrl: 'images/icons/fence.png' });
		gate = new Icon({ iconUrl: 'images/icons/gate.png' });
		basefire = new Icon({ iconUrl: 'images/icons/basefire.png' });

	// store player/vehicle path
	var mapMarkersPolylines = [];
	var enableTracking = <?php echo ACMS::config('enableTracking'); ?>;
	var keepTracksAfterLogout = <?php echo ACMS::config('keepTracksAfterLogout'); ?>;
	var maxTrackingPositions = <?php echo ACMS::config('maxTrackingPositions'); ?>;
	var trackinfowindow = new L.popup({ content: "loading..." });

	var trackPolyline = L.Polyline.extend({
		options: {
			uid: -1
		},
	});

	var trackCircleMarker = L.CircleMarker.extend({
		options: {
			uid: -1
		},
	});

	var mapMarker = L.Marker.extend({
		options: {
			uid: -1
		},
	});

	map.on("mousemove", function (a) {
		$("#mapCoords").html(fromLatLngToGps(a.latlng));
	});
	
	var intervalId;
	var plotlayers = [];
	var tracklayers = [];
	var trackstartlayers = [];
	var trackendlayers = [];
	var autorefresh = true;
	intervalId = setInterval(function() { getData(<?php echo $show; ?>); }, 10000);
	
	$('#map').append('<div id="mapCoords"><label>000 000</label></div>');
	$('#map').append('<div id="mapRefresh"><label>Auto Refresh</label></div>');
	$('#mapRefresh').click(function() {
		if (autorefresh) {
			$(this).css('background-color', "#ff0000");
			$(this).css('background-color', "rgba(255, 0, 0, 0.5)");
			clearInterval(intervalId);
		} else {
			$(this).css('background-color', "#404040");
			$(this).css('background-color', "rgba(0, 0, 0, 0.5)");
			intervalId = setInterval(function() { getData(<?php echo $show; ?>); }, 10000);
		}
		autorefresh = !autorefresh;
	});
	
	getData(<?php echo $show; ?>);
	</script>
