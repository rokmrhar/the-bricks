<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/x-icon" href="slike/favicon.webp">
        <title>Gambling Room</title>
        <style>
            * {
                padding: 0;
                margin: 0;
                font-family: 'Arial', sans-serif;
            }
            html, body {
                min-height: 100%;
                max-width: 100%;   
            }
            body {
                background-image: linear-gradient(rgba(0, 0, 0, 0.7)), url("slike/ozadje.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                color: #fff;
            }
            #glavni {
                width: 100%;
            }
            #naslov {
                color: #ffd700;         
                text-align: center;
                margin: 50px auto;
                width: 80%;
                font-weight: bold;
                font-size: 3.0rem;
                text-transform: uppercase;
                letter-spacing: 3px;
                text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            }
            #igrac {
                width: 100%;
                display: flex;
                justify-content: center;
                gap: 30px;
                margin-bottom: 40px;
            }
            .podium {
                min-height: 150px;
                width: 100%;
                font-weight: bold;
                text-transform: uppercase;
                padding: 20px;
                background-color: rgba(0, 60, 120, 0.6);
                border-radius: 10px;
                border: 2px solid #ffd700;
                font-size: 1.3rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .posebn {
                color: #ffd700;
                font-size: 1.8rem;
                text-align: center;
                text-shadow: 0 0 5px rgba(255, 215, 0, 0.7);
            }
            #izbira {
                text-align: center;
                font-size: 1.5rem;
                color: #ffd700;
                margin-top: 30px;
            }
            mark#cas {
                background-color: transparent;
                color: #ffd700;
                font-weight: bold;
                font-size: 1.8rem;
            }
            .gumb {
                display: inline-block;
                padding: 15px 40px;
                background-color: #d4af37; 
                color: #000;
                text-align: center;
                text-decoration: none;
                font-size: 1.3rem;
                font-weight: bold;
                border-radius: 8px;
                transition: all 0.3s ease;
                margin-top: 30px;
                border: none;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            .gumb:hover {
                background-color: #ffd700;
                transform: translateY(-3px);
            }
        </style>
    </head>
    <body>
        <div id="naslov">
            <h1>REZULTATI</h1>
        </div>
        <div id="glavni">
            <div id="igrac">               
				<div class="igralec posebn">
					<?php
					if($_SESSION["vsota1"] == $_SESSION["vsota2"] && $_SESSION["vsota1"] == $_SESSION["vsota3"]) {
						echo "Zmagovalci so: " . $_SESSION["i1"] . " in " . $_SESSION["i2"] . " in " . $_SESSION["i3"];
					} elseif ($_SESSION["vsota1"] == $_SESSION["vsota2"] && $_SESSION["vsota1"] > $_SESSION["vsota3"]) {
						echo "Zmagovalca sta: " . $_SESSION["i1"] . " in " . $_SESSION["i2"];
					} elseif ($_SESSION["vsota3"] == $_SESSION["vsota2"] && $_SESSION["vsota2"] > $_SESSION["vsota1"]) {
						echo "Zmagovalca sta: " . $_SESSION["i2"] . " in " . $_SESSION["i3"];
					} elseif ($_SESSION["vsota1"] == $_SESSION["vsota3"] && $_SESSION["vsota1"] > $_SESSION["vsota2"]) {
						echo "Zmagovalca sta: " . $_SESSION["i1"] . " in " . $_SESSION["i3"];
					} elseif ($_SESSION["vsota3"] < $_SESSION["vsota1"] && $_SESSION["vsota1"] > $_SESSION["vsota2"]) {
						echo "Zmagovalec je: " . $_SESSION["i1"];
					} elseif ($_SESSION["vsota1"] < $_SESSION["vsota2"] && $_SESSION["vsota2"] > $_SESSION["vsota3"]) {
						echo "Zmagovalec je: " . $_SESSION["i2"];
					} elseif ($_SESSION["vsota1"] < $_SESSION["vsota3"] && $_SESSION["vsota3"] > $_SESSION["vsota2"]) {
						echo "Zmagovalec je: " . $_SESSION["i3"];
					}
					?>
				</div>
			</div>
            <div id="izbira">REZULTATI SE BODO IZBRISALI ČEZ: <mark id="cas">10</mark></div>
        </div>
        <script>
            function redirTimer() { 
                self.setTimeout("self.location.href='index.php';", 10000);
            } 
            redirTimer();

            var seconds_left = 10; 
            setInterval(function() {
                document.getElementById('cas').innerHTML = --seconds_left;
            }, 1000);
        </script>
    </body>
</html>