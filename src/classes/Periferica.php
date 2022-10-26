<?php
    declare(strict_types=1);
    namespace Classi;
    class Periferica{

        private String $id_catalogo;
        private String $Modello;
        private String $Tipo;

        private ?String $Note;
        private ?String $URL_materiale_ricerca;
        private ?String $Tag;

        private int $n_foto=0;


        const N_OBBLIGATORI=3;
        const CAMPI=6;
        const CATEGORIE = ["id_catalogo", "Modello","Tipo","Note","URL_materiale_ricerca","Tag"];

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        public function __get($name)
        {
            return $this->$name;
        }

        public function getH1(){
            return $this->id_catalogo." - ".$this->Modello;
        }
    }