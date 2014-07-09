/*
 *	Check empty value
 */
function isEmpty(val){
	if(val == null || val == ""){
		return true;
	}
	return false;
}

/*
 *	Get file name from file path
 */
function getFileName(sPath){
	if(!isEmpty(sPath)){
		sPath = sPath.replace('/', '\\');
		var iPos = sPath.lastIndexOf('\\');
		if(iPos != -1){
			return sPath.substr(iPos + 1, sPath.length);
		}
		return sPath;
	}
	return "";
}

/*
 * Check maxlength for textarea
 */  
function imposeMaxLength(Object, MaxLen){
  return (Object.value.length <= (MaxLen-1));
}

/*
 * Set value of Object HTML with MAX length of data
 */
function maxLength(Object){
	var iLength = Object.getAttribute ? parseInt(Object.getAttribute("maxlength")) : 0;
	if(Object.getAttribute && Object.value.length > iLength){
		Object.value = Object.value.substring(0, iLength);
	}
}

/**
 * Author: Thao tran
 * break line a string 
 * @param: strContent: string value, intMax: max lenght
 * @return: new string
 * */
function wordWrap(sContent, iMax){
	var sTemp = "";
	while(sContent.length > iMax){
			sTemp   += sContent.substr(0, iMax) + "<br>";  
			sContent = sContent.substr(iMax, sContent.length);  
	}
	sTemp += sContent;
	return sTemp;
}

/**
  * Author: Thao tran
  * Cut the spaces at the left and the rigth of a string
  * @param - sStr to be trimmed
  * @return - trimmed string
  * **/
function Trim(sStr){
	while (sStr.charCodeAt(0) <= 32){
		sStr=sStr.substr(1);
	}
	while (sStr.charCodeAt(sStr.length - 1) <= 32){
		sStr=sStr.substr(0, sStr.length - 1);
	}
	return sStr;
}

/**
  * Author: Thao tran
  * check numeric
  * @param - sStr
  * @return - true is ok; else false
  * **/
function isNumeric(str){
	if(isEmpty(str)){
		return false;
	}
	for(var i = 0, len = str.length; i < len; i++){
		var ch = str.charAt(i);
		if(isNaN(parseInt(ch))){
			return false;
		}
	}
	return true;
}
/**
* check sign selection for chekcbox or radio button
* @param - arrField, value
* **/
function optSelect(arrField, value){
	for(var i=0; i < arrField.length; i++){    	
		if(arrField[i].value == value){
			arrField[i].checked = true;
		}
	}
}

/** Check undefined html object
  * 
  * Author: LE THANH PHONG
  * @param - object id
  * @return - true is ok; else false
  * **/
function isExistObjectHTML(ob_id){
	if(document.getElementById(ob_id)!=null){
		return true;
	}
	return false;
}

/** Set inner data for an html object
  * 
  * Author: LE THANH PHONG
  * @param - object id, value
  * @return - none
  * **/
function setInnerHTML(ob_id, value){
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).innerHTML = value;
	}
}

/** Get inner data of an html object
  * 
  * Author: LE THANH PHONG
  * @param - object id, value
  * @return - none
  * **/
function getInnerHTML(ob_id){
	if(isExistObjectHTML(ob_id)){
		return document.getElementById(ob_id).innerHTML;
	}
	return "";
}

/** Set data for an html object
  * 
  * Author: LE THANH PHONG
  * @param - object id, value
  * @return - none
  * **/
function setValueHTML(ob_id, value){
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).value = value;
	}
}

/** Get data of an html object
  * 
  * Author: LE THANH PHONG
  * @param - object id
  * @return - value
  * **/
function getValueHTML(ob_id){
	if(isExistObjectHTML(ob_id)){
		return document.getElementById(ob_id).value;
	}
	return "";
}

/** Show inner data of an html object
  * 
  * Author: LE THANH PHONG
  * @param - object id
  * @return - none
  * **/
function visible(ob_id){		
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).style.display = "block";
	}
}

/** Hide inner data of an html object
  * 
  * Author: LE THANH PHONG
  * @param - object id
  * @return - none
  * **/
function invisible(ob_id){
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).style.display = "none";
	}
}

function show(ob_id){
	visible(ob_id);
}

function hide(ob_id){
	invisible(ob_id);
}

function showHide(ob_id) {
	if(isExistObjectHTML(ob_id)){
		if (document.getElementById(ob_id).style.display == "none") {
			show(ob_id);
		} else {
			hide(ob_id);
		}
	}
}

