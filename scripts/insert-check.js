//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 2500;  //time in ms, 5 seconds for example
var $input = $('#id_catalogo');

//on keyup, start the countdown
$input.on('keyup', function () {
    if($input.val()!=""){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(check, doneTypingInterval);
    }
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
    clearTimeout(typingTimer);
});
