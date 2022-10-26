$('#adv_categoria').selectedIndex =0;  
fill_table();

function fill_table(){
    $.ajax({

        'url': 'backend/fill_table.php',
        'type': 'POST',
        'data': {
            "table" : $('#adv_categoria :selected').text()
        },

        'success': function(data) {
            const campi = JSON.parse(data);
             //id presente nel catalogo
            for(i=0;i<campi.length; i++){
                    document.getElementById("label"+i).removeAttribute("hidden");
                    document.getElementById(i).removeAttribute("hidden");
                    document.getElementById("label"+i).innerHTML= campi[i];
                    document.getElementById("submitbutton").removeAttribute("disabled");
                    document.getElementById("adv_table").value= $('#adv_categoria :selected').text();
                    document.getElementById(i).setAttribute("name",campi[i]);    
                }
            for(i=campi.length; i<11; i++){
                document.getElementById("label"+i).setAttribute("hidden",true);
                document.getElementById(i).setAttribute("hidden",true);
            }
        },

        'error': function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}