var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var ballRadius = 10;
var ballColor = "green";
var paddleHeight = 10;
var paddleWidth = 75;
var brickRowCount = 6;
var brickColumnCount = 5;
var brickWidth = 80;
var brickHeight = 20;
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
var sekunde;
var sekundeI;
var minuteI;
var intTimer;
var izpisTimer;



function initBricks() {
    bricks = [];
    for (var c = 0; c < brickColumnCount; c++) {
        bricks[c] = [];
        for (var r = 0; r < brickRowCount; r++) {
            bricks[c][r] = { x: 0, y: 0, status: 1 };
        }
    }
}

function resetGame() {
    if (animationId) {
        cancelAnimationFrame(animationId);
        animationId = null;
    }
    x = initialX;
    y = initialY;
    dx = initialDx;
    dy = initialDy;
    paddleX = initialPaddleX;
    score = 0;
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
        gameRunning = true;
        draw(); 
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
    ctx.fillStyle = "green";
    ctx.fill();
    ctx.closePath();
}
function drawBricks() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            if (bricks[c][r].status == 1) {
                var brickX = (c * (brickWidth + brickPadding)) + brickOffsetLeft;
                var brickY = (r * (brickHeight + brickPadding)) + brickOffsetTop;
                bricks[c][r].x = brickX;
                bricks[c][r].y = brickY;
                ctx.beginPath();
                ctx.rect(brickX, brickY, brickWidth, brickHeight);
                ctx.fillStyle = "green";
                ctx.fill();
                ctx.closePath();
            }
        }
    }
}
function timer(){
sekunde++;

sekundeI = ((sekundeI = (sekunde % 60)) > 9) ? sekundeI : "0"+sekundeI;
minuteI = ((minuteI = Math.floor(sekunde / 60)) > 9) ? minuteI : "0"+minuteI;
izpisTimer = minuteI + ":" + sekundeI;

$("#cas").html(izpisTimer);
}
function drawScore() {
    ctx.font = "16px Arial";
    ctx.fillStyle = "green";
    ctx.fillText("REZULTAT: " + score, 8, 20);
	
	ctx.fillText("Score: " + score + "  Time: " + izpisTimer, 8, 20);
}
function collisionDetection() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            var b = bricks[c][r];
            if (b.status == 1) {
                if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {
                    dy = -dy;
                    b.status = 0;
                    score++;
                    if (score == brickRowCount * brickColumnCount) {
                        Swal.fire({
						  title: "ZMAGAL SI!",
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
			title: "IZGUBIL SI !",
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


document.getElementById("start").addEventListener("click", startGame);
document.getElementById("reset").addEventListener("click", resetGame);

resetGame();