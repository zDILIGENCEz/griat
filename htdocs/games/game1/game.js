var cvs = document.getElementById("canvas"); 
var ctx = cvs.getContext("2d"); 

var bird = new Image(); 
var bg = new Image(); 
var fg = new Image(); 
var pipeUp = new Image(); 
var pipeBottom = new Image(); 

bird.src = "img/bird2.png"; 
bg.src = "img/bg.jpg"; 
fg.src = "img/fg.png"; 
pipeUp.src = "img/pipeUp.png"; 
pipeBottom.src = "img/pipeBottom.png"; 

// Звуковые файлы 
var fly = new Audio(); 
var score_audio = new Audio(); 

fly.src = "audio/fly.mp3"; 
score_audio.src = "audio/score.mp3"; 

var gap = 90; 

// При нажатии на какую-либо кнопку 
document.addEventListener('keydown', 
function(e) 
{ 
moveUp(e); 
} 
); 

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
x : 0, 
y : 0 
} 

var score = 0; 
// Позиция черепашки
var xPos = cvs.width/2; 
var yPos = (cvs.height*2)/3; 
var grav = 1.5; 

function draw() { 
ctx.drawImage(bg, 0, 0); 

for(var i = 0; i < pipe.length; i++) { 
ctx.drawImage(pipeUp, pipe[i].x, pipe[i].y); 
ctx.drawImage(pipeBottom, pipe[i].x + pipeUp.width + gap, pipe[i].y); 

pipe[i].y++; 

if(pipe[i].y == 160) { 
pipe.push({ 
x : Math.floor(Math.random() * pipeUp.width) - pipeUp.width, 
y : 0 
}); 
} 

// Отслеживание прикосновений 
if((yPos > pipe[i].y - 1) && (yPos < pipe[i].y + 1)) 
if((xPos <= pipe[i].x + pipeUp.width) 
|| (xPos >= pipe[i].x + pipeUp.width + gap + 3)) { 
location.reload(); // Перезагрузка страницы 
} 

if(pipe[i].y == 360) { 
score++; 
score_audio.play(); 
} 
} 

ctx.drawImage(fg, 0, cvs.height - fg.height); 
ctx.drawImage(bird, xPos, yPos); 

//yPos += grav; 

ctx.fillStyle = "#000"; 
ctx.font = "24px Verdana"; 
ctx.fillText("Score: " + score, 10, cvs.height - 20); 

requestAnimationFrame(draw); 
} 

pipeBottom.onload = draw;