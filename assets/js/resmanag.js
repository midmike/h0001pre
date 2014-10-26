// ========================== Upload file ========================== //
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file").files[0];
	var formdata = new FormData();
	formdata.append("file", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "/controls/file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
    _("progress-bar").setAttribute("style", "width: " + Math.round(percent) + "%;");
    _("progress-bar").innerHTML = Math.round(percent) + " % uploaded... please wait";
}
function completeHandler(event){
    _("progress-bar").innerHTML = event.target.responseText;
    //_("progress-bar").setAttribute("style", "width: 100%;");
}
function errorHandler(event){
    _("progress-bar").innerHTML = "Upload Failed";
}
function abortHandler(event){
    _("progress-bar").innerHTML = "Upload Aborted";
}
// ======================= END upload file ========================== //