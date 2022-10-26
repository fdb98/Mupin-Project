<?php
    declare(strict_types=1);
    echo $this->layout('pagina', ['title' => $title]);
    use Classidb\Classlogin;
    $cn = new Classlogin;
    $pdo = $cn->userwithpermit();
    
    $this->insert('catalogo', ['title' => $title,'id_catalogo' => $id_catalogo,
                       "table" => $table, "pdo" => $pdo]) ?>
    <button type="button" onclick="elimina_record()">Elimina</button>
    <a href="r-reserved_area.php"><button>Torna All'area Riservata</button></a>
    <script type="text/javascript" src="scripts/ajax.js"></script>
    <script type="text/javascript" src="scripts/elimina.js"></script>