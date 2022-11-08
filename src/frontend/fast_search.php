    <!--
    <form action="backend/fs_aimed.php"  method="post">
        <fieldset>
            <h2><legend class="field_ricerca">Ricerca Veloce e Precisa</legend></h2>      
                    <div class="row">
                        <div class="col"><strong><label for="fst_categoria">Categoria:</label></strong></div>
                        <div class="col"><select id="fst_categoria" name="fst_categoria" class="form-select" aria-label="Default select example">                    
                
                    <?php /*
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
                    } */
                    ?>
                </select>
                </div>
                </div>
                <div class="row">
                <div class='col'><strong><label for="search">ID_Catalogo:</label></strong></div>
                <div class="col"><input type="text" name="id_catalogo" id="id_catalogo" class="form-control" required></div>
                </div>
        </fieldset>
        <div>
            <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
            <button type="reset" value="Reset" class="btn btn-warning">Reset</button>
        </div>
    </form>-->


    <form action="backend/fs_aimed.php"  method="post">
        <fieldset>
        <h2 class="field_ricerca">Ricerca Veloce e Precisa</h2>    
        <div class="input-group mb-3 shadow">
            <button type="button" class='btn btn-dark'><label for='fst_categoria1'>Categoria</label></button>
            <select class="btn btn-light dropdown-toggle" id="fst_categoria1" name="fst_categoria"  data-bs-toggle="dropdown" aria-expanded="false">
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
                        echo "<li class='dropdown-item'><option class=''>".$r[0]."</option></li>";
                    }
                    ?>
            </ul>
            </select>
            <button type="button" class='btn btn-primary'><label for='fst_idcatalogo'>ID Catalogo</label></button>
            <input type="text" id="fst_idcatalogo" name="id_catalogo" class="form-control" aria-label="ID Catalogo" required>
            <button type="submit" class='btn btn-warning'>Cerca</button>
        </div>
    </fieldset>
    </form>