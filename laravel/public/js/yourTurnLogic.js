/**
 * Created by Edward on 28/11/2016.
 */
function changePointerEventForTurn() {
    if(!isYourTurn){
        $('#my-memory-game').css({"pointer-events":"none"});
    }
    if(isYourTurn){
        $('#my-memory-game').css({"pointer-events":"auto"});
    }
}
changePointerEventForTurn();

