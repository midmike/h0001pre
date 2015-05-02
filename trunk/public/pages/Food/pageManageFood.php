<?php
if (isset ( $_GET [VIEW] )) {
	switch ($_GET [VIEW]) {
		case CREATE : 
		case EDIT : require_once ('public/pages/uploadPanel.php'); break;
		case FRAME : require_once ('public/pages/Food/pageFrameFood.php'); break;
		default :
			require_once ('public/pages/Food/pageViewTable.php');
	}
} else {
	require_once ('public/pages/Food/pageViewTable.php');
}
?>