<?php declare(strict_types=1); ?>
<div class='container'>
<fieldset>
    <h2 class="field_ricerca green">Inserimento Nuovo Elemento</h2>
    <div class='row'>
        <div class="input-group mb-3">
            <button class='btn btn-dark shadow' type="button"><label for="insert_categoria">Scegli la categoria</label></button>
            <select id="insert_categoria" name="insert_categoria" class="form-select shadow" aria-label="Inserisci Categoria">
                <ul class='dropdown-menu'>
                <?php
                    use Classidb\Classlogin;
                    $cn = new Classlogin;
                    $pdo = $cn->usernopermit();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query= "SELECT TABLE_NAME 
                    FROM INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='mupin' AND TABLE_NAME!='id'";
                    $sth = $pdo->prepare($query);
                    $sth->execute();
                    $row = $sth->fetchAll();
                    foreach($row as $r){
                        echo "<li class='dropdown-item'><option>".$r[0]."</option></li>";
                    }
                    ?>
                </ul>
            </select>
        <button type='button' class='btn btn-info shadow' onclick="inserisci()">Vai</button></div>
    </div>
</fieldset>    
</div>
<script>
    function inserisci(){
        let categoria = $('#insert_categoria :selected').text();        
        window.location.replace("r-insert.php?table="+categoria);
    }
</script>