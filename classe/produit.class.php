<?php
class Produit {
    public $id;
    public $nom;
    public $ancienPrix;
    public $prixPromo;
    public $idCateg;
    public $description;

    function __construct(array $d) {
        $this->hydrate($d);
    }

    public function hydrate(array $d) {
	    foreach ($d as $key => $value) {
		    $method = 'set'.$key;
		    if (method_exists($this, $method)) {
			    $this->$method($value);
		    }
        }
    }

    //* les gets
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getAncienPrix() {
        return $this->ancienPrix;
    }
    
    public function getPrixPromo() {
        return $this->prixPromo;
    }

    public function getIdCateg() {
        return $this->idCateg;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDispo() {
        return $this->dispo;
    }

    //* les Sets
    public function setId($id_produit) {
        $this->id = $id_produit;
    }

    public function setNom($nom_produit) {
        $this->nom = $nom_produit;
    }

    public function setAncienPrix($ancienPrix_produit) {
        $this->ancienPrix = $ancienPrix_produit;
    }
    
    public function setPrixPromo($prixPromo_produit) {
        $this->prixPromo = $prixPromo_produit;
    }

    public function setIdCateg($id_categ) {
        $this->idCateg = $id_categ;
    }

    public function setDescription($description_produit) {
        $this->description = $description_produit;
    }

}
?>