/** Refresh page
  * 
  * Author: LE THANH PHONG
  * @param - none
  * @return - none
  * **/
function refreshPage(){
	window.location.reload();
}

/** Disappear box 
  * Author: LE THANH PHONG
  * @return - none
  * */

function scrollUp(obj, hMax, hMin){
	
	var reduce_height_by  = 8;
	var rate = 10;	// 15 fps
	
	if(hMax > 0){
		hMax -= reduce_height_by;
		if(hMax < 0) hMax = 0;
		obj.style.height = hMax + "px";
	}
	
	if(hMax > 0 && hMax > hMin){
		setTimeout(function() { scrollUp(obj, hMax, hMin); }, rate);
	}
}

function scrollDown(obj, hMax, hMin){
	
	var increase_height_by  = 8;
	var rate = 10;	// 15 fps
	
	if(hMax > hMin){
		hMin += increase_height_by;
		if(hMax < hMin) hMin = hMax;
		obj.style.height = hMin + "px";
	}
	
	if(hMax > hMin){
		setTimeout(function() { scrollDown(obj, hMax, hMin); }, rate);
	}
}

function isEmail(emailStr)
{
	var emailPat = /^(.+)@(.+)$/;
	var matchArray = emailStr.match(emailPat);
	if (matchArray == null) {
		return false;
	}
	return true;
}

/** Set CSS Class for an object */
function setClassName(ob_id, className){
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).className = className;
	}
}

/** Set focus on an object HTML */
function setFocusHTML(ob_id){
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).focus();
	}
}

/** Hide loading bar */
function removeLoading(){
	alert();
	var targelem = document.getElementById('percents');
	if(targelem != null){
		targelem.style.display='none';
		targelem.style.visibility='hidden';
	}
}

/** Change Image */
function ci(ob_id, newImageSrc){
	if(isExistObjectHTML(ob_id)){
		document.getElementById(ob_id).src = newImageSrc;
	}
}

function display_box(id, size)
{
	for (var i=1; i<=size; i++)
	{
		if (i == id)
		{
			if ($('#more_'+i).is(":hidden"))
			{
				//$('html, body').animate({ scrollTop: $('#f_'+i).offset().top });
				$('#more_'+i).show();
				$('#less_'+i).hide();
				$('.expandable_'+i).removeClass("expand");
				$('.expandable_'+i).addClass("collapse");
			}
			else
			{
				$('#more_'+i).hide();
				$('#less_'+i).show();
				$('.expandable_'+i).removeClass("collapse");
				$('.expandable_'+i).addClass("expand");
			}
		}
		else
		{
			$('#more_'+i).hide();
			$('#less_'+i).show();
			$('.expandable_'+i).removeClass("collapse");
			$('.expandable_'+i).addClass("expand");
		}
	}
}

function loading(message) {
	if (message == null) {
		message = "Loading...";
	}
	message = "<div class='loading'>"+message+"</div>";
	$.fancybox({
		content: message
	});
}

/*
function msgbox(message) {
	message = "<div class='msgcontent'>"+message+"</div>";
	$.fancybox({
		content: message
	});
}*/

function msgbox(message, title) {
	if (title == null) {
		title = "Error";
	}
	msg = "<div id='myModal' class='reveal-modal medium'><h3>"+title+"</h3><p>"+message+"</p><a class='close-reveal-modal'>&#215;</a></div>";
	$("#myModal").remove();
	$('#footer').append(msg);
	$('#myModal').reveal({
		animation: 'fade',						//fade, fadeAndPop, none
		animationspeed: 300,					//how fast animtions are
		closeonbackgroundclick: true,			//if you click background will modal close?
		dismissmodalclass: 'close-reveal-modal'	//the class of a button or element that will close an open modal
	});
}

/** Check valid email address*/
function validateEmail(elementValue){        
	var emailPattern = /^[\w-]+(\.[\w-]+)*@([a-z0-9-]+(\.[a-z0-9-]+)*?\.[a-z]{2,6}|(\d{1,3}\.){3}\d{1,3})(:\d{4})?$/;  
	return emailPattern.test(elementValue);   
}

function formatNumber(num, fixed) {
	var decimalPart;
	
	var array = Math.floor(num).toString().split('');
	var index = -3; 
	while (array.length + index > 0) { 
		array.splice(index, 0, ',');
		index -= 4;
	}
	
	if (fixed > 0) {
		decimalPart = num.toFixed(fixed).split(".")[1];
		return array.join('') + "." + decimalPart;
	}
	return array.join('');
}