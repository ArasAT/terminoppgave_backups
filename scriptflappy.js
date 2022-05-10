var block = document.getElementById("block");
var hole = document.getElementById("hole");
var game = document.getElementById("game");
var character = document.getElementById("character");
var jumping = 0;
var counter = 0;
var stop = false;
var score_sound = new Audio('score_sound.mp3');

//Disable restart button
document.getElementById("restartgame").disabled = true;

//Jump if space is pressed
document.body.onkeyup = function(e) {
if (e.key == " " || e.code == "Space" || e.keyCode == 32){
    jump();
}};

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
        character.style.top = (characterTop+3)+"px";
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
            character.style.top = (characterTop-5)+"px";
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
    character.style.top = 100 + "px";
    counter=0;
    document.getElementById("gameover").innerHTML = "Game Over!";
    game.style.position = "relative";
    character.style.position = "fixed";
    block.style.position = "fixed";
    hole.style.position = "fixed";
    block.style.animation = "block 1s linear";
    block.style.background = "none";
    character.remove();
    stop = true;
    document.getElementById("restartgame").disabled = false; 
}