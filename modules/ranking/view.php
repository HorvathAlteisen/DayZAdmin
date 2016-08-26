<?php
	$con = new PDO("");

                <?php
                $result = $db->GetAll($leaderboard_query . " ORDER BY $sortby $sorttype LIMIT $limit");
                $rank = 1;
            ?>


	
	$pagetitle = 'Ranking';

?>

