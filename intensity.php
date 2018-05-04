 <?php
 $user = $_GET['name'];
 $device = $_GET['device'];
 ?>
 
 <html>
 <head>
 <title>SET INTENSITY</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
 .slidecontainer 
 {
    width: 100%;
 }
 .slider 
{
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover
 {
    opacity: 1;
}

.slider::-webkit-slider-thumb
 {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb
 {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}
.modal
 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content
 {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close 
{
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus 
{
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
 </style>
 </head>
 <body>
<p>Choose the INTENSITY</p>
<?php echo $device?>
<iframe width="0" height="0" border="0" name="dummyframe" id=dummyframe"></iframe>
<form action="http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/test.php?" method="get" target="dummyframe">
<h1>Intensity</h1>
<div class="""slidecontainer">
<input type="hidden" name="cid" value=2 readonly>
<input type="range" min="0" max="1023" value="512" class="slider" id="myRange" name="intensity">
<input type="hidden" name="pass" value=123 readonly>
<input type="hidden" name="trun" value=0 readonly>
  <p>Value: <span id="demo"></span></p>
<script>
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;
    slider.oninput = function () 
    {
        output.innerHTML = this.value;
    }
	
</script>
<input id="Set" type="submit" value="Set"  >
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p id="model"></p>
  </div>
</div>

<script>
var modal = document.getElementById('myModal');
var btn = document.getElementById("Set");
var span = document.getElementsByClassName("close")[0];
var slider1 = document.getElementById("myRange");
var model = document.getElementById("model");

// When the user clicks the button, open the modal 
btn.onclick = function() 
{
    modal.style.display = "block";
	model.innerHTML="Intensity Of the Light Was Set to :"+slider1.value; 
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() 
{
    modal.style.display = "none";
}
</script>
</form>
 </body>
 </html>