<?php
    declare(strict_types=1);
    echo $this->layout('pagina', ['title' => $title]);
    use Classidb\Classlogin;
    $cn = new Classlogin;
    $pdo = $cn->userwithpermit();
    
    $this->insert('catalogo', ['title' => $title,'id_catalogo' => $id_catalogo,
                       "table" => $table, "pdo" => $pdo]) ?>
    <button class='btn btn-danger'type="button" onclick="elimina_record()">Elimina</button>
    <button class='btn btn-primary'onclick="location.href='r-reserved_area.php'">Torna All'area Riservata</button>
    <script type="text/javascript" src="scripts/ajax.js"></script>
    <script type="text/javascript" src="scripts/elimina.js"></script>