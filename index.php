<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/x-icon" href="slike/favicon.webp">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="js/script.js" defer></script>
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
            .glavni {
                width: 100%;
            }
            .naslov {
                color: #ffd700;         
                text-align: center;
                margin: 50px auto;
                width: 80%;
                font-weight: bold;
                font-size: 3.0rem;
                text-transform: uppercase;
                letter-spacing: 3px;
            }
            #vnos {
                margin: 50px auto;
                position: relative;
                text-align: center;
                width: 80%;
                color: #fff;
                background-color: rgba(0, 40, 80, 0.8);
                padding: 30px;
                border-radius: 15px;
            }
            #igra {
                width: 100%;
                display: flex;
                justify-content: center;
                gap: 30px;
                margin-bottom: 40px;
            }
            .igralec {
                min-height: 150px;
                width: 100%;
                font-weight: bold;
                text-transform: uppercase;
                padding: 20px;
                background-color: rgba(0, 60, 120, 0.6);
                border-radius: 10px;
                border: 2px solid #ffd700;
                font-size: 1.3rem;
            }
            .igralec input {
                margin-top: 15px;
                font-size: 1.2rem;
            }
            #izbira {
                text-align: center;
                font-size: 1.3rem;
                margin-top: 30px;
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
            input[type="text"] {
                padding: 12px;
                border-radius: 6px;
                border: 2px solid #ffd700;
                background-color: rgba(255, 255, 255, 0.9);
                font-size: 1.1rem;
                width: 80%;
                text-align: left;
            }
            select {
                padding: 10px 15px;
                border-radius: 6px;
                margin: 0 15px;
                font-size: 1.1rem;
                background-color: rgba(255, 255, 255, 0.9);
                border: 2px solid #ffd700;
                color: #000;
            }
            option {
                background-color: #fff;
                color: #000;
            }
			.swal2-footer {
				color: white;
			}
        </style>
    </head>
    <body>
        <?php
            session_start();
            $_SESSION["vsota1"] = 0;
            $_SESSION["vsota2"] = 0;
            $_SESSION["vsota3"] = 0;
            $_SESSION["stevc"] = 0;
            $_SESSION["da"] = true;
        ?>

        <div class="glavni">
            <div class="naslov">
                <h1>GAMBLING ROOM</h1>
            </div>
            <div id="vnos">
                <form action="igra.php" name="forma" method="post">
                    <div id="igra">               
                        <div class="igralec">IGRALEC 1 <br>Ime: <input type="text" name="ime1" autofocus required/></div>
                        <div class="igralec">IGRALEC 2 <br>Ime: <input type="text" name="ime2" required/></div>
                        <div class="igralec">IGRALEC 3 <br>Ime: <input type="text" name="ime3" required/></div>
                    </div>
                    <div id="izbira">
                        Število kock
                        <select name="stkock">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        Število iger
                        <select name="stIger">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select> 
                        <br>
						<button type="button" id="navodila" class="gumb">NAVODILA</button>
                        <input type="submit" class="gumb" onClick="return isEmpty()" name="igraj" value="IGRAJ"/>
						<button type="button" id="info" class="gumb" >INFO</button>
                    </div>
                </form>
            </div>                   
        </div>
        <script>
            function isEmpty() {
                var ime1 = document.forms['forma'].ime1.value;
                var ime2 = document.forms['forma'].ime2.value;
                var ime3 = document.forms['forma'].ime3.value;
                
                if(ime1 == "" || ime2 == "" || ime3 == "") {
                    Swal.fire({
						title: "NAPAKA",
						html: '<b> VNESI VSA 3 IMENA </b>',
						icon: "warning",
						theme: 'dark',
						confirmButtonColor: '#ffd700',
					});
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>