<?php
class Categ {
    public $id;
    public $nom;

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

    public function getNom() {
        return $this->nom;
    }
    
    //* les Sets
    public function setId($id_categ) {
        $this->id = $id_categ;
    }

    public function setNom($nom_categ) {
        $this->nom = $nom_categ;
    }

}
?>
