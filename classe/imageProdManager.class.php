<?php
class ImageProdManager{

    private $_bdd;

    public function __construct($bdd) {
        $this->setbdd($bdd);
    }

    public function add(ImageProd $imageProd) {
        $req = $this->_bdd->prepare('INSERT INTO imageprod (id, cheminImg, idCateg) VALUES (:id, :cheminImg, :idCateg)');
        $req->bindValue(':id', $imageProd->getId());
        $req->bindValue(':cheminImg', $imageProd->getCheminImg());
        $req->bindValue(':idCateg', $imageProd->getIdCateg());
        $req->execute();
    }
    
    public function get($id) {
		$req = $this->_bdd->query('SELECT cheminImg, idCateg FROM imageprod Where id = '.$id);
		$d = $req->fetchAll(PDO::FETCH_ASSOC);
		return $d;
    }
    
    public function getOne($id) {
        $req = $this->_bdd->query("SELECT cheminImg FROM imageprod Where id = $id");
		$d = $req->fetch(PDO::FETCH_ASSOC);
		return $d['cheminImg'];
    }
    
    public function update(ImageProd $imageProd) {
        $img = substr($imageProd->getCheminImg(), 0, strpos($imageProd->getCheminImg(), '.'));
        $req = $this->_bdd->prepare("UPDATE imageprod SET id = :id, cheminImg = :cheminImg WHERE id = :id AND cheminImg LIKE '$img%'");
        $req->bindValue(':id', $imageProd->getId());
        $req->bindValue(':cheminImg', $imageProd->getCheminImg());
        $req->execute();
    }

    public function delete(ImageProd $imageProd) {
        $this->_bdd->query('DELETE FROM imageprod WHERE id = '.$imageProd->getId());
    }
    
    public function verif(ImageProd $imageProd) {
        $img = substr($imageProd->getCheminImg(), 0, strpos($imageProd->getCheminImg(), '.'));
		$req = $this->_bdd->prepare("SELECT * FROM imageprod Where id = :id AND cheminImg LIKE '$img%'");
        $req->bindValue(':id', $imageProd->getId());
        $req->execute();
        if ($req->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function setbdd(PDO $bdd) {
        $this->_bdd = $bdd;
    }
}
?>