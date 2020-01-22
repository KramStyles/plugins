
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HTML - JQuery converter v2.0</title>
<script language="javascript" type="text/javascript" src="jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="extensions.js"></script>
<script>
function addslashes( str ) {
    return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

function outputCode(a,b,p){
	var noat = 0;
	if(typeof(a)=='string') {
		a = $('<div>').html(a);
		noat = 1
	}
	if(!noat){
		var tag = $(a).prop('nodeName').toLowerCase();//the tag
		var jqueRy = "$('<"+tag+">')";
		var element = $(a)[0];
		var attr = new Array, clAss = '', thiS, style = '', css = new Array;
		for(var i = 0, ch = element.attributes, l = element.attributes.length; i<l; i++)
		{
			thiS = ch[i];
			if(thiS.nodeName == 'class'){
				clAss = ".addClass('"+thiS.nodeValue+"')";
			}else if(thiS.nodeName == 'style'){
				style = thiS.nodeValue;
				var styr = style.split(';');
				for(var x = 0; x < styr.length; x++){
					if(!styr[x])continue;
					var y = styr[x].split(':');
					y = "'"+y[0].trim()+"':'"+y[1].trim()+"'";
					css.push(y);
				}
			}else{
				attr.push("'"+thiS.nodeName+"':'"+thiS.nodeValue+"'");
			}
			thiS = '';
		}
		//Rebuild the elements;
		if(clAss){
			jqueRy += clAss;
		}
		if(attr.length){
			jqueRy +='.attr({'+attr+'})';
		}
		if(css.length){
			jqueRy +='.css({'+css+'})';
		}
		if(element.firstChild && element.firstChild.nodeValue!=null && element.firstChild.nodeValue.trim()!='') {

			jqueRy +=".text('"+addslashes(element.firstChild.nodeValue)+"')";
		}

	}else jqueRy = '';//Has children

	$(a).children().each(function(){
		jqueRy = outputCode(this,jqueRy,noat);
	});
	if(b != undefined && b != null && b != 0){ //b = jqueRy if it's defined
		if(p == 1){// noat = 1
			b += ";"+jqueRy;
		}else{
			b += '.append('+jqueRy+')';
		}
	}else b = jqueRy;
	return b;
}

</script>
<style>
.half
{
	float: left;
	width: 50%;
	height: 90%;
	box-sizing: border-box;
	padding: 20px;
	background: #74301a;
	position: relative;
}
textarea
{
	width:100% !important;
	height:100% !important;
}
html,body
{
	height:100%;
	width:100%;
	background-color:#d2c8c1;
	margin: 15px 0 0 0 ;
	overflow: hidden;
}
button {
    color: #ecfbfb;
    border-radius: 2px;
    background-color: #1565C0 !important;
    border-radius: 2px;
    cursor: pointer;
    position: absolute;
    left: 20px;
    padding: 5px 10px;
    bottom: 13px;
    z-index: 5;
    border: none;
	font-size: 14px;
}
.container{
	float: left;

	height: 100vh;
	width: 100%
}
.clear {
	cursor: pointer;
    position: absolute;
    top: 26px;
    right: 20px;
    color: white;
    background-color: #f006;
    padding: 0px 8px;
    line-height: 20px;
    height: 25px;
    font-style: italic;
	font-size: 14px;

}
button:hover, .clear:hover{
	transition: 0.4s all;
	color: orangered;
	font-size: 16px;
	background-color: floralwhite !important;
	border-radius: 5px;
}
</style>
</head>

<body>

<div class="container">
	<div class="half">
		<textarea placeholder="Place your HTML codes here" cols="" rows="" id="input" onClick="selectall(this)" onBlur="unselect(this)"></textarea>
		<button id="run">Convert</button>
		<span class="clear" onClick="clearx(this)">x</span>
	</div>

	<div class="half">
		<textarea placeholder="JQUERY would be displayed here" cols="" rows="" id="output" onClick="selectall(this)" onBlur="unselect(this)"></textarea>
		<span class="clear" onClick="clearx(this)">x</span>
	</div>

</div>

<script>
	$('#run').click(function(){
		var val=outputCode($('#input').val());
		$('#output').val(val);
	})
function selectall(x){
	var $this = $(x);
	var text_val=eval($this);
	text_val.focus();
	text_val.select();
}
function unselect(x){
	var $this = $(x);
	$this.focus();
}
function clearx(x){
	var $this = $(x).parent().find('textarea');
	$this.val('');
}
</script>
</body>
</html>
