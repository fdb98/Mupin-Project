<?php
    declare(strict_types=1);
    namespace Classi;
    class Libro{

        private String $id_catalogo;
        private String $titolo;
        private String $autore;
        private String $casa_editrice;
        private int $anno;
        private ?float $n_pagine;
        private ?String $ISBN;
        private ?String $Note;
        private ?String $URL_materiale_ricerca;
        private ?String $Tag;
        private int $n_foto=0;


        const N_OBBLIGATORI=6;
        const CAMPI=10;
        const CATEGORIE = ["id_catalogo", "titolo","autore","casa_editrice","anno","n_pagine","ISBN","Note","URL_materiale_ricerca","Tag"];

        public function __set($name, $value)
    {
        $this->$name = $value;
    }
        public function __get($name)
        {
            return $this->$name;
        }

        public function getH1(){
            return $this->id_catalogo." - ".$this->titolo;
        }
    }