
var cvs = document.getElementById("canvas");
var ctx = cvs.getContext("2d");

var bird = new Image();
var bg = new Image();
var fg = new Image();
var pipe1 = new Image();
var pipe2 = new Image();
var pipe3 = new Image();

bird.src = "img/bird.png";
bg.src = "img/bg.png";
fg.src = "img/fg.png";
pipe1.src = "img/pipe.png";
pipe2.src = "img/pipe.png";
pipe3.src = "img/pipe.png";

// Звуковые файлы
var fly = new Audio();
var score_audio = new Audio();

fly.src = "audio/fly.mp3";
score_audio.src = "audio/score.mp3";

var gap = 90;

// При нажатии на какую-либо кнопку
document.addEventListener("keydown", moveUp);

function moveUp(e) {
	
    switch(e.keyCode) {
    case 40:
        yPos += 25;
        break;
    case 38:
         yPos -= 25;
        break;
	case 37:
        xPos -= 25;
        break;
	case 39:
        xPos += 25;
        break;	
    }

}

// Создание блоков
var pipe = [];

pipe[0] = {
 x : cvs.width,
 y : 0
}
var f = 0;
var score = 0;
// Позиция птички
var xPos = 10;
var yPos = 150;
//var grav = 1.5;

function draw() {
 ctx.drawImage(bg, 0, 0);

 for(var i = 0; i < pipe.length; i++) {
     ctx.drawImage(pipe1, pipe[i].x, pipe[i].y);
     ctx.drawImage(pipe2, pipe[i].x, pipe[i].y + pipe1.height + gap);
	 ctx.drawImage(pipe3, pipe[i].x, pipe[i].y + pipe1.height + gap + pipe2.height + gap);
	
	if (f < 40){
		pipe[i].y-=0.5;
		f++;
	}
	else
	{
		if (f >= 40){
			pipe[i].y+=0.5;
			f--;
		}
	}
     pipe[i].x--;

     if(pipe[i].x == 125) {
     pipe.push({
     x : cvs.width,
     y : Math.floor(Math.random() * pipe1.height) - pipe1.height
     });
 }

     // Отслеживание прикосновений
     if(xPos + bird.width >= pipe[i].x
     && xPos <= pipe[i].x + pipe1.width
     && (yPos <= pipe[i].y + pipe1.height
     || yPos + bird.height >= pipe[i].y + pipe1.height + gap)
	 
	 && (yPos >= pipe[i].y + pipe1.height + gap + pipe2.height + gap
     || yPos + bird.height <= pipe[i].y + pipe1.height + gap + pipe2.height + gap)
	 
	 || yPos + bird.height >= cvs.height - fg.height) {
     location.reload(); // Перезагрузка страницы
     }

     if(pipe[i].x == 5) {
         score++;
         score_audio.play();
    }
 }

 ctx.drawImage(fg, 0, cvs.height - fg.height);
 ctx.drawImage(bird, xPos, yPos);

 //yPos += grav;

 ctx.fillStyle = "#000";
 ctx.font = "24px Verdana";
 ctx.fillText("Счет: " + score, 10, cvs.height - 20);
 

 requestAnimationFrame(draw);
}

pipe2.onload = draw;

