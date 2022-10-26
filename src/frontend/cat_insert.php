<?php declare(strict_types=1); ?>
<fieldset>
    <legend>Inserimento Nuovo Elemento</legend>
    <label>Scegli la categoria</label>
    <select id="insert_categoria">
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
            echo "<option>".$r[0]."</option>";
        }
        ?>
    </select>
    <button type='button' onclick="inserisci()">Vai</button>
</fieldset>

<script>
    function inserisci(){
        let categoria = $('#insert_categoria :selected').text();        
        window.location.replace("r-insert.php?table="+categoria);
    }
</script>