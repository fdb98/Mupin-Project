<?php
declare(strict_types=1);
        /**
         * This function goes into loop if there isn't photo of the record with id_catalogo 
         * In this case is checkend before calling it.
         */
        function rename_first_foto($id_catalogo){
            $ext = "";
            $path = "../upload/img/".$id_catalogo."_01";
            $var1 = file_exists($path.".jpg");
            $var3 = file_exists($path.".png");
            $var2 = file_exists($path.".gif");
            if($var1===false && $var2===false && $var3===false){
                for($i=2; $ext===""; $i++){
                    $path = "../upload/img/".$id_catalogo."_";
                    $path.= ($i<10) ? "0" : "";
                    $path.=$i;
                    if(file_exists($path.".jpg")) $ext = ".jpg";
                    else if(file_exists($path.".png")) $ext = ".png";
                        else if(file_exists($path.".gif")) $ext = ".gif";
                }
                return rename($path.$ext,"../upload/img/".$id_catalogo."_01".$ext);
            }
            return 2;
        }
?>