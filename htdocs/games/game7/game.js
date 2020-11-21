

function randomInteger(min, max) {
  var rand = min + Math.random() * (max - min)
  rand = Math.round(rand);
  document.calculator.number1.value = rand;
  //return rand;*/
 
}

var cvs = document.getElementById("canvas");
var ctx = cvs.getContext("2d");

var bird = new Image();
var bg = new Image();
var fg = new Image();
var pipeUp = new Image();
var pipeBottom = new Image();

bird.src = "img/dragon.png";
bg.src = "img/bg.png";
fg.src = "img/earth.png";
pipeUp.src = "img/pipeUp.png";
pipeBottom.src = "img/pipeBottom.png";

// Звуковые файлы
var fly = new Audio();
var score_audio = new Audio();

fly.src = "audio/fly.mp3";
score_audio.src = "audio/score.mp3";

var gap = 90;

// При нажатии на какую-либо кнопку
document.addEventListener("keydown", moveUp);


function moveUp(e) {
if(e.keyCode == '37') xPos -= 30; 
if(e.keyCode == '39') xPos += 30;
if(e.keyCode == '38') yPos -= 30; 
if(e.keyCode == '40') yPos += 30;
fly.play(); 
} 

// Создание блоков
var pipe = [];

pipe[0] = {
 x : cvs.width,
 y : 0
}

var score = 0;
// Позиция птички
var xPos = 10;
var yPos = 150;

var grav = 1.0;

function draw() {

 ctx.drawImage(bg, 0, 0);

 for(var i = 0; i < pipe.length; i++) {
 
     ctx.drawImage(pipeUp, pipe[i].x, pipe[i].y);
     
	 ctx.drawImage(pipeBottom, pipe[i].x, pipe[i].y + pipeUp.height + gap);

     pipe[i].x--;

     if(pipe[i].x == 75) {
		 pipe.push({
		 x : cvs.width,
		 y : Math.floor(Math.random() * pipeUp.height) - pipeUp.height
     });
 }

     // Отслеживание прикосновений
     if(xPos + bird.width >= pipe[i].x && xPos <= pipe[i].x + pipeUp.width && (yPos <= pipe[i].y + pipeUp.height  || yPos + bird.height >= pipe[i].y + pipeUp.height + gap) || yPos + bird.height >= cvs.height - fg.height) {
		location.reload(); // Перезагрузка страницы
     }

     if(pipe[i].x == 5) {
         score++;
         score_audio.play();
    }
 }

 ctx.drawImage(fg, 0, cvs.height - fg.height);
 
 ctx.drawImage(bird, xPos, yPos);

 yPos += grav;

 ctx.fillStyle = "#FF0000";
 ctx.font = "24px Verdana";
 ctx.fillText("Счет: " + score, 10, cvs.height - 20);

 requestAnimationFrame(draw);
}

pipeBottom.onload = draw;
