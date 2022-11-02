function check(){
    const idajax = document.getElementById("ajaxcall");
    let bol=-1;
    $.ajax({

        'url': 'backend/checkid.php',
        'type': 'POST',
        'data': {
            "id_catalogo" : $("#id_catalogo").val()
        },

        'success': function(data) {
            //document.getElementById("hiddentd").removeAttribute("hidden");
            idajax.removeAttribute("hidden");
            if(data==1){ //id presente nel catalogo
                idajax.innerHTML= "<i class=\"bi bi-x-circle\"></i>ID Non Disponibile";
                idajax.classList.remove("green");
                idajax.classList.add("red");
                document.getElementById("submitbutton").setAttribute("disabled",true);
                bol=1;

            }
            else{   //id non presente e DISPONIBILE
                //document.getElementById("ajaxcall").value= "ID Disponibile";
                idajax.innerHTML= "<i class=\"bi bi-check2-circle\"></i>ID Disponibile";
                idajax.classList.add("green");
                idajax.classList.remove("red");
                document.getElementById("submitbutton").removeAttribute("disabled");
                //document.getElementById('sp-disabled').setAttribute("hidden",true);
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
    const idajax = document.getElementById("ajaxcall");
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
        //document.getElementById("hiddentd").removeAttribute("hidden");
        idajax.removeAttribute("hidden");
        /*if(idajax.classList.contains("red")){
            idajax.classList.remove("red");
        }*/
        idajax.classList.remove("red");
        idajax.classList.add("green");
        
        idajax.innerHTML= "<i class=\"bi bi-slash-circle\"></i>ID non modificato";
        document.getElementById("submitbutton").removeAttribute("disabled");
        document.getElementById("changed").value='not-changed';
    }
    if($("#id_catalogo").val()==""){
        //document.getElementById("hiddentd").removeAttribute("hidden");
        idajax.removeAttribute("hidden");
        idajax.classList.add("red");
        idajax.classList.add("green");
        idajax.innerHTML= "<i class=\"bi bi-exclamation-circle\"></i>ID Vuoto";
        document.getElementById("submitbutton").setAttribute("disabled",true);
        document.getElementById("changed").value='empty';
    }
}


function resettami(){
    document.getElementById("submitbutton").setAttribute("disabled",true);
    //document.getElementById("hiddentd").setAttribute("hidden",true);
    document.getElementById("ajaxcall").setAttribute("hidden",true);
    document.getElementById("changed").value='not-changed';
    typingTimer = setTimeout(check_edit, 2500);
}





