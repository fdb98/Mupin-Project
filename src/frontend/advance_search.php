<h2 class="field_ricerca">Ricerca Avanzata</h2>
<div class="row g-3">
<div class="input-group mb-3">
<button type="button" class='btn btn-dark shadow-sm' style="width: 50%;"><label for="adv_categoria" >Categoria:</label></button>
<select id="adv_categoria" class="btn btn-light dropdown-toggle shadow-sm" name="adv_categoria"  data-bs-toggle="dropdown" aria-expanded="false" onclick="fill_table(); " style="width: 50%;">
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
        <?php
            for($i=0; $i<11; $i++){
                
                if($i%2==0) echo "<div class='row'>";
                echo "<div class='col'>";
                echo "<strong><label id='label$i' hidden></label></strong>";
                echo "<input type='text' class=\"form-control shadow-sm bg-body rounded\" id='$i' aria-label='' name='' hidden>";
                echo "</div>";
                if($i%2==1) echo "</div>";
            }
        ?>
        <!--<table>
            <?php
                /*for($i=0; $i<11; $i++){
                    echo "<tr><th scope='row'>";
                    echo "<label id='label$i' hidden></label></th>";
                    echo "<td><input type='text' class=\"form-control\" id='$i' aria-label='' name='' hidden>";
                    echo "</td></tr>";
                }*/
             ?>
        </table>-->
        <!--<input type="submit" value="Submit" name="submit" id="submitbutton" disabled>-->

            <div class='row' id="divbutton">
                <div class='col'>
                    <button type="reset" value="Reset" class="btn btn-warning form-control shadow-sm">Reset</button>
                </div>
                <div class='col'>
                    <button type="submit" value="Submit" class="btn btn-primary form-control shadow-sm" id="submitbutton" disabled>Submit</button>
                </div>
            </div>
        </div>
        </form>
    <script src="scripts/ricerca.js"></script>