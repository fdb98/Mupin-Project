<?php
    declare(strict_types=1);
    use Classidb\Classlogin;
    $cn = new Classlogin;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    <?= $this->e($record->getH1()) ?>
</h1>

    <div class="table-responsive">
        <table class="table">
          <tbody class="thead-dark">
              <?php
                for($i=0; $i<($record::CAMPI); $i++){
                  $value = $record->{$record::CATEGORIE[$i]};
                  echo "<tr><th scope='row'>".$this->e($record::CATEGORIE[$i])."</th>";
                  echo "<td><input type='text' id='".$this->e($record::CATEGORIE[$i])."' value='".$this->e($value)."' readonly></td></tr>";
                }
                echo "<tr><td colspan=3><input type='hidden' id='n_foto' value='".$this->e($record->n_foto)."'></td></tr>";
                if($record->n_foto > 0){
                    echo "<tr><th scope='row' colspan=2>Foto</th></tr>";
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
                        echo "<tr><td colspan=2 class='fotodb'><img src='".$this->e($path.$img[$i])."' class='fotodb'></td></tr>";
                    }
                }
                ?>
            </tr>
          </tbody>
        </table>
    </div>