function check(){
    let bol=-1;
    $.ajax({

        'url': 'backend/checkid.php',
        'type': 'POST',
        'data': {
            "id_catalogo" : $("#id_catalogo").val()
        },

        'success': function(data) {
            document.getElementById("hiddentd").removeAttribute("hidden");
            if(data==1){ //id presente nel catalogo
                document.getElementById("ajaxcall").innerHTML= "ID Non Disponibile";
                document.getElementById("ajaxcall").classList.remove("green");
                document.getElementById("ajaxcall").classList.add("red");
                document.getElementById("submitbutton").setAttribute("disabled",true);
                bol=1;

            }
            else{   //id non presente e DISPONIBILE
                //document.getElementById("ajaxcall").value= "ID Disponibile";
                document.getElementById("ajaxcall").innerHTML= "ID Disponibile";
                document.getElementById("ajaxcall").classList.add("green");
                document.getElementById("ajaxcall").classList.remove("red");
                document.getElementById("submitbutton").removeAttribute("disabled");
                bol=0;
            }
        },

        'error': function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
    return bol;
}

function check_edit(){
    if($("#id_catalogo").val().toLowerCase() != id_attuale.toLowerCase() && $("#id_catalogo").val()!=""){
        data = check();
        if(data==0){
            document.getElementById("changed").value='changed';
        }
        else{
            document.getElementById("changed").value='changed';
        }
    }
    else{
        document.getElementById("hiddentd").removeAttribute("hidden");
        document.getElementById("ajaxcall").classList.add("green");
        document.getElementById("ajaxcall").innerHTML= "ID non modificato";
        document.getElementById("submitbutton").removeAttribute("disabled");
        document.getElementById("changed").value='not-changed';
    }
    if($("#id_catalogo").val()==""){
        document.getElementById("hiddentd").removeAttribute("hidden");
        document.getElementById("ajaxcall").classList.add("red");
        document.getElementById("ajaxcall").innerHTML= "ID Vuoto";
        document.getElementById("submitbutton").setAttribute("disabled",true);
        document.getElementById("changed").value='empty';
    }
}


function resettami(){
    document.getElementById("submitbutton").setAttribute("disabled",true);
    document.getElementById("hiddentd").setAttribute("hidden",true);
    document.getElementById("changed").value='not-changed';
    typingTimer = setTimeout(check_edit, 2500);
}





