 <?php
 $user = $_GET['name'];
 $device = $_GET['device'];
 ?>
 
 <html>
 <head>
 <title>SET COLOR</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script LANGUAGE="JavaScript">
<!-- Begin
addary = new Array();           //red
addary[0] = new Array(0,1,0);   //red green
addary[1] = new Array(-1,0,0);  //green
addary[2] = new Array(0,0,1);   //green blue
addary[3] = new Array(0,-1,0);  //blue
addary[4] = new Array(1,0,0);   //red blue
addary[5] = new Array(0,0,-1);  //red
addary[6] = new Array(255,1,1);
clrary = new Array(360);
for(i = 0; i < 6; i++)
for(j = 0; j < 60; j++) {
  clrary[60 * i + j] = new Array(3);
  for(k = 0; k < 3; k++) {
    clrary[60 * i + j][k] = addary[6][k];
    addary[6][k] += (addary[i][k] * 4);
    }
  }
hexary = new Array("#666666", "#555555", "#545657");
picary = new Array("picka", "pickb", "pickc", "pickd", "picke", "pickf", "pickg");
initary = new Array("#444444", "#777777", "#aaaaaa",  "#bbbbbb", "#cccccc", "#dddddd", "#eeeeee");
pickindex = 0;

function capture() {
 hoverColor();
 if(document.layers) {
  layobj = document.layers['wheel'];
  layobj.document.captureEvents(Event.MOUSEMOVE);
  layobj.document.onmousemove = mouseMoved;
 }
 else if (document.all) {
  layobj = document.all["wheel"];
  layobj.onmousemove = mouseMoved;
   }
 else if (document.getElementById) {
  window.document.getElementById("wheel").onmousemove = mouseMoved;
 }
}

function mouseMoved(e) {
 if (document.layers) {
  x = 4 * e.layerX;
  y = 4 * e.layerY;
 }
 else if (document.all) {
  x = 4 * event.offsetX;
  y = 4 * event.offsetY;
 }
 else if (document.getElementById) {
  x = 4 * (e.pageX - document.getElementById("wheel").offsetLeft);
  y = 4 * (e.pageY - document.getElementById("wheel").offsetTop);
 }
 sx = x - 512;
 sy = y - 512;
 qx = (sx < 0)?0:1;
 qy = (sy < 0)?0:1;
 q = 2 * qy + qx;
 quad = new Array(-180,360,180,0);
 xa = Math.abs(sx);
 ya = Math.abs(sy);
 d = ya * 45 / xa;
 if(ya > xa) d = 90 - (xa * 45 / ya);
 deg = Math.floor(Math.abs(quad[q] - d));
 n = 0;
 sx = Math.abs(x - 512);
 sy = Math.abs(y - 512);
 r = Math.sqrt((sx * sx) + (sy * sy));
 if(x == 512 & y == 512) {c = "000000";}
 else {
   for(i = 0; i < 3; i++) {
     r2 = clrary[deg][i] * r / 256;
     if(r > 256) r2 += Math.floor(r - 256);
     if(r2 > 255) r2 = 255;
     n = 256 * n + Math.floor(r2);
   }
   c = n.toString(16);
   while(c.length < 6) c = "0" + c;
 }
         hexary[1] =  c.charAt(0) + c.charAt(0) + c.charAt(2) + c.charAt(2) + c.charAt(4) + c.charAt(4);
   hoverColor();
   setRgb();
   return false;
}

function hoverColor() {
 if (document.layers) {
  document.layers["wheel"].bgColor = hexary[1];
  document.layers["demob"].bgColor = hexary[1];
  document.layers["demob"].document.aaaform.abc.value = hexary[1];
 } else if (  document.all) {
  document.all["wheel"].style.backgroundColor = hexary[1];
  document.all["demob"].style.backgroundColor = hexary[1];
  document.all["demob"].document.aaaform.aaa.value = hexary[1];
 } else if (document.getElementById) {
  document.getElementById("wheel").style.backgroundColor = hexary[1];
  document.getElementById("demob").style.backgroundColor = hexary[1];
  document.aaaform.aaa.value = hexary[1];
 }
 return false;
}

function setRgb() {
var r=document.getElementById('red');
var g=document.getElementById('green');
var b=document.getElementById('blue');
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hexary[1]);
        r.innerHTML= parseInt(result[1], 16),
        g.innerHTML= parseInt(result[2], 16),
        b.innerHTML= parseInt(result[3], 16) 
}
function pickColor() 
{
   document.getElementById("picka").style.backgroundColor = hexary[1];
}
//  End -->
</script>


<style type="text/css">
div#wheel {position:absolute; visibility:visible; top:50px; left:20px; width: 256px; height: 256px;}
div#demob {position:absolute; visibility:visible; top:50px; left:760px;height: 60px;width: 100px;   margin-left: 0px;  margin-right: 0px;}
div#msg1 {position:absolute; visibility:visible; top:80px;left:400px ; }
div#msg2 {position:absolute; visibility:visible; top:190px;left:400px ; }
div#picka {position:absolute;visibility:visible;top:150px; left:760px; height: 60px; width: 100px;margin-left: 0px;  margin-right: 0px;}
label#red {position:absolute; visibility:visible; top:80px;left:880px ;}
label#green {position:absolute; visibility:visible; top:80px;left:920px ;}
label#blue {position:absolute; visibility:visible; top:80px;left:980px ;}
button{position:absolute; visibility:visible; top:250px;left:700px ; }
</style>
</head>

<body onLoad="capture()">

<h1 align="center">Choose a Color</h1>
<?php echo $device ?>
<!-- on the left, the wheel and display -->
<div id="wheel" align="center">
<a href="javascript://" onclick="javascript:pickColor(); return false"><img src="colorwheel.png" alt="color wheel" width="256" height="256" border="0"></a>
</div>


<div id="msg1">PRESENT COLOR POINTING BY THE CURSOR</div>
<div id="msg2">COLOR SELECTED</div>
<div id="demob">
<form name="aaaform">
<input type="text" name="aaa" size="9">
</form>
</div>
<form>
<label id="red" >RED</label>
<label id="green">GREEN</label>
<label id="blue" >BLUE</label>
<button >SET COLOR</button>
</form>

<!-- on the right, the picks and instructions -->
<div id="picka"></div>

</body>
</html>

