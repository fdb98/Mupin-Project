<?php
    declare(strict_types=1);
    namespace Classi;
    
    class Computer{
        
        private String $id_catalogo;
        private String $modello;
        private int $anno;
        private String $CPU;
        private float $Frequenza_HZ;
        private int $RAM;
        private ?float $HDD;
        private ?String $SO;
        private ?String $Note;
        private ?String $URL_materiale_ricerca;
        private ?String $Tag;
        private int $n_foto=0;

        const N_OBBLIGATORI=6;
        const CAMPI=11;
        const CATEGORIE = ["id_catalogo", "modello","anno","CPU","Frequenza_HZ","RAM","HDD","SO","Note","URL_materiale_ricerca","Tag"];


        public function __get($name)
        {
            return $this->$name;
        }

        public function getH1(){
            return $this->id_catalogo." - ".$this->modello;
        }


        
    }
?>
