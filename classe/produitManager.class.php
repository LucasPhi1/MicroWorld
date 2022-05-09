<?php
class ProduitManager{

    private $_bdd;

    public function __construct($bdd) {
        $this->setbdd($bdd);
    }

    public function add(Produit $produit) {
        $req = $this->_bdd->prepare('INSERT INTO produit (nom, ancienPrix, prixPromo, idCateg, description) 
        VALUES (:nom, :ancienPrix, :prixPromo, :idCateg, :description)');
        $req->bindValue(':nom', $produit->getNom());
        $req->bindValue(':ancienPrix', $produit->getAncienPrix());
        $req->bindValue(':prixPromo', $produit->getPrixPromo());
        $req->bindValue(':idCateg', $produit->getIdCateg());
        $req->bindValue(':description', $produit->getDescription());
        $req->execute();
    }

    public function update(Produit $produit) {
        $req = $this->_bdd->prepare('UPDATE produit SET nom = :nom, ancienPrix = :ancienPrix, prixPromo = :prixPromo, description = :description WHERE id = :id');
        $req->bindValue(':nom', $produit->getNom());
        $req->bindValue(':ancienPrix', $produit->getAncienPrix());
        $req->bindValue(':prixPromo', $produit->getPrixPromo());
        $req->bindValue(':id', $produit->getId());
        $req->bindValue(':description', $produit->getDescription());
        $req->execute();
    }

    public function delete(Produit $produit) {
        $this->_bdd->query('DELETE FROM produit WHERE id = '.$produit->getId());
    }

    public function get($id) {
		$req = $this->_bdd->query("SELECT nom, ancienPrix, prixPromo, idCateg, description FROM produit Where id = $id");
		$d = $req->fetch(PDO::FETCH_ASSOC);
        $d['nom'] = stripslashes($d['nom']);
        $d['description'] = stripslashes($d['description']);
		return new Produit($d);
    }

    public function getByCateg($idCateg) {
		$req = $this->_bdd->query("SELECT id, nom, ancienPrix, prixPromo, idCateg, description FROM produit Where idCateg = $idCateg ORDER BY id DESC");
		$d = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($d as $i => $val) {
            $d[$i]['nom'] = stripslashes($d[$i]['nom']);
            $d[$i]['description'] = stripslashes($d[$i]['description']);
        }
        return $d;
    }

    public function getByNom($nom) {
		$req = $this->_bdd->prepare("SELECT id, nom, ancienPrix, prixPromo, idCateg, description FROM produit Where nom = :nom");
        $req->bindValue(':nom', $nom);
        $req->execute();
		$d = $req->fetch(PDO::FETCH_ASSOC);
		return new Produit($d);
    }

    public function count() {
		$req = $this->_bdd->query("SELECT * FROM produit");
        return $req->rowCount();
    }


    public function setbdd(PDO $bdd) {
        $this->_bdd = $bdd;
    }
}
?>