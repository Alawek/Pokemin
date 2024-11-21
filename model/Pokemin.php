<?php

class Pokemin {
    private int $id;
    private string $nom;
    private string $description;
    private string $cri;
    private ?int $evolution1;
    private ?int $niveauEvolution1;
    private ?int $evolution2;
    private ?int $niveauEvolution2;
    private int $type1;
    private ?int $type2;

    public function __construct($id, $nom, $description, $cri, $evolution1, $niveauEvolution1, $evolution2, $niveauEvolution2, $type1, $type2) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->cri = $cri;
        $this->evolution1 = $evolution1;
        $this->niveauEvolution1 = $niveauEvolution1;
        $this->evolution2 = $evolution2;
        $this->niveauEvolution2 = $niveauEvolution2;
        $this->type1 = $type1;
        $this->type2 = $type2;
    }
}

