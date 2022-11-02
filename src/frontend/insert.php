<?php
    declare(strict_types=1);
    echo $this->layout('pagina', ['title' => $title]);
    use App\Filter;
    use Classi\{Computer,Periferica,Libro,Rivista};
    if($categoria ==''){
      echo $this->insert('cat_insert');
      //exit() -> Non carica layout con exit
    }
    else{
      $table = $categoria;
      $filter = new Filter();
      if($filter->isTable($table)===false){
        header('location:r-404.php');
      }
      unset($c);
      $error_upload=false;
  ?>
    <h1>
        Inserisci un nuovo record nella categoria <?=$table?>
    </h1>
<div>          <div class="alert alert-danger" role="alert">
              N.B: Inserire un ID Catalogo che non sia già presente nel DB!
          </div>
      <div>
        <fieldset>
          <form action="backend/insertrecord.php" method="post" enctype="multipart/form-data">
          <?= "<input type='hidden'id='categoria' name='categoria' value='".$table."'>";?>
          <table class="table">
            <tbody class="thead-dark">
                <?php
                $table = ucfirst($table);
                $table = "Classi\\".$table;
                $rc = new ReflectionClass($table);
                $props = $rc->getProperties();
                echo "<tr><th scope='row'><label for='id_catalogo'>ID Catalogo*</label></th>";
                //echo "<td><input type='text' id='id_catalogo' name='id_catalogo' required> <!--<div hidden id='hiddentd'>--><p id='ajaxcall' hidden>  </p><!--</div>--></td>";
                echo "<td><input type='text' id='id_catalogo' name='id_catalogo' required><p id='ajaxcall' hidden></p></td>";
                echo "</tr>";
                  for($i=1; $i<($table::CAMPI); $i++){
                    echo "<tr>";
                    echo "<th scope='row'><label for=".$table::CATEGORIE[$i].">".$table::CATEGORIE[$i];
                    if($i<$table::N_OBBLIGATORI)
                        echo "*";
                    echo "</label></th>";
                    echo "<td>";
                    if($i===$table::CAMPI-3)
                         echo "<textarea id='".$this->e($table::CATEGORIE[$i])."' name='".$this->e($table::CATEGORIE[$i])."'></textarea></td>";
                    else{
                        switch($props[$i]->getType()->getName()){
                          case "int":
                            $type = "number";
                            break;
                          case "string":
                            $type = "text";
                            break;
                          case "float":
                              $type = "number' step='0.01";
                              break;
                        }
                        echo "<input type='$type' id='".$this->e($table::CATEGORIE[$i])."' name='".$this->e($table::CATEGORIE[$i])."' ";
                        if(strtolower($table::CATEGORIE[$i])==="anno"){
                          echo " step='1' min='1800' max='2099' placeholder='YYYY'";
                        }
                      if($i<$table::N_OBBLIGATORI)
                          echo " required";
                      echo "></td>";
                    }
                    echo "</tr>";
                  }
                   ?>
              <tr>
                <th>
                <label for="upfile">Foto:</label></th>
                <td>
                  <div class="input-group">
                        <input type="file" id="upfile" name="upfile[]" class="form-control"  aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="image/x-png,image/gif,image/jpeg" multiple/>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan=2><!--class="text-center"-->
                <!--<span id='sp-disabled' class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Inserisci un id valido!">-->
                  <button class='btn btn-primary'type="submit" value="Submit" name="submit" id="submitbutton" disabled>Submit</button>
                <!--</span>-->
                  <button class='btn btn-warning' type="reset" value="Reset" onclick="resettami()">Reset</button>
                </td>
              </tr>
            </tbody>
          </table>
          </form>
        </fieldset>
      </div>
      </div>
      <script src="scripts/ajax.js"></script>
      <script src="scripts/insert-check.js"></script>

<?php } ?>