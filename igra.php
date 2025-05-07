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
            #anim1, #anim2, #anim3 {
                display: flex;
                justify-content: center;
                height: 48px;
                margin: 5px 0;
            }
            #anim1 img, #anim2 img, #anim3 img {
                animation: spin 1s infinite linear;
                margin: 0 5px;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            #kocke1, #kocke2, #kocke3 {
                display: none;
                justify-content: center;
            }
            #kocke1 img, #kocke2 img, #kocke3 img {
                margin: 0 5px;
            }
			.swal2-container.swal2-center>.swal2-popup {
				background-color: red;
			}
        </style>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="vnos">
            <div id="naslov">
                <h1>IGRA</h1>
            </div>
            <?php 
                while($_SESSION["da"]){
                $_SESSION["i1"]=$_POST['ime1'];
                $_SESSION["i2"]=$_POST['ime2'];
                $_SESSION["i3"]=$_POST['ime3'];
          
                $_SESSION["stKock"]=$_POST['stkock'];
                $_SESSION["stIger"]=$_POST['stIger'];
                $_SESSION["da"]=false;
              }
              switch ($_SESSION["stKock"]) {
                case 1:
                    $_SESSION["igralec1k1"]=rand(1,6);
                break;
                case 2:
                    $_SESSION["igralec1k1"]=rand(1,6);
                    $_SESSION["igralec1k2"]=rand(1,6);
                break;
                case 3:
                    $_SESSION["igralec1k1"]=rand(1,6);
                    $_SESSION["igralec1k2"]=rand(1,6);
                    $_SESSION["igralec1k3"]=rand(1,6);
                break;   
                default:
                ;
              } 
              switch ($_SESSION["stKock"]) {
                case 1:
                    $_SESSION["igralec2k1"]=rand(1,6);
                break;
                case 2:
                    $_SESSION["igralec2k1"]=rand(1,6);
                    $_SESSION["igralec2k2"]=rand(1,6);
                break;
                case 3:
                    $_SESSION["igralec2k1"]=rand(1,6);
                    $_SESSION["igralec2k2"]=rand(1,6);
                    $_SESSION["igralec2k3"]=rand(1,6);
                break;
                
                default:
                ;
              } 
              /*igralec 3*/
              switch ($_SESSION["stKock"]) {
                case 1:
                    $_SESSION["igralec3k1"]=rand(1,6);
                break;
                case 2:
                    $_SESSION["igralec3k1"]=rand(1,6);
                    $_SESSION["igralec3k2"]=rand(1,6);
                break;
                case 3:
                    $_SESSION["igralec3k1"]=rand(1,6);
                    $_SESSION["igralec3k2"]=rand(1,6);
                    $_SESSION["igralec3k3"]=rand(1,6);
                break;
                
                default:
                ;
              } 
            ?>          
            <div id="glavni">
                <div id="igra">               
                    <div class="igralec">
					<?php echo $_SESSION["i1"],"<br />";
                    switch ($_SESSION["stKock"]) {
                        case 1:
                            echo "<div id='anim1' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            
                            echo "<div id='kocke1' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec1k1"],".gif'></div>";
                            $_SESSION["vsota1"]=$_SESSION["igralec1k1"]+$_SESSION["vsota1"];
                        break;
                        case 2:
                            echo "<div id='anim1' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke1' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec1k1"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec1k2"],".gif'></div>";
                            $_SESSION["vsota1"]=$_SESSION["igralec1k1"]+$_SESSION["igralec1k2"]+$_SESSION["vsota1"];
                            break;
                        case 3:
                            echo "<div id='anim1' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke1' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec1k1"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec1k2"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec1k3"],".gif'></div>";
                            $_SESSION["vsota1"]=$_SESSION["igralec1k1"]+$_SESSION["igralec1k2"]+$_SESSION["igralec1k3"]+$_SESSION["vsota1"];
                            break;
                            
                        default:
                        ;
                    } 
                    echo "<br />Seštevek ",$_SESSION["vsota1"];
                    ?></div>
                    <div class="igralec"><?php echo $_SESSION["i2"],"<br />";
                    
                    switch ($_SESSION["stKock"]) {
                        case 1:
                            echo "<div id='anim2' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke2' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec2k1"],".gif'></div>";
                            $_SESSION["vsota2"]=$_SESSION["igralec2k1"]+$_SESSION["vsota2"];
                        break;
                        case 2:
                            echo "<div id='anim2' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke2' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec2k1"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec2k2"],".gif'></div>";
                            $_SESSION["vsota2"]=$_SESSION["igralec2k1"]+$_SESSION["igralec2k2"]+$_SESSION["vsota2"];
                            break;
                        case 3:
                            echo "<div id='anim2' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke2' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec2k1"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec2k2"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec2k3"],".gif'></div>";
                            $_SESSION["vsota2"]=$_SESSION["igralec2k1"]+$_SESSION["igralec2k2"]+$_SESSION["igralec2k3"]+$_SESSION["vsota2"];
                            break;
                        
                        default:
                        ;
                    } 
                    echo "<br />Seštevek ",$_SESSION["vsota2"];
                    ?></div>
                    <div class="igralec"><?php echo $_SESSION["i3"],"<br />";
                    
                    
                    switch ($_SESSION["stKock"]) {
                        case 1:
                            echo "<div id='anim3' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke3' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec3k1"],".gif'></div>";
                            $_SESSION["vsota3"]=$_SESSION["igralec3k1"]+$_SESSION["vsota3"];
                        break;
                        case 2:
                            echo "<div id='anim3' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke3' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec3k1"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec3k2"],".gif'></div>";
                            $_SESSION["vsota3"]=$_SESSION["igralec3k1"]+$_SESSION["igralec3k2"]+$_SESSION["vsota3"];
                            break;
                        case 3:
                            echo "<div id='anim3' style='height:48px;'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'><img style='margin:5px 0;' src='slike/dice-anim.gif'></div>";
                            echo "<div id='kocke3' style='display:none;'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec3k1"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec3k2"],".gif'><img style='margin:5px 0;' src='slike/dice",$_SESSION["igralec3k3"],".gif'></div>";
                            $_SESSION["vsota3"]=$_SESSION["igralec3k1"]+$_SESSION["igralec3k2"]+$_SESSION["igralec3k3"]+$_SESSION["vsota3"];
                            break;
                        
                        default:
                        ;
                    }
                    echo "<br />Seštevek ",$_SESSION["vsota3"];

                    ?>
                    </div>
                </div>
                
                <div id="izbira">
                <?php echo "Število kock ",$_SESSION["stKock"];
                    $_SESSION["stevc"]=$_SESSION["stevc"]+1;
                    if($_SESSION["stevc"]>=$_SESSION["stIger"]){
                        
                        echo " <br /><form action=\"konec.php\" name=\"forma\" method=\"post\"><input type=\"submit\" class=\"gumb\"  name=\"rezultati\" value=\"REZULTATI\"/></form>"; 

                    }
                    else{
                    echo "<br /> <form action=\"igra.php\" name=\"forma\" method=\"post\"><input type=\"submit\" class=\"gumb\"  name=\"rezultati\" value=\"VRZI\"/></form>"; 
                    }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>