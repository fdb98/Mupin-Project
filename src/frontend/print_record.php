<?php
    //echo "<table>";
    //echo "<thead><th>".$record->getH1()."</th>"; ?>
    <div class="card border-dark mb-3" style="width: 100%;">
    <?php
    if($record->n_foto>0){
        $path = "upload/img/".$record->id_catalogo."_01";
        $ext ="";
        if(file_exists($path.".jpg")) $ext = ".jpg";
                    else if(file_exists($path.".png")) $ext = ".png";
                        else if(file_exists($path.".gif")) $ext = ".gif";
        $alt = $record->id_catalogo."_01";
        //echo "<th><img src='".."' class='fotodb' alt='".$this->e($alt)."'></th>";
        echo "<img src=\"".$path.$ext."\" class=\"card-img-top\" alt=\"".$this->e($alt)."\">";
    }
    echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\">".$record->getH1()."</h5>";
        //echo "<p class=\"card-text\">Some quick example text to build on the card title and make up the bulk of the card's content.</p>";
        echo "<p class=\"card-text\"></p>";
    echo "</div>";
    echo "<ul class=\"list-group list-group-flush\">";
    for($j=0;$j<$record::CAMPI; $j++){
        $value = $record->{$record::CATEGORIE[$j]};
            echo "<li class=\"list-group-item\">".$record::CATEGORIE[$j].": <input type='text' id='".$record::CATEGORIE[$j]."' value='".$value."' readonly></li>";
        
    }
    echo "</ul>";
    echo "<div class=\"card-body\">";
        //echo "<a href=\"#\" class=\"card-link\">Card link</a>";
        echo "<button class='btn btn-primary' onclick=\"location.href='r-catalogo.php?id_catalogo=".$record->id_catalogo."&table=".$table."'\">Visualizza</button>";
        if($logged){    
            echo "<button class='btn btn-warning' onclick='location.href=\"r-edit.php?id_catalogo=".$record->id_catalogo."&table=".$table."\"'>Modifica</button>";
            echo "<button class='btn btn-danger' onclick='location.href=\"r-delete.php?id_catalogo=".$record->id_catalogo."&table=".$table."\"'>Elimina</button>";
        }
    echo "</div>";
    echo "</div>";
?>


<!--
<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>-->