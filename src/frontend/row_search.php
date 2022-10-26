<?php
    $this->layout('pagina', ['title' => "Risultato Ricerca"]);
    echo "<h1>Risultati Ricerca</h1>";
    for($i=0; $i<$sth->rowCount(); $i++){
        $record = $sth->fetch();
        echo "<hr><br>";
        $this->insert('print_record', ['record' => $record, 'logged' => $logged, 'table' => $table]);
     }

?>