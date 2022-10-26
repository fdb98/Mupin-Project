<?php
declare(strict_types=1);

namespace App;

class Filter
{
    public function isEmail(string $email): bool
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)===false)
            return false;
        else
            return true;
    }

    public function isImage(string $file) : bool
    {
        $ext = strrchr($file,".");
        if($ext === false) return false;
        $ext = substr($ext,1);
        if(array_search($ext, array("png","jpg","gif"))===false)
            return false;
        else{
            return true;
        }
    }

    public function isTable(string $table) : bool
    {
        $c = array("computer","periferica","libro","rivista");
        $return = (array_search($table,$c)===false) ? false:true;
        return $return;
    }
}
