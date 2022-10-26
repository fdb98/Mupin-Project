<div>
    <form action="backend/fs_aimed.php"  method="post">
        <fieldset>
            <legend class="field_ricerca">Ricerca Veloce e Precisa</legend>
            <p>        
                <label for="fst_categoria">Categoria:</label>
                <select id="fst_categoria" name="fst_categoria">
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
                <label for="search">ID_Catalogo:</label>
                <input type="text" name="id_catalogo" id="id_catalogo" required>
            </p>
        </fieldset>
        <p>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </p>
    </form>
</div>