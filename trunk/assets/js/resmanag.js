// ========================== Commen ========================== //
function _(el){
	return document.getElementById(el);
}

$(document).ready(function(){
	$('#imageUpload').change(uploadFile);
});

//========================== Upload file ========================== //
function uploadFile(){
	var file = _("imageUpload").files[0];
	var formdata = new FormData();
	formdata.append("file", file);
	_("progress-bar").setAttribute("style", "width: 0%;");
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "controls/FoodControl.php/?uploadImage");
	ajax.send(formdata);
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
    _("progress-bar").setAttribute("style", "width: " + Math.round(percent) + "%;");
    _("progress-bar").innerHTML = Math.round(percent) + " % uploaded... please wait";
}
function completeHandler(event){
	//_("progress-bar").innerHTML = event.target.responseText;
	var response = JSON.parse(event.target.responseText);
	if (response.error == true) {
		_("progress-bar").innerHTML = response.message;
	} else {
		_("progress-bar").innerHTML = response.message;
		_("progress-bar").setAttribute("style", "width: 100%;");
		_("img-thumbnail").setAttribute("src", response.image);
		_("img-thumbnail").setAttribute("alt", response.alt);
		_("avatarBackground").style.display = "none";
//		_("avatarBackground").style.height = "auto";
	}
}
function errorHandler(event){
    _("progress-bar").innerHTML = "Upload Failed";
}
function abortHandler(event){
    _("progress-bar").innerHTML = "Upload Aborted";
}
function saveImage () {
	var data = {};
	data["foodCode"] = _("foodCode").value;
	data["foodName"] = _("foodName").value;
	data["foodPrice"] = _("foodPrice").value;
	data["foodType"] = _("foodType").options[_("foodType").selectedIndex].value;
	data["image"] = _("img-thumbnail").alt;
	data["imageW"] = _("img-thumbnail").style.width;
	data["imageH"] = _("img-thumbnail").style.height;
	data["cropX"] = _("cropX").value;
	data["cropY"] = _("cropY").value;
	data["cropW"] = _("cropW").value;
	data["cropH"] = _("cropH").value;
	data["imageW"] = _("img-thumbnail").clientWidth;
	data["imageH"] = _("img-thumbnail").clientHeight;
	$.ajax({
		url: "controls/FoodControl.php/?create",
		type: "POST",
		data: {"foodData": JSON.stringify(data)},
		success: onSaveSuccess
	});
}
function onSaveSuccess (data) {
	var result = JSON.parse(data);
	var error = false;
	
	if (result.foodCode) {
		$('#foodCode').parent().addClass("has-error");
	} else {
		$('#foodCode').parent().removeClass("has-error");
	}
	if (result.foodName) {
		$('#foodName').parent().addClass("has-error");
	} else {
		$('#foodName').parent().removeClass("has-error");
	}
	if (result.foodPrice) {
		$('#foodPrice').parent().addClass("has-error");
	} else {
		$('#foodPrice').parent().removeClass("has-error");
	}
	if (result.foodType) {
		$('#foodType').parent().addClass("has-error");
	} else {
		$('#foodType').parent().removeClass("has-error");
	}
	if (result.image) {
		$('#txtBrowse').parent().addClass("has-error");
	} else {
		$('#txtBrowse').parent().removeClass("has-error");
	}
}

//======================= END upload file ========================== //

// ============================= Crop =============================== //
var crop = $('#img-thumbnail').imgAreaSelect({
		handles: true,
		aspectRatio: '1:1',
		minWidth: 100,
		minHeight: 100,
		onSelectEnd: onCrop
	});
function onCrop (img, selection) {
	_("cropX").value = selection.x1;
	_("cropY").value = selection.y1;
	_("cropW").value = selection.width;
	_("cropH").value = selection.height;
}
