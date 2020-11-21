
var fieldW = 40;
var fieldH = 25;
var pixelSize = 20;
//var cord = [];



function draw() {
  var canvas = document.getElementById('canvas');
  if (canvas.getContext){
    var ctx = canvas.getContext('2d');
	ctx.fillRect(10, 10, 555, 455);
	for(int i = 0; i < fieldH; i++) {
		for(int j = 0; j < fieldW; j++) {
				ctx.fillStyle = "#FFF";
				//ctx.rect(j*pixelSize, i*pixelsize, pixelSize, pixelSize, true);
				ctx.arc(0,0, 30, 0, 6.28, true);
				ctx.fill;
		}
	}
	
  }
}

draw();


