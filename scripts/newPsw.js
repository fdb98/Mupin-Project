
function newPswClick(changing_user){
    document.getElementById("user-chpsw").value=changing_user;
}

function confirmPass() {
    var pass = document.getElementById("newPsw").value
    var confPass = document.getElementById("confirmPsw").value
    if(pass != confPass) {
        document.getElementById('error').removeAttribute("hidden");
        document.getElementById('btn-change-psw').setAttribute("disabled",true);
    }
    else
    {
        document.getElementById('error').setAttribute("hidden",true);
        document.getElementById("btn-change-psw").removeAttribute("disabled");
    }
}


function postnewPsw(){
    /*const usr = document.getElementById("user-chpsw").value;
    const psw = document.getElementById("newPsw").value;*/
    $.ajax({
        'url': 'backend/change-psw.php',
        'type': 'POST',
        'data': {
            "user" : $("#user-chpsw").val(),
            "psw" : $("#newPsw").val()
        },
        'success': function(data) {
            if(data==1){ //password modificata
                alert("Password modificata con successo!");
            }
            else{
                if(data==0){
                    alert("La Password non è stata modificata. La nuova password non può essere uguale a quella vecchia!");
                }
                else{
                    alert("Password non modificata, problema col server! Riprovare");
                }
            }
        },

        'error': function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}

