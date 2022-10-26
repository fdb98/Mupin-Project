<legend class="field_ricerca">Ricerca Avanzata</legend>
<label for="categoria">Categoria:</label>
    <select id="adv_categoria" name="adv_categoria" onclick="fill_table();">
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
        echo "</select>";
        ?>
        <!--<button type='button' onclick="fill_table()">Seleziona Categoria</button>-->
        <form action="searching.php" method="post">
        <?= "<input type='hidden' name='table' id='adv_table'>";?>
        <table>
            <?php
                for($i=0; $i<11; $i++){
                    echo "<tr><th scope='row'>";
                    echo "<label id='label$i' hidden></label></th>";
                    echo "<td><input type='text' id='$i' name='' hidden>";
                    echo "</td></tr>";
                }
             ?>
        </table>
        <input type="submit" value="Submit" name="submit" id="submitbutton" disabled>
        <input type="reset" value="Reset">
        </form>
    </select>
    <script src="scripts/ricerca.js"></script>