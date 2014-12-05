<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">              
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include "header.html"?>
	<link rel="canonical" href="cancer.unc.edu/majorlab/" />
	<title>Major Lab</title>
	<script type="text/javascript" src="js/PPI.js"></script>
	<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function(){
		var v = document.getElementById('cells_video');
		var canvas = document.getElementById('cells_canvas');
		var context = canvas.getContext('2d');
	  
		var cw = Math.floor(canvas.clientWidth / 100);
		var ch = Math.floor(canvas.clientHeight / 100);
		canvas.width = cw;
		canvas.height = ch;
	  
		v.addEventListener('play', function(){
			drawV(this,context,cw,ch);
		},false);
	  
		v.onmouseover = function() {
			v.play();
		}
		v.onmouseout = function() {
			v.pause();
		}
	  
	},false);
      
	function drawV(v,c,w,h) {
		if(v.paused || v.ended) return false;
		c.drawImage(v,0,0,w,h);
		setTimeout(drawV,20,v,c,w,h);
	}
	</script>
	<script type="text/javascript" src="js/google-analytics.js"></script>
</head>
<body>
	<div id="wrap">
		<?php include "navbar.html";?>

		<div id="stripe2">
	
			<div id="str2">
				<div class="innerdiv" style="height:470px; overflow: hidden; background-color: #000;">
					<div id="splash-left">
						<canvas id="PPI_canvas"></canvas>
					</div>		
					<div id="splash-center">
						<canvas id="cells_canvas" style="display:none"></canvas>
						<video id="cells_video" loop="loop" onended="this.play()" style="display:none">
							<source src="video/cells.webm" type="video/webm"/>
						</video>	      
					</div>
					<div id="splash-right">
						<canvas id="workflow_canvas"></canvas>
					</div>
					<div style="clear: both;"></div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.html";?>
</body>
</html>
