<?php
    declare(strict_types=1);
    echo $this->layout('pagina', ['title' => $title]);
    use Classidb\Classlogin;
      $cn = new Classlogin;
      $pdo = $cn->usernopermit();
      $query = "SELECT * from $table WHERE id_catalogo = :id";
      $sth = $pdo->prepare($query);
      $sth->bindValue(':id', $id_catalogo, PDO::PARAM_STR);

      $sth->execute();
      if($sth->rowCount()==0){
          header("location:r-404.php?id_catalogo=$id_catalogo&table=$table");
          exit();
      }

      $Classe = "Classi\\".ucfirst($table);
      $var = new $Classe;
      $sth->setFetchMode(PDO::FETCH_CLASS,$var::class);
      
      $record = $sth->fetch();
      ?>
  <h1>
     MODIFICA
  </h1>

  <h2>
    <?= $this->e($record->getH1()) ?>
  </h2>

    <div>
      <fieldset>
        <form action="backend/editrecord.php" method="post" enctype="multipart/form-data">
          <table class="table">
            <tbody class="thead-dark">
              <?php
              echo "<input type='hidden' id='categoria' name='categoria' value='".$table."'>"; 
              echo "<input type='hidden' id='id_attuale' name='id_attuale' value='".$this->e($record->id_catalogo)."'>";
              echo "<tr><th scope='row'><label for='id_catalogo'>ID Catalogo*</label></th>";
              echo "<td><input type='text' id='id_catalogo' name='id_catalogo' value='".$this->e($record->id_catalogo)."' required></td>";
              echo "<td id='hiddentd'><p id='ajaxcall'>  </p></td></tr>";
              echo "<input type='hidden' id='changed' name='changed' value='not_changed'>";
                for($i=1; $i<($record::CAMPI); $i++){
                  echo "<tr>";
                  $value = $record->{$record::CATEGORIE[$i]};
                  $categoria = $record::CATEGORIE[$i];
                  echo "<th scope='row'><label for='".$this->e($categoria)."'>".$this->e($categoria);
                  if($i<$record::N_OBBLIGATORI)
                      echo "*";
                  
                  echo "</label></th>";
                  echo "<td>";
                  if($i===$record::CAMPI-3)
                       echo "<textarea id='Note' name='Note'>".$this->e($value)."</textarea></td>";
                  else{
                      switch(gettype($value)){
                        case "integer":
                          $type = "number";
                          break;
                        case "string":
                          $type = "text";
                          break;
                        case "double":
                            $type = "number' step='0.1";
                            break;
                      }
                      echo "<input type='".$type."' name='".$this->e($categoria)."' id='".$this->e($categoria)."' value='".$this->e($value)."'";
                      if(strtolower($categoria)==="anno"){
                        echo " step='1' min='1800' max='2099' placeholder='YYYY' ";
                      }
                    if($i<$record::N_OBBLIGATORI){
                        echo " required";
                      }
                    echo "></td>";
                    }
                  echo "</tr>";
                  }
                  //PARTE FOTO
                  $path    = 'upload/img/';
                  $files = scandir($path);
                  $nnum = count($files);
                  $trov=0;
                  $img = array();
                  for($i=2; $i<$nnum && $trov<$record->n_foto; $i++){
                      if(strpos($files[$i],$id_catalogo)!==false){
                          $img[$trov]=$files[$i];
                          $trov++;
                      }
                  }
                  unset($files);
                  for($i=0; $i<$trov; $i++){
                      echo "<input type=\"hidden\" value=\"".$this->e($record->n_foto)."\" id='n_foto' >";
                      echo "<tr><td class='fotodb'><img class='fotodb' src='".$this->e($path.$img[$i])."' id='".$this->e($path.$img[$i])."'></td>";
                      echo "<td><button type='button' onclick='elimina_foto(\"".$this->e($path.$img[$i])."\")' id='btn-".$this->e($path.$img[$i])."'>Elimina</button></td></tr>";
                  }
                  ?>
                  <tr>
                    <th scope='row'><label for="upfile">Aggiungi Foto</label></th>
                  </tr>
                  <tr>
                    <td><input type="file" id="upfile" name="upfile[]" accept="image/x-png,image/gif,image/jpeg" multiple></td>
                </tr>               
              <tr>
                <td class='bottoni-submit' colspan=3>
                  <input type="submit" value="Submit" name="submit" id="submitbutton" disabled>
                  <input type="reset" value="Reset" onclick="resettami()" id="reset">
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </fieldset>
    </div>
    <script src="scripts/ajax.js"></script>
    <script src="scripts/elimina.js"></script>
    <script src="scripts/edit-check.js"></script>