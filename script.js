var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var x = canvas.width / 2;
        var y = canvas.height - 30;
        var dx = 2;
        var dy = -2;
        var ballRadius = 10;
        var ballColor = "green";//barva žogice

        var paddleHeight = 10;
        var paddleWidth = 75;
        var paddleX = (canvas.width - paddleWidth) / 2;

        var rightPressed = false;
        var leftPressed = false;

        var brickRowCount = 6;
        var brickColumnCount = 5;
        var brickWidth = 80;
        var brickHeight = 20;
        var brickPadding = 10;
        var brickOffsetTop = 30;
        var brickOffsetLeft = 30;

        var bricks = []; //tabela bricksov
        for (var c = 0; c < brickColumnCount; c++) {
            bricks[c] = [];
            for (var r = 0; r < brickRowCount; r++) {
                bricks[c][r] = { x: 0, y: 0, status: 1 };
            }
        }

        var score = 0; 

        function drawBall() { //žogica
            ctx.beginPath();
            ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
            ctx.fillStyle = ballColor;
            ctx.fill();
            ctx.closePath();
        }

        function drawPaddle() { //plošček
            ctx.beginPath();
            ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
            ctx.fillStyle = "green";
            ctx.fill();
            ctx.closePath();
        }

        function drawBricks() { //bricksi
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

        function drawScore() { //rezultat
            ctx.font = "16px Arial";
            ctx.fillStyle = "green";
            ctx.fillText("REZULTAT: " + score, 8, 20);
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
                                alert("ZMAGA");
                                
                            }
                        }
                    }
                }
            }
        }

        function draw() {
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
                    alert("IZGUBIL SI");
                    document.location.reload();
                }
            }

            if (rightPressed && paddleX < canvas.width - paddleWidth) {
                paddleX += 7;
            } else if (leftPressed && paddleX > 0) {
                paddleX -= 7;
            }

            x += dx;
            y += dy;
        }

        document.addEventListener("keydown", function (e) {
            if (e.keyCode == 39) {
                rightPressed = true;
            } else if (e.keyCode == 37) {
                leftPressed = true;
            }
        });

        document.addEventListener("keyup", function (e) {
            if (e.keyCode == 39) {
                rightPressed = false;
            } else if (e.keyCode == 37) {
                leftPressed = false;
            }
        });

       /* document.addEventListener("mousemove", function (e) { //uporaba miške
            var relativeX = e.clientX - canvas.offsetLeft;
            if (relativeX > 0 && relativeX < canvas.width) {
                paddleX = relativeX - paddleWidth / 2;
            }
        });
		*/
        setInterval(draw, 10);
		
		start.addEventListener("click", () => {
			
		});