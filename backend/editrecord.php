<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Classidb\Classlogin;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    use App\Filter;
    $log = new Logger("utente");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
    $cn = new Classlogin;
    $pdo = $cn->userwithpermit();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $categoria = $_POST['categoria'];
    $id_catalogo = $_POST["id_catalogo"];
    $changed = $id_catalogo!==$_POST["id_attuale"];
    session_start();
    $query = "SELECT n_foto from $categoria WHERE id_catalogo=:id_catalogo";
    $sth = $pdo->prepare($query);
    $sth->bindParam('id_catalogo',$id_catalogo,PDO::PARAM_STR);
    $sth->execute();
    $n_foto_db = $sth->fetch();
    $n_foto_db = (int) $n_foto_db["n_foto"];
    $errore_upload=false;
    try{
        $pdo->beginTransaction();
        if($changed){
            $query="UPDATE id SET id_catalogo = :id_catalogo WHERE id_catalogo=:id_attuale;";
            $sth = $pdo->prepare($query);
            $sth->bindParam(":id_attuale",$_POST["id_attuale"],PDO::PARAM_STR);
            $sth->bindParam(":id_catalogo",$id_catalogo,PDO::PARAM_STR);
            $sth->execute();
        }
        $table = "Classi\\".ucfirst($categoria);
        $query = "UPDATE $categoria SET ";
        for($i=1; $i<$table::CAMPI; $i++){
            $query .= $table::CATEGORIE[$i]."= :".$table::CATEGORIE[$i];
            if($i!=$table::CAMPI-1){
                $query.=", ";
            }
        }
        $query .= " WHERE id_catalogo = :id_catalogo;";
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
                    $_POST[$campo]= (int)$_POST[$campo];
                    $type = PDO::PARAM_INT;
                }
                else{
                    $type = PDO::PARAM_STR;
                }
                    $sth->bindParam($campo,$_POST[$campo],$type);
            }
        
        }
        $sth->bindParam('id_catalogo',$_POST['id_catalogo'],PDO::PARAM_STR);
        $sth->execute();
        $log->info("User ".$_SESSION["User-ID"]." edited record ".$id_catalogo);
        $pdo->commit();
    }
    catch(PDOException $pdoe){
        $log->error("User ".$_SESSION["User-ID"]." non è riuscito a modificare ".$idcatalogo.". Errore: ".$pdoe->getMessage());
        $pdo->rollBack();
        //redirect
        echo "<script> alert(\"Elemento non modificato! Errore server, contatta admin!\");";
        echo "window.location.replace(\"../r-edit.php?id_catalogo=$id_catalogo&table=$categoria\");";
        echo "</script>";
        exit(); 
    }
    catch(Exception $ex){
        $log->error("User ".$_SESSION["User-ID"]." non è riuscito a modificare ".$idcatalogo.". Errore: ".$e->getMessage());
        $pdo->rollBack();
        //redirect
        echo "<script> alert(\"Elemento non modificato! Errore server, contatta admin!\");";
        echo "window.location.replace(\"../r-edit.php?id_catalogo=$id_catalogo&table=$categoria\");";
        echo "</script>";
        exit(); 
    }
    if($changed){
        $path    = '../upload/img/';
        $files = scandir($path);
        $nnum = count($files);
        $trov=0;
        $img = array();
        for($i=2; $i<$nnum && $trov<$n_foto_db; $i++){
            if(strpos($files[$i],$_POST["id_attuale"])!==false){
                $img[$trov]=$files[$i];
                $trov++;
            }
        }
        $rename_error=false;
        for($i=0; $i<$trov; $i++){
            $ext = strrchr($img[$i],".");
            $num="";
            if($i+1<10){
                $num = "0";
            }
            if(!rename($path.$img[$i],$path.$id_catalogo."_".$num.($i+1).$ext)){
                $log->error("Cannot rename ".$path.$img[$i]);
                $rename_error=true;
            }
        }
    }

    //Aggiunta FOTO
    if($_FILES['upfile']['error'][0]===0){ //Se ci sono file caricati       
        $n_foto = sizeof($_FILES['upfile']['name']);
        $j=0;
        for($i=0; $i<$n_foto; $i++){
            $path = '../upload/img/' . $_POST['id_catalogo']."_";
            $ext = substr($_FILES['upfile']['type'][$i],strpos($_FILES['upfile']['type'][$i],"/")+1);
            //if($ext=="jpeg") $ext ="jpg";
            $ext= ($ext=="jpeg") ? "jpg" : $ext;
            $filter = new Filter();
            if($filter->isImage($ext)!==false){
                $pos_trovata = false;
                $path_provv = $path;
                do{
                    $numero = $j+$i;
                    if($numero+1<10){
                        $path_provv.="0";
                    }
                    $path_provv.=($numero+1);
                    $extensions = array('.jpg', '.png', '.gif');
                    $pos_occupata=false;
                    $num_ext = count($extensions);
                    for ($k=0; $k<$num_ext && $pos_occupata===false; $k++) {
                        if (file_exists($path_provv.$extensions[$k])) {
                            $j++;
                            $pos_occupata=true;
                        }
                    }
                    if($pos_occupata===false)
                    {
                        $pos_trovata =true;
                        if($numero+1<10){
                            $path.="0";
                        }
                        $path.=($numero+1);
                    }
                }while(!$pos_trovata);
                $path.=".".$ext;
                $errore_upload=false;
                if (!move_uploaded_file ($_FILES['upfile']['tmp_name'][$i], $path)){
                        $log->error("Error ".$_FILES['upfile']['tmp_name'][$i]."cannot saved as ".$path);
                        $n_foto--;
                        $errore_upload=true;
                    }
                else{
                    $log->info("User ".$_SESSION["User-ID"]." Uploaded ".$_FILES['upfile']['tmp_name'][$i]." saved as ".$path);
                }
            }
            else{
                $log->error("User ".$_SESSION["User-ID"]." Uploaded ".$_FILES['upfile']['tmp_name'][$i]." with unaccetable extention");
                $errore_upload = true;
                $n_foto--;
            }
        }
        //SE TUTTO VA BENE
        //QUERY UPDATE N_FOTO
        if($n_foto>0){
            $tot_foto = $n_foto+$n_foto_db;
            try{
                $pdo->beginTransaction();
                $query = "UPDATE $categoria SET n_foto = :n_foto WHERE id_catalogo=:id_catalogo";
                $sth = $pdo->prepare($query);
                $sth->bindParam(":n_foto",$tot_foto,PDO::PARAM_INT);
                $sth->bindParam(":id_catalogo",$id_catalogo,PDO::PARAM_STR);
                $sth->execute();
                $pdo->commit();
            }
            catch(PDOException $pdoe){
                $pdo->rollBack();
                $log->error("User ".$_SESSION["User-ID"]." non è riuscito a modificare (Query update foto) ".$idcatalogo.". Errore: ".$pdoe->getMessage());
                $errore_upload = true;
            }
            catch(Exception $ex){
                $pdo->rollBack();
                $log->error("User ".$_SESSION["User-ID"]." non è riuscito a modificare (Query update foto) ".$idcatalogo.". Errore: ".$ex->getMessage());
                $errore_upload = true;
            }
        }
    }
    if($errore_upload===true){
        echo "<script> alert(\"Elemento modificato con successo, ma errore nel caricamento di una o più foto!\");";
        echo "window.location.replace(\"../r-edit.php?id_catalogo=$id_catalogo&table=$categoria\");";
        echo "</script>";
        exit();
    }
    //SE TUTTO BENE -> REDIRECT/ALERT
?>
<script>
    alert("Elemento modificato con successo!");
    <?= "window.location.replace('../r-edit.php?id_catalogo=$id_catalogo&table=$categoria');";?>
</script>