<?php
    echo "<table>";
    echo "<thead><th>".$record->getH1()."</th>";
    if($record->n_foto>0){
        $path = "upload/img/".$record->id_catalogo."_01";
        $ext ="";
        if(file_exists($path.".jpg")) $ext = ".jpg";
                    else if(file_exists($path.".png")) $ext = ".png";
                        else if(file_exists($path.".gif")) $ext = ".gif";
        $alt = $record->id_catalogo."_01";
        echo "<th><img src='".$path.$ext."' class='fotodb' alt='".$this->e($alt)."'></th>";
    }
    echo "</thead>";
    for($j=0;$j<$record::CAMPI; $j++){
        $value = $record->{$record::CATEGORIE[$j]};
        echo "<tbody><tr><th scope='row'>".$record::CATEGORIE[$j]."</th>";
        echo "<td><input type='text' id='".$record::CATEGORIE[$j]."' value='".$value."' readonly></td></tr>";
    }
    echo "<tr><td colspan=2><button><a href='r-catalogo.php?id_catalogo=".$record->id_catalogo."&table=".$table."'>Visualizza</a></button>";
    if($logged){    
        echo "<button><a href='r-edit.php?id_catalogo=".$record->id_catalogo."&table=".$table."'>Modifica</a></button>";
        echo "<button><a href='r-delete.php?id_catalogo=".$record->id_catalogo."&table=".$table."'>Elimina</a></button>";
    }
    echo "</td></tr></tbody></table>";
?>