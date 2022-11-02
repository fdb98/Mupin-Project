<?php
    $this->layout('pagina', ['title' => "Risultato Ricerca"]);
    echo "<h1>Risultati Ricerca</h1>";
    for($i=0; $i<$sth->rowCount(); $i++){
        $record = $sth->fetch();
        if($i%4==0) echo "<div class=\"row row-cols-1 row-cols-md-2 g-4 \">";
            echo "<div class=\"col\">";
                $this->insert('print_record', ['record' => $record, 'logged' => $logged, 'table' => $table]);
            echo "</div>";
        if($i%4==3) echo "</div>";
     }

?>