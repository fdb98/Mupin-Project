var id_attuale = $('#id_catalogo').val();
//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 2000;  //time in ms, 5 seconds for example
var $input = $('#id_catalogo');

    typingTimer = setTimeout(check_edit, doneTypingInterval);

//on keyup, start the countdown
$input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(check_edit, doneTypingInterval);
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
    clearTimeout(typingTimer);
});
