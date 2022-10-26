<?php
    declare(strict_types=1);
    echo $this->layout('pagina', ['title' => "Elemento non trovato"]);
    echo "<h1>L'elemento con id ".$this->e($id_catalogo)." non è presente nella categoria ".$this->e($table)."</h1>";
