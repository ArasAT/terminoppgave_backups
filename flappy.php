<?php 
session_start();

$_SESSION;

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$id = $user_data['id'];
$gamescore = $user_data['gamescore'];

//shows highest score with id
//select id,max(gamescore) from users group by id order by max(gamescore) desc;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $gamescorenew = $_POST['gamescorelive'];

        //Check if current score is higher than your saved score
        if ($gamescorenew > $gamescore)
        {
            //If current score is higher than saved score, save this current score
            $query = "update users set gamescore = $gamescorenew where id = $id";

            $con->query($query);
            
            header("Location: flappy.php");
        }else {
            
            //Current score is not higher than saved score, alert and refresh site
            echo '<script>alert("Your current score needs to be higher!"); window.location.replace("flappy.php");</script>';
        } 
 
        

    }
?>
<!DOCTYPE html>
<html lang="en" onclick="jump()">
<head>
    <meta charset="UTF-8">
    <title>Easteregg</title>
<style>
*{
    padding: 0;
    margin: 0;
}
html {
    background: linear-gradient(to right, #141e30, #243b55);
}
#game{
    width: 600px;
    height: 500px;
    border: 1px solid black;
    margin: auto;
    overflow: hidden;
    background-color: #243b55;    
}
#block{
    width: 50px;
    height: 500px;
    background-color: #66FCF1;
    position: relative;
    left: 600px;
    animation: block 1s infinite linear;
    
}
@keyframes block{
    0%{left:600px}
    100%{left:-200px}
}
#hole{
    width: 50px;
    height: 150px;
    background-color: #243b55;
    position: relative;
    left: 600px;
    top: -500px;
    animation: block 1s infinite linear;
    
}
#character{
    width: 20px;
    height: 20px;
    background-color: red;
    position: absolute;
    top: 100px;
    border-radius: 50%;
    
}

#scoretext{
    font-size: 60px;
    color: #66FCF1;
    margin: auto;
    width: 600px;
    align-content: center;
    display: table;
}

#gameover{
    font-size: 50px;
    color: #ff0000;
    text-align: center;
    margin-top: 200px;
    width: 600px;
    position: absolute;
    z-index: 100;
    font-weight: bold;
}

#jumpdesc {
    width: 600px;
    height: 50px;
    font-size: 35px;
    border: none;
    color: #66FCF1;
    text-align: left;
}

#restartgame {
    width: 300px;
    height: 100px;
    font-size: 45px;
    background-color: #ff0000;
    border: none;
}

#restartgame:hover {
    background-color: #ac0000;
    cursor: pointer;
}

#restartgame:disabled {
    background-color: #680000;
    color: black;
}

#backbuttongame {
    width: 300px;
    height: 100px;
    color: #000000;
    background-color: #66FCF1;
    border: none;
    font-size: 40px;    
}

#backbuttongame:hover {
    background-color: #57d1c9;
    cursor: pointer;
}

#backbuttongame:disabled {
    background-color: #3e928d;
}

#highscore {
    font-size: 50px;
    color: #66FCF1;
    margin: auto;
    width: 600px;
    align-content:center;
}

#savescore {
    padding: 10px;
    width: 600px;
    height: 100px;
    color: #000000;
    background-color: #66FCF1;
    border: none;
    font-size: 40px;
    display: block;
}

#savescore:hover {
    background-color: #57d1c9;
    cursor: pointer;
}

#savescore:active {
    cursor: pointer;
}

#savescore:disabled {
    background-color: #3e928d;
}

#score {
    font-size: 60px;
    width: 200px;
    color: #66FCF1;
    background: transparent; 
    border: none;
}

#twobuttons {
    width: 600px;
    text-align: center;
    height: 100px;
    display: flex;
    flex-direction: row;
}

/* Remove arrowbox from number input */

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

/*------------------------------Remove scrollwheel*/
::-webkit-scrollbar {
    width: 0px;
}

</style>
</head>
<body>

    <div id="game">
        <p id="gameover"></p>
        <div id="block"></div>
        <div id="hole"></div>
        <div id="character"></div>
    </div>
        <form method="POST">
            <span id="scoretext">Score: <input id="score" type="number" name="gamescorelive" placeholder="0" readonly></input></span>
            <center>
            <p id="jumpdesc">To Jump click <strong>Space</strong> or just <strong>click</strong></p>
            <input id="savescore" type="submit" value="Save this score">
        </form>
        
        <div id="twobuttons">
            <button id="restartgame" onClick="window.location.reload();">Restart</button>
            <button id="backbuttongame" type="button" onclick="location.href = 'index.php'">Go back</button>
        </div>
        </center>
        <div id="highscore">Current Highscore: <?php echo $gamescore; ?></div>
    
                
        
</body>
<script src="scriptflappy.js"></script>
</html>