<?php
if (isset ( $_GET ["view"] )) {
	switch ($_GET ["view"]) {
		case CREATE : echo "ssd"; break;
		default :
			require_once ('public/User/pageViewTable.php');
	}
} else {
	require_once ('public/User/pageViewTable.php');
}
?>