<!-- Begin Main Menu -->
<div class="ewMenu">
<?php $RootMenu = new crMenu(EWR_MENUBAR_ID); ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(10, $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("10", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "user_reportsmry.php", -1, "", TRUE, FALSE);
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
