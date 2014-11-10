// ========================== Commen ========================== //
function _(el){
	return document.getElementById(el);
}

//========================== Upload file ========================== //
function uploadFile(){
	var file = _("file").files[0];
	var formdata = new FormData();
	formdata.append("file", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "/helper/file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
    _("progress-bar").setAttribute("style", "width: " + Math.round(percent) + "%;");
    _("progress-bar").innerHTML = Math.round(percent) + " % uploaded... please wait";
}
function completeHandler(event){
	var response = JSON.parse(event.target.responseText);
    _("progress-bar").innerHTML = response.message;
    _("progress-bar").setAttribute("style", "width: 100%;");
    _("img-thumbnail").setAttribute("src", response.image);
    _("img-thumbnail").setAttribute("alt", response.alt);
	_("img-thumbnail").setAttribute("class", "img-thumbnail");
	_("avatarBackground").style.backgroundImage = "none";
	_("avatarBackground").style.height = "auto";
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
		url: "/helper/ImageSaver.php",
		type: "POST",
		data: {"foodData": JSON.stringify(data)},
		success: onSaveSuccess
	});
}
function onSaveSuccess (data) {
	var result = JSON.parse(data);
	if(result.validate == false) {
		alert(result.validate);
	} else {
		alert(result.validate);
	}
}

//======================= END upload file ========================== //

// ============================= Crop =============================== //
var crop = $('#img-thumbnail').imgAreaSelect({
		handles: true,
		aspectRatio: '1:1',
		minWidth: 250,
		minHeight: 250,
		onSelectEnd: onCrop
	});
function onCrop (img, selection) {
	_("cropX").value = selection.x1;
	_("cropY").value = selection.y1;
	_("cropW").value = selection.width;
	_("cropH").value = selection.height;
}
