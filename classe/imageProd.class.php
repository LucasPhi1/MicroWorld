<?php
class ImageProd {
    public $id;
    public $cheminImg;
    public $idCateg;

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

    //* les Gets
    public function getId() {
        return $this->id;
    }

    public function getCheminImg() {
        return $this->cheminImg;
    }

    public function getIdCateg() {
        return $this->idCateg;
    }

    //* les Sets
    public function setId($id_produit) {
        $this->id = $id_produit;
    }

    public function setCheminImg($chemin_image) {
        $this->cheminImg = $chemin_image;
    }

    public function setIdCateg($id_categ) {
        $this->idCateg = $id_categ;
    }
}
?>
