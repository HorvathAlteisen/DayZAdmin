<?php
/*include('config.php');*/

if (isset($_SESSION['user_id']) && $accesslvls[0][0] != 'false')
{
	/*switch($show) {
	case 0:
		$title = 'Recent Players';
		break;
	case 1:
		$title = 'Alive Players';
		break;
	case 2:
		$title = 'Dead Players';
		break;
	case 3:
		$title = 'All Players';
		break;
	case 4:
		$title = 'Vehicles';
		break;
	case 5:
		$title = 'Vehicle Spawns';
		break;
	case 6:
		$title = 'Tents / Stashes';
		break;
	case 7:
		$title = 'Other Deployables';
		break;
	case 8:
		$title = 'Recent Players, Vehicles, Deployables and Buildables';
		break;
	case 9:
		$title = 'Buildables';
		break;
	}

	echo '<div id="page-heading"><title>'.$title.' - '.$sitename.'</title><h1>'.$title.'&nbsp;(<span id="count">0</span>)</h1></div>';*/

if (isset($_GET["show"])) {
		$show = $_GET["show"];
	} else {
		$show = 0;
	}


	$db->Execute("INSERT INTO `logs`(`action`, `user`, `timestamp`) VALUES ('Viewing map',?,NOW())", $_SESSION['login']);
	include('modules/leaf.php');
}/*
else
{
	if ($accesslvls[0][0] != 'true') {
		$message->add('danger', "You dont have enough access to view this");
		$message->display();
	}
}*/
?>
