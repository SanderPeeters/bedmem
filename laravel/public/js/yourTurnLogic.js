/**
 * Created by Edward on 28/11/2016.
 */
function changePointerEventForTurn() {
    if(!isYourTurn){
        $('#mg__wrapper').css({"pointer-events":"none"});
        $('#isYourTurnText').empty().append("Het is niet jouw beurt");
    }
    if(isYourTurn){
        $('#mg__wrapper').css({"pointer-events":"auto"});
        $('#isYourTurnText').empty().append("Het is jouw beurt");
    }
}
changePointerEventForTurn();

