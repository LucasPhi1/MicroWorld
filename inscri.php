<!DOCTYPE HTML>
<html>
	<head>
		<title>Inscri</title>
        <?php require_once "include/head.php"; ?>
	</head>	
	<body class="body-bg-white">
    <?php
        require_once "include/autoload.php";
        require_once "include/nav.php";

        if (isset($_POST['submit'])){
        
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);          
            $tel = htmlspecialchars($_POST['tel']);
            $mail = htmlspecialchars($_POST['mail']);
            $adresse = htmlspecialchars($_POST['adresse']);
            if ($_POST['password1'] == $_POST['password2']) {
                $password = sha1($_POST['password1']);
                $manager = new ClientManager($bdd);
	    		$monErreur = $manager->inscription(
                    new Client([
                        "Nom" => $nom,
                        "Prenom" => $prenom,
	    			    "Mail" => $mail,
                        "Tel" => $tel,
                        "Adresse" => $adresse,
	    			    "Password" => $password
	    		    ])
                );

            } else {
                $monErreur = "Vos deux mots de passe entrée ne sont pas identique";
            }
        }

        ?>
        <div class="row justify-content-center mt-4" >                 
            <div class="col-4 text-center" style="background-color: #8a8f94;">
                <form method="post">
                    <h1>Inscription</h1>
                    <div class="p-4" style="background-color: #a4aab0;">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="password1" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password1" name="password1" required>
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                    </div>
                   
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse mail</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Telephone</label>
                        <input type="tel" class="form-control" id="tel" name="tel" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
                <hr/>
                <?php if (isset($monErreur)) echo $monErreur.'<hr/>'; ?>
                    <a href="connexion.php"class="link-danger">Vous êtes déjà inscri connectez-vous</a>
            </div>
        </div>

            <?php require_once "include/footer.php"; ?>
	</body>
</html>