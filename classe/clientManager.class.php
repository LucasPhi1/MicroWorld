<?php
class ClientManager{

    private $_bdd;

    public function __construct($bdd) {
        $this->setbdd($bdd);
    }

    public function inscription(Client $client) {
        //* requête afin de verififier si le mail n'est pas deja utilisé
        $req = $this->_bdd->prepare("SELECT * FROM client WHERE mail = :mail");
        $req->bindValue(':mail', $client->getMail());
        $req->execute();
        $result = $req->rowCount();
        if ($result > 0) {
            return "l'addresse mail appartient déjà à un compte";
        }
    
        //* requête pour inseret les données dans la table client
        $req = $this->_bdd->prepare('INSERT INTO client (nom, prenom, mail, tel, adresse, password) VALUES (:nom, :prenom, :mail, :tel, :adresse, :password)');
        //* bindValue va associer la valeur entrer a un paramètre
        $req->bindValue(':nom', $client->getNom());
        $req->bindValue(':prenom', $client->getPrenom());
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':tel', $client->getTel());
        $req->bindValue(':adresse', $client->getAdresse());
        $req->bindValue(':password', $client->getPassword());
        $req->execute();
        
        $req = $this->_bdd->prepare('SELECT * FROM client WHERE mail = :mail');
        $req->bindValue(':mail', $client->getMail());
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        
        session_start();
        $_SESSION['id'] = $data['id'];
        $_SESSION['nom'] = $client->getNom();
        $_SESSION['prenom'] = $client->getPrenom();
        $_SESSION['mail'] = $client->getMail();
        $_SESSION['tel'] = $client->getTel();
        $_SESSION['adresse'] = $client->getAdresse();
        header("location:index.php");
    }
    
    public function connexion(Client $client) {    
        $req = $this->_bdd->prepare("SELECT mail, password FROM client WHERE mail = :mail AND password = :password");
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':password', $client->getPassword());
        $req->execute();
        $user_exist = $req->rowCount();
        if ($user_exist == 1) {
            $req = $this->_bdd->prepare("SELECT id, nom, prenom, mail, tel, adresse FROM client WHERE mail = :mail");
            $req->bindValue(':mail', $client->getMail());
            $req->execute();
            $data = $req->fetch(\PDO::FETCH_OBJ);
            $id = $data->id;
            $nom =  $data->nom;
            $prenom =  $data->prenom;
            $mail =  $data->mail;
            $tel =  $data->tel;
            $adresse =  $data->adresse;
            
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['mail'] = $mail;
            $_SESSION['tel'] = $tel;
            $_SESSION['adresse'] = $adresse;
            header("location:index.php");
        } else {
            return false;
        }
    }
    public function update(Client $client) {
        $req = $this->_bdd->prepare('UPDATE client SET nom = :nom, prenom = :prenom, mail = :mail, tel = :tel, adresse = :adresse, password = :password WHERE id = :id');
        $req->bindValue(':nom', $client->getNom());
        $req->bindValue(':prenom', $client->getPrenom());
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':tel', $client->getTel());
        $req->bindValue(':adresse', $client->getAdresse());
        $req->bindValue(':password', $client->getPassword());
        $req->bindValue(':id', $client->getId());
        $req->execute();
        $_SESSION['id'] = $client->getId();
        $_SESSION['nom'] = $client->getNom();
        $_SESSION['prenom'] = $client->getPrenom();
        $_SESSION['mail'] = $client->getMail();
        $_SESSION['tel'] = $client->getTel();
        $_SESSION['adresse'] = $client->getAdresse();
    }
    public function delete(Client $client) {
        $this->_bdd->query('DELETE FROM client WHERE id = '.$client->getId());
    }

    public function verifPassword(Client $client) {
        $req = $this->_bdd->prepare('SELECT * FROM client WHERE id = :id AND password = :password');
        $req->bindValue(':id', $client->getId());
        $req->bindValue(':password', $client->getPassword());
        $req->execute();
        $res = $req->rowCount();
        if ($res == 1) return true; //* si il y en a un on le delete
        if ($res == 0) return false; //* si il y en pas pas on fait rien
        
    }
    

    public function get($id) {
		$req = $this->_bdd->query('SELECT id, nom, prenom, mail, tel, adresse FROM client Where id = '.$id);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
    }


    public function setbdd(PDO $bdd) {
        $this->_bdd = $bdd;
    }
}
?>