
function elimina_foto(id){
    let conferma = window.confirm("Sicuro di voler eliminare la foto?");
    if(conferma){
        $.ajax({

            'url': 'backend/elimina_foto.php',
            'type': 'POST',
            'data': {
                "id_catalogo" : $("#id_catalogo").val(),
                "foto" : id,
                "n_foto": $("#n_foto").val(),
                "categoria": $("#categoria").val()
            },
    
            'success': function(data) {
                if(data=='1' || data=='2'){ //id presente nel catalogo
                    alert("Foto Eliminata con successo!");
                    if(data=='2')   window.location.reload();
                    else{
                        document.getElementById(id).remove();
                        document.getElementById("btn-"+id).remove();
                    }
                }
                else{
                    if(data=='-2') alert("File non presente nel server, aggiornare la pagina e riprovare");
                    else alert("Problema nell'eliminazione, riprovare tra qualche minuto!");
                }
            },
    
            'error': function(request, error) {
                //alert("Request: " + JSON.stringify(request));
                alert("Errore nella comunicazione con il server, riprovare tra qualche minuto!");
            }
        });
            
    }
}


function elimina_record(){
    let conferma = window.confirm("Sicuro di voler eliminare questo elemento?");
    if(conferma){
        $.ajax({

            'url': 'backend/elimina_record.php',
            'type': 'POST',
            'data': {
                "id_catalogo" : $("#id_catalogo").val(),
                "n_foto" : $("#n_foto").val()
            },
    
            'success': function(data) {
                //console.log(data);
                if(data=='1'){ //id presente nel catalogo
                    eliminato = 1;
                    alert("Elemento elimanto con successo!");
                    window.location.replace("r-reserved_area.php");
                }
                else{
                    eliminato = 0;
                    alert("Problema nell'eliminazione, riprovare tra qualche minuto!");
                }
            },
    
            'error': function(request, error) {
                //alert("Request: " + JSON.stringify(request));
                alert("Errore nella comunicazione con il server, riprovare tra qualche minuto!");
                console.log(data);
            }
        });
    }
}

function elimina_admin(i){
    let conferma = window.confirm("Sicuro di voler eliminare questo admin?");
    if(conferma){
        
        $.ajax({

            'url': 'backend/elimina_admin.php',
            'type': 'POST',
            'data': {
                "user" : $("#user_"+i).text()
            },
    
            'success': function(data) {
                //console.log(data);
                if(data=='1'){ //id presente nel catalogo
                    eliminato = 1;
                    $("#"+i).remove();
                    alert("Elemento elimanto con successo!");

                }
                else{
                    eliminato = 0;
                    alert("Problema nell'eliminazione, riprovare tra qualche minuto!");
                }
            },
    
            'error': function(request, error) {
                //alert("Request: " + JSON.stringify(request));
                alert("Errore nella comunicazione con il server, riprovare tra qualche minuto!");
                console.log(data);
            }
        });
    }
}