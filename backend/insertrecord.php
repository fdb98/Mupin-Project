<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Classidb\Classlogin;
    use App\Filter;
    $cn = new Classlogin;
    $pdo = $cn->userwithpermit();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $log = new Logger("utente");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
    session_start();
    $categoria = $_POST['categoria'];
    $errors_upload=false;
    try{
        $pdo->beginTransaction();
    
        $query="INSERT INTO id VALUES (:id_catalogo);";
        $sth = $pdo->prepare($query);
        $sth->bindParam(":id_catalogo",$_POST["id_catalogo"],PDO::PARAM_STR);
        $sth->execute();


        $table = "Classi\\".ucfirst($categoria);
        $campiquery = implode(",",$table::CATEGORIE);
        $query = "INSERT INTO $categoria (".$campiquery.")
                VALUES (:".$table::CATEGORIE[0];
        for($i=1; $i<$table::CAMPI; $i++){
            $query .= ", :".$table::CATEGORIE[$i];
        }
        $query .= ");";
        
        $sth = $pdo->prepare($query);
        $rc = new ReflectionClass($table);
        $props = $rc->getProperties();

        for($i=0; $i<$table::CAMPI; $i++){
            $campo = $table::CATEGORIE[$i];
            if($_POST[$campo]===""){
                $v =null;
                $sth->bindParam($campo,$v,PDO::PARAM_NULL);
            }
            else{
                if($props[$i]->getType()->getName()==="int"){
                    $_POST[$campo]= intval($_POST[$campo]);
                    var_dump($_POST);
                    $type = PDO::PARAM_INT;
                }
                else{
                    $type = PDO::PARAM_STR;
                }
                    $sth->bindParam($campo,$_POST[$campo],$type);
            }
        
        }
        $sth->execute();

        $pdo->commit();
    }
    catch(PDOException $pdoe){
        $log->error("User ".$_SESSION["User-ID"]." non è riuscito a inserire ".$_POST["id_catalogo"].". Errore: ".$pdoe->getMessage());
        $pdo->rollBack();
        echo "<script>alert(\"Impossibile inserire l'elemento!\");";
        echo "window.location.replace(\"../r-insert.php?table=$categoria\");";
        echo "</script>";
        exit();
    }
    catch(Exception $ex){
        $log->error("User ".$_SESSION["User-ID"]." non è riuscito a inserire ".$_POST["id_catalogo"].". Errore: ".$e->getMessage());
        $pdo->rollBack();
        echo "<script>alert(\"Impossibile inserire l'elemento!!\");";
        echo "window.location.replace(\"../r-insert.php?table=$categoria\");";
        echo "</script>";
        exit();
    }
    //INSERIMENTO FOTO
    if($_FILES['upfile']['error'][0]===0){        
        //SALVATAGGIO FOTO
        $n_foto = sizeof($_FILES['upfile']['name']);
        $error_upload = false;
        for($i=0; $i<$n_foto; $i++){
            $path = '../upload/img/' . $_POST['id_catalogo']."_"; 
            if($i+1<10){
                $path.="0";
            }
            $ext = substr($_FILES['upfile']['type'][$i],strpos($_FILES['upfile']['type'][$i],"/")+1);
            $ext= ($ext=="jpeg") ? "jpg" : $ext;
            $filter = new Filter();
            if($filter->isImage($ext)!==false){
                $path.=($i+1).".".$ext;
                if (!move_uploaded_file ($_FILES['upfile']['tmp_name'][$i], $path)){
                 //ERROR
                    $log->error("Errore nel salvataggio foto");
                    $n_foto--;
                    //Notifica all'utente che non hai salvato foto
                    $error_upload = true;
                }
            }
            else{
                $n_foto--;
                $log->error("User ".$_SESSION["User-ID"]."tryed to add a file with an unaccettable extension");
                $error_upload = true;
            }
        }
        //SE TUTTO VA BENE
        if($n_foto>0){
            //QUERY UPDATE N_FOTO
            try{
                $pdo->beginTransaction();
                $query = "UPDATE $categoria SET n_foto = :n_foto WHERE id_catalogo=:id_catalogo";
                $sth = $pdo->prepare($query);
                $sth->bindParam(":n_foto",$n_foto,PDO::PARAM_INT);
                $sth->bindParam(":id_catalogo",$_POST["id_catalogo"],PDO::PARAM_STR);
                $sth->debugDumpParams();
                $sth->execute();
                $pdo->commit();

                $log->info("Record added succesfly. ID-Catalogo:".$_POST["id_catalogo"]." by User ".$_SESSION["User-ID"]);
            }
            catch(PDOException $pdoe){
                $log->error("Query Update n_photo error! Error: ".$pdoe->getMessage());
                $pdo->rollBack();
            }
            catch(Exception $ex){
                $pdo->rollBack();
                $log->error("Errore nella query "+$ex->getMessage());
                $error_upload = true;
            }
        }
    }
    if($error_upload){?>
        <script>
        alert("Elemento salvato con successo, ma problemi nel salvataggio degli allegati. Reinserirli dalla pagina upload!");
        <?= "window.location.replace(\"../r-catalogo.php?id_catalogo=".$_POST["id_catalogo"]."&table=$categoria\")";?>
        </script>
        <?php exit();
    }
    //SE TUTTO BENE -> REDIRECT/ALERT
?>
<script>
    alert("Elemento inserito con successo!");
    <?= "window.location.replace(\"../r-catalogo.php?id_catalogo=".$_POST["id_catalogo"]."&table=$categoria\")";?>
</script>