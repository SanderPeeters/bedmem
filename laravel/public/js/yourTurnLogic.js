/**
 * Created by Edward on 28/11/2016.
 */
function changePointerEventForTurn() {
    if(!isYourTurn){
        $('#mg__wrapper').css({"pointer-events":"none"});
        // $('#isYourTurnText').empty().append("Het is niet jouw beurt");
        $('#isYourTurnAlert').removeClass("pulse").empty().append("<h2>De andere speler is aan zet.</h2>");
        /*setTimeout(function(){
            $('#isYourTurnAlert').addClass("tada");
        }, 500);*/
    }
    if(isYourTurn){
        $('#mg__wrapper').css({"pointer-events":"auto"});
        // $('#isYourTurnText').empty().append("Het is jouw beurt");
        $('#isYourTurnAlert').removeClass("pulse").empty().append("<h2>Het is jouw beurt.</h2>");
        setTimeout(function(){
            $('#isYourTurnAlert').addClass("pulse");
        }, 500);


    }
}
changePointerEventForTurn();

