var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var ballRadius = 10;
var ballColor = "#FFD700"; //barva balke
var paddleHeight = 10; //velikost palce
var paddleWidth = 75; //širina palce
var brickRowCount = 6;
var brickColumnCount = 11;
var brickWidth = 70; //širina slike
var brickHeight = 50; //višina slike
var brickPadding = 10;
var brickOffsetTop = 30;
var brickOffsetLeft = 30;
var initialX = canvas.width / 2;
var initialY = canvas.height - 30;
var initialDx = 2;
var initialDy = -2;
var initialPaddleX = (canvas.width - paddleWidth) / 2;
var x, y, dx, dy, paddleX;
var rightPressed = false;
var leftPressed = false;
var score = 0;
var gameRunning = false;
var animationId = null;
var bricks = [];
var brickImages = [
	"box40.png",
	"box75.png",
	"box.png"
];

function initBricks() {
    bricks = [];
    for (var c = 0; c < brickColumnCount; c++) {
        bricks[c] = [];
        for (var r = 0; r < brickRowCount; r++) {
            bricks[c][r] = { 
			x: 0, 
			y: 0, 
			status: 1,
			lives: 3};
        }
    }
}

function resetGame() {
    if (animationId) {
        cancelAnimationFrame(animationId);
        animationId = null;
    }
	if (intTimer) {
        clearInterval(intTimer);
    }
    x = initialX;
    y = initialY;
    dx = initialDx;
    dy = initialDy;
    paddleX = initialPaddleX;
    score = 0;
	izpisTimer = "00:00";
	sekunde = 0;
    gameRunning = false;
    initBricks();
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawBricks();
    drawBall();
    drawPaddle();
    drawScore();
}

function startGame() {
    if (!gameRunning) {
        resetGame(); 
		intTimer = setInterval(timer, 1000);
        gameRunning = true;
        draw(); 
		drawBricks();
		timer();
    }
}
function drawBall() {
    ctx.beginPath();
    ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
    ctx.fillStyle = ballColor;
    ctx.fill();
    ctx.closePath();
}
function drawPaddle() {
    ctx.beginPath();
    ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
    ctx.fillStyle = "#8B4513"; //barva ploščka
    ctx.fill();
    ctx.closePath();
}
function drawBricks() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            var b = bricks[c][r];
            if (b.status == 1) {
                var brickX = (c * (brickWidth + brickPadding)) + brickOffsetLeft;
                var brickY = (r * (brickHeight + brickPadding)) + brickOffsetTop;
                b.x = brickX;
                b.y = brickY;
                var currentBrickImage = new Image();
                currentBrickImage.src = brickImages[b.lives - 1];
                ctx.drawImage(currentBrickImage, brickX, brickY, brickWidth, brickHeight);
            }
        }
    }
}
var sekunde;
var sekundeI;
var minuteI;
var intTimer;
var izpisTimer;
//timer
function timer() {
sekundeI = (sekunde % 60 > 9) ? sekunde % 60 : "0" + (sekunde % 60);
minuteI = (Math.floor(sekunde / 60) > 9) ? Math.floor(sekunde / 60) : "0" + Math.floor(sekunde / 60);
izpisTimer = minuteI + ":" + sekundeI;
sekunde++;
}
function drawScore() {
    ctx.font = "bold 19px Arial ";
    ctx.fillStyle = "#3d2f45";
    ctx.fillText("POINTS: " + score + "  " + "  TIME: " + izpisTimer, 8, 20);
}
function collisionDetection() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            var b = bricks[c][r];
            if (b.status == 1) {
                if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {
                    dy = -dy;
                    b.lives--; 
                    if (b.lives <= 0) {
                        b.status = 0;
                    }
                    score++;
                    if (score == brickRowCount * brickColumnCount) {
                        Swal.fire({
                            title: "YOU WON!",
                            icon: "success"
                        });
                        resetGame();
                    }
                }
            }
        }
    }
}
function draw() {
    if (!gameRunning) return;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawBricks();
    drawBall();
    drawPaddle();
    drawScore();
    collisionDetection();
    if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {
        dx = -dx;
    }
    if (y + dy < ballRadius) {
        dy = -dy;
    } else if (y + dy > canvas.height - ballRadius) {
        if (x > paddleX && x < paddleX + paddleWidth) {
            dy = -dy;
        } else {
            gameRunning = false;
            Swal.fire({
			title: "GAME OVER!",
			icon: "warning"
})
            resetGame();
            return;
        }
    }
    if (rightPressed && paddleX < canvas.width - paddleWidth) {
        paddleX += 7;
    } else if (leftPressed && paddleX > 0) {
        paddleX -= 7;
    }
    x += dx;
    y += dy;
    animationId = requestAnimationFrame(draw);
}
document.addEventListener("keydown", function(e) {
    if (e.keyCode == 39) {
        rightPressed = true;
    } else if (e.keyCode == 37) {
        leftPressed = true;
    }
});
document.addEventListener("keyup", function(e) {
    if (e.keyCode == 39) {
        rightPressed = false;
    } else if (e.keyCode == 37) {
        leftPressed = false;
    }
});
//const points = document.getElementByClass("points");

const infoBtn = document.getElementById("info");
infoBtn.addEventListener("click", () => {
    Swal.fire({
        icon: "info",
        title: "The Bricks",
        heightAuto: true,
		footer: '<a target="_blank" href="https://github.com/rokmrhar/the-bricks">SEE MORE ABOUT THIS PROJECT</a>'
    });
});

document.getElementById("start").addEventListener("click", startGame);
document.getElementById("reset").addEventListener("click", resetGame);

resetGame();

window.onload = function () {
Swal.fire({
        icon: "info",
        title: "Welcome",
		html: 'Press <b>START</b> button to start the game. <br> Use <b>LEFT</b> and <b>RIGHT</b> key to move the paddle. <br> Each brick has 3 lives.',
        heightAuto: true,
    });
}