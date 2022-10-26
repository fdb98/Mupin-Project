<?php
    declare(strict_types=1);
    namespace Classi;
    class Rivista{

        private String $id_catalogo;
        private String $Titolo;
        private int $n_rivista;
        private int $Anno;
        private String $Casa_editrice;
        
        private ?String $Note;
        private ?String $URL_materiale_ricerca;
        private ?String $Tag;
        private int $n_foto=0;
        

        const N_OBBLIGATORI=5;
        const CAMPI=8;
        const CATEGORIE = ["id_catalogo", "Titolo","n_rivista","Anno","Casa_editrice","Note","URL_materiale_ricerca","Tag"];


        public function __set($name, $value)
    {
        $this->$name=$value;
    }
        public function __get($name)
        {
            return $this->$name;
        }

        public function getH1(){
            return $this->id_catalogo." - ".$this->Titolo;
        }

    }