<?php
// HTML HEAD
require_once 'head.php';

// BODY
echo '<body class="tooltips">';

// The color setting box on the right.
require_once 'settingBoxRight.php';

// The wrapper of the content
echo '<div class="wrapper">';

// Top Navigation
require_once 'topNavPanel.php';

// Left sidebar (Menu)
require_once 'sidebarLeft.php';

// Right sidebar heading
require_once 'headingSidebarRight.php';

// Right sidebar (Menu)
require_once 'sidebarRight.php';


// ======== page content ========== //
echo '<div class="page-content">';
echo '<div class="container-fluid">';
?>