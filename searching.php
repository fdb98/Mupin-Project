<?php
     $table = $_POST["table"];
     session_start();
     $logged = isset($_SESSION["logged"]) && $_SESSION["logged"];
     require("vendor/autoload.php");
     $Classe = "Classi\\".ucfirst($table);
     use League\Plates\Engine;
     $templateas = new Engine('src/frontend');
     use Classidb\Classlogin;

     $cn = new Classlogin;
     $pdo = $cn ->usernopermit();
     $var = new $Classe;
     $query="SELECT * FROM $table WHERE";
     $entrato =false;
     for($i=0; $i<$var::CAMPI; $i++){
        if($_POST[$var::CATEGORIE[$i]]!==''){
            $query.=" ".$var::CATEGORIE[$i]." LIKE :".$var::CATEGORIE[$i]." AND";
            $entrato =true;
        }
     }
     if($entrato===false){
         echo "<script>";
         echo "alert(\"Non hai inserito campi, riprova!\");";
         echo "window.location.replace(\"r-advance_search.php\");";
         echo "</script>";
         exit();  
     }
     $query = substr($query,0,strlen($query)-3);
     $query.=";";
     $sth = $pdo->prepare($query);
     for($i=0; $i<$var::CAMPI; $i++){
        if($_POST[$var::CATEGORIE[$i]]!==''){
            $valore = "%".$_POST[$var::CATEGORIE[$i]]."%";
            $sth->bindParam(":".$var::CATEGORIE[$i],$valore,PDO::PARAM_STR);
        }
     }
     $sth->execute();
     $sth->setFetchMode(PDO::FETCH_CLASS,$var::class);
     if($sth->rowCount()>0)
      {
         echo $templateas->render('row_search',
            [
            'sth' => $sth,
            'logged' => $logged,
            'table' => $table
            ]);
         }
      else{
         echo "<script>";
         echo "alert(\"La ricerca non ha prodotto risultati, riprova!\");";
         echo "window.location.replace(\"r-advance_search.php\");";
         echo "</script>";
      }       

?>