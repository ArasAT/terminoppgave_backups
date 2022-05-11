var block = document.getElementById("block");
var hole = document.getElementById("hole");
var game = document.getElementById("game");
var character = document.getElementById("character");
var jumping = 0;
var counter = 0;
var stop = false;
var score_sound = new Audio('score_sound.mp3');

//Disable buttons
document.getElementById("restartgame").disabled = true;
document.getElementById("backbuttongame").disabled = true;

//Jump if space is pressed
document.body.onkeyup = function(e) {
if (e.key == " " || e.code == "Space" || e.keyCode == 32){
    jump();
}};

document.addEventListener("keyup", function(event) {
if ((event.code === 'Enter') && (stop == true)) {
    location.reload();
}
});

//Points for going through openings
hole.addEventListener('animationiteration', () => {
    if (stop == true) {
        return
    }
    var random = -((Math.random()*300)+150);
    hole.style.top = random + "px";
    counter++;
    character.style.backgroundColor = "orange";
    document.getElementById("score").innerHTML = "Score: " + counter;
    document.getElementById("gameover").innerHTML = "";
    score_sound.play();
});
//Gravity for character 
setInterval(function(){
    var characterTop = parseInt(window.getComputedStyle(character).getPropertyValue("top"));
    if(jumping==0){
        //Gravity strength
        character.style.top = (characterTop+4)+"px";
    }
    var blockLeft = parseInt(window.getComputedStyle(block).getPropertyValue("left"));
    var holeTop = parseInt(window.getComputedStyle(hole).getPropertyValue("top"));
    var cTop = -(500-characterTop);
    //If character hits block or ground
    if((characterTop>480)||((blockLeft<20)&&(blockLeft>-50)&&((cTop<holeTop)||(cTop>holeTop+130)))){
        die();
    }

},10);


//Jump function
function jump(){
    character.style.backgroundColor = "red";
    jumping = 1;
    let jumpCount = 0;
    var jumpInterval = setInterval(function(){
        var characterTop = parseInt(window.getComputedStyle(character).getPropertyValue("top"));
        if((characterTop>6)&&(jumpCount<15)){
            //Jump force
            character.style.top = (characterTop-6)+"px";
        }
        if(jumpCount>20){
            clearInterval(jumpInterval);
            jumping=0;
            jumpCount=0;
        }
        jumpCount++;
    },10);

}



//If character dies
function die(){
    //Game over text
    var d = Math.random();
    if (d < 0.005){
        //Rick??
        location.replace("https://www.youtube.com/watch?v=BBJa32lCaaY");
    } else {
        const randomtext = ["Game Over", "You suck btw", "Try harder", "Imagine losing", "Could not be me", "Try sucking less", "Mimic tear user", "-.-- --- ..- / ... ..- -.-. -.-", "Nice try", "Better luck next time"];
        const random = Math.floor(Math.random() * randomtext.length);
        var randomgameover = (random, randomtext[random]);
    }
    //Make the game blank and enable buttons
    character.style.top = 100 + "px";
    counter=0;
    document.getElementById("gameover").innerHTML = randomgameover;
    game.style.position = "relative";
    game.style.border = "1px solid red";
    character.style.position = "fixed";
    block.style.position = "fixed";
    hole.style.position = "fixed";
    block.style.animation = "block 1s linear";
    block.style.background = "none";
    character.remove();
    stop = true;
    document.getElementById("restartgame").disabled = false; 
    document.getElementById("backbuttongame").disabled = false;
}
