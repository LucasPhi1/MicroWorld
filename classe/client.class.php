<?php
class Client {
    public $id;
    public $nom;
    public $prenom;
    public $mail;
    public $tel;
    public $adresse;
    public $password;

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

    public function getPrenom() {
        return $this->prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getTel() {
        return $this->tel;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getPassword() {
        return $this->password;
    }

    //* les Sets
    public function setId($id_user) {
        $this->id = $id_user;
    }

    public function setNom($nom_user) {
        $this->nom = $nom_user;
    }

    public function setPrenom($prenom_user) {
        $this->prenom = $prenom_user;
    }

    public function setMail($mail_user) {
        $this->mail = $mail_user;
    }

    public function setTel($tel_user) {
        $this->tel = $tel_user;
    }

    public function setAdresse($adresse_user) {
        $this->adresse = $adresse_user;
    }

    public function setPassword($password_user) {
        $this->password = $password_user;
    }
}
?>
