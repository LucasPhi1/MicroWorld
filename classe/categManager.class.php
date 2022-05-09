<?php
class CategManager{

    private $_bdd;

    public function __construct($bdd) {
        $this->setbdd($bdd);
    }

    public function add(Categ $categ) {
        $req = $this->_bdd->prepare('INSERT INTO categ (nom) VALUES (:nom)');
        $req->bindValue(':nom', $categ->getNom());
        $req->execute();
    }
    
    public function update(Categ $categ) {
        $req = $this->_bdd->prepare('UPDATE categ SET nom = :nom WHERE id = :id');
        $req->bindValue(':nom', $categ->getNom());
        $req->bindValue(':id', $categ->getId());
        $req->execute();
    }
    
    public function get($id) {
        $req = $this->_bdd->query('SELECT id, nom FROM categ Where id = '.$id);
		$d = $req->fetch(PDO::FETCH_ASSOC);
		return new Categ($d);
    }
    
    // pour renvoyer toute la liste des categorie
    public function getList() {
        $catg = [];
		$req = $this->_bdd->query('SELECT id, nom FROM categ ORDER BY id');
		while ($d = $req->fetch(PDO::FETCH_ASSOC)) {
            $catg[] = new Categ($d);
		}
		return $catg;
    }
    
    public function delete(Categ $categ) {
        $this->_bdd->query('DELETE FROM categ WHERE id = '.$categ->getId());
    }

    public function setbdd(PDO $bdd) {
        $this->_bdd = $bdd;
    }
}
?>