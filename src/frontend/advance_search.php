<h2><legend class="field_ricerca">Ricerca Avanzata</legend></h2>
<div class="input-group mb-3">
<button type="button" class='btn btn-dark'><label for="adv_categoria" >Categoria:</label></button>
<select id="adv_categoria" class="btn btn-light dropdown-toggle" name="adv_categoria"  data-bs-toggle="dropdown" aria-expanded="false" onclick="fill_table();">
        <ul class="dropdown-menu">
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
        echo "</ul>";
        ?>
        </select>
    </div>
        <!-- <button type='button' onclick='fill_table()'>Seleziona Categoria</button> -->
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
        <!--<input type="submit" value="Submit" name="submit" id="submitbutton" disabled>-->
        <button type="submit" value="Submit" class="btn btn-primary" id="submitbutton" disabled>Submit</button>
        <button type="reset" value="Reset" class="btn btn-warning">Reset</button>
        </form>
    <script src="scripts/ricerca.js"></script>