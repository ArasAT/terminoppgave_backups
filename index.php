<?php 
session_start();

    $_SESSION;

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);


?>

<!--<p class="php">Hello, <?php echo $user_data['user_name']; ?></p>!-->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <style><?php include "index.css"; ?></style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>Home</title>
</head>



<body>

    <center>

        <div id="bigbox">
        <div id="upperbox">
            <a class="material-icons" href="userinfo.php" style="font-size:40px">person</a>
            <a class="logout" href="logout.php">Logout</a>
        </div>
    <!--About the game !-->
            <h1 class="h1text">Warrior Fight</h1> 

            <button class="showTextButton" onclick="showText()" id="about">About game &#9660</button>     
               
                <div id="theText">
                    <p class="normaltext">
                    This fighting game is a very basic fighting game. You have a sword and a shield. Thats it.
                    The turning in this game is a bit different from other games. Instead of walking to the left
                    and right, you TURN left and right. To walk you'll need to press "W" as always, same with "S" for
                    going backwards. For attacking you don't use your mouse, no no no, you use "J" and "K". Don't ask
                    for me to change that because that won't happend. Unless... Anyways, to use the shield you need to
                    HOLD DOWN "J". If you just click "J" the animation may play but you won't be blocking anything. No,
                    its not a glitch its a feature. Just remember to hold the button down. Your attack-button is "K".
                    There are to types of attacks but they do the same damage and is random. Don't just spam the button.
                    If you do that your player will attack multiple times and you can't block anything. You fight just one
                    enemy but if you want to fight any more you'll have to wait for me to put it in the game.
                    If you have any ideas or glitches to report, contact me here: <a class="help_text_link" href="help2.php">help</a>.
                    This game is made for windwos, so it may not work on other operating systems.
                    </p>
                </div>
            <br>
    <!--Tutorial video soon to be made !-->
            <h3 class="h3text">How To Play</h3>
            <div class="controlls_box">
                <div class="WASD">
                    <p class="normaltext">MOVEMENT:</p>
                    <br><img class="controlls_img_WASD" src="Img/WASD.png">
                </div>

                <div class="JK">
                    <p class="normaltext">SHIELD: HOLD [J]
                    <br>ATTACK: [K]
                    </p>
                    <br><img class="controlls_img_JK" src="Img/JK.png">
                </div>
            </div>
            <br>
    <!--Downlaod the game!-->
            <h3 class="h3text">Download</h3>
                <br>

                <form method="get" action="Warrior_Fight.zip">
                    <button class="button" type="submit">Download Game</button>
                </form>
                <br>
                <button class="button" type="button" onclick="window.location='flappy.php';">Flappy Ball</button>
            <br>

            

        </div>
        
    </center>

</body>


<script>

//Easteregg???
var score_sound = new Audio('score_sound.mp3');
var enterkeycount = 0;

    document.addEventListener("keyup", function(event) {
    if (event.code === 'Space') {
        score_sound.currentTime = 0;
        score_sound.play();
        enterkeycount++;
        if(enterkeycount == 5)
        {
            document.location.href = 'flappy.php';
        }
    }
    });



//Show text buton script
    function showText()
        {
            var text = document.getElementById("theText");
            var box = document.getElementById("bigbox");
            var about = document.getElementById("about");


            if (text.style.display === "block") {
                text.style.display = "none";
                box.style.height = "700px";
                about.innerHTML = "About game &#9660";
            } else {
                text.style.display = "block";
                box.style.height = "1200px";
                about.innerHTML = "About game &#9650";
            }
            
            

        }
</script>

</html>
