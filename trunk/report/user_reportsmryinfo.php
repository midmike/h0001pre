<?php

// Global variable for table object
$user_report = NULL;

//
// Table class for user report
//
class cruser_report extends crTableBase {

//	var $SelectLimit = TRUE;
	var $id;
	var $name;
	var $status;
	var $address;
	var $phone;
	var $username;
	var $password;
	var $createdate;
	var $modifydate;
	var $editedby;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage;
		$this->TableVar = 'user_report';
		$this->TableName = 'user report';
		$this->TableType = 'REPORT';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// id
		$this->id = new crField('user_report', 'user report', 'x_id', 'id', '`id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;
		$this->id->DateFilter = "";
		$this->id->SqlSelect = "";
		$this->id->SqlOrderBy = "";

		// name
		$this->name = new crField('user_report', 'user report', 'x_name', 'name', '`name`', 200, EWR_DATATYPE_STRING, -1);
		$this->fields['name'] = &$this->name;
		$this->name->DateFilter = "";
		$this->name->SqlSelect = "";
		$this->name->SqlOrderBy = "";

		// status
		$this->status = new crField('user_report', 'user report', 'x_status', 'status', '`status`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->status->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;
		$this->status->DateFilter = "";
		$this->status->SqlSelect = "";
		$this->status->SqlOrderBy = "";

		// address
		$this->address = new crField('user_report', 'user report', 'x_address', 'address', '`address`', 200, EWR_DATATYPE_STRING, -1);
		$this->fields['address'] = &$this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// phone
		$this->phone = new crField('user_report', 'user report', 'x_phone', 'phone', '`phone`', 200, EWR_DATATYPE_STRING, -1);
		$this->fields['phone'] = &$this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";

		// username
		$this->username = new crField('user_report', 'user report', 'x_username', 'username', '`username`', 200, EWR_DATATYPE_STRING, -1);
		$this->fields['username'] = &$this->username;
		$this->username->DateFilter = "";
		$this->username->SqlSelect = "";
		$this->username->SqlOrderBy = "";

		// password
		$this->password = new crField('user_report', 'user report', 'x_password', 'password', '`password`', 200, EWR_DATATYPE_STRING, -1);
		$this->fields['password'] = &$this->password;
		$this->password->DateFilter = "";
		$this->password->SqlSelect = "";
		$this->password->SqlOrderBy = "";

		// createdate
		$this->createdate = new crField('user_report', 'user report', 'x_createdate', 'createdate', '`createdate`', 133, EWR_DATATYPE_DATE, 5);
		$this->createdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['createdate'] = &$this->createdate;
		$this->createdate->DateFilter = "";
		$this->createdate->SqlSelect = "";
		$this->createdate->SqlOrderBy = "";

		// modifydate
		$this->modifydate = new crField('user_report', 'user report', 'x_modifydate', 'modifydate', '`modifydate`', 133, EWR_DATATYPE_DATE, 5);
		$this->modifydate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['modifydate'] = &$this->modifydate;
		$this->modifydate->DateFilter = "";
		$this->modifydate->SqlSelect = "";
		$this->modifydate->SqlOrderBy = "";

		// editedby
		$this->editedby = new crField('user_report', 'user report', 'x_editedby', 'editedby', '`editedby`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->editedby->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['editedby'] = &$this->editedby;
		$this->editedby->DateFilter = "";
		$this->editedby->SqlSelect = "";
		$this->editedby->SqlOrderBy = "";
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = "";
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fld->FldExpression, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fld->FldExpression . " " . $fld->getSort();
				} else {
					if ($sDtlSortSql <> "") $sDtlSortSql .= ", ";
					$sDtlSortSql .= $fld->FldExpression . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ",";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`tbuser`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "";
	}

	function SqlSelectAgg() {
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlAggPfx() {
		return "";
	}

	function SqlAggSfx() {
		return "";
	}

	function SqlSelectCount() {
		return "SELECT COUNT(*) FROM " . $this->SqlFrom();
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here	
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		// if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//     $filter = "..."; // Modify the filter
		// if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//     $filter = "..."; // Modify the filter
		// if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//     $filter = "..."; // Modify the filter
		// if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//     $filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
