<?php
    echo $this->layout('pagina', ['title' => $title]);
    
    use Classidb\Classlogin;
    $cn = new Classlogin;
    $pdo = $cn->usernopermit();

    $this->insert('catalogo', ['title' => $title,'id_catalogo' => $id_catalogo,
                       "table" => $table, "pdo"=>$pdo]);

    session_start();
    $logged = (isset($_SESSION["logged"]) && $_SESSION["logged"]) ? true : false;
    if($logged === true){
        echo "<button class=\"btn btn-warning\" onclick=\"location.href='r-edit.php?id_catalogo=".$id_catalogo."&table=".$table."'\">Modifica</a></button>";
        echo "<button class=\"btn btn-danger\" onclick=\"location.href='r-delete.php?id_catalogo=".$id_catalogo."&table=".$table."'\">Pagina Elimina</button></td></tr>";
    }
?>

<!--<script src="scripts\reserved-style.js"></script>-->