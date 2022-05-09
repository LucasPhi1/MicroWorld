<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
        <?php require_once "include/head.php"; ?>
	</head>	
	<body class="body-bg-white">
<?php
		require_once "include/autoload.php";
		require_once "include/nav.php";

        if(isset($_POST['mail']) && isset($_POST['password'])){
            $mail = $_POST['mail'];
            $password = sha1($_POST['password']);

			$manager = new ClientManager($bdd);
			$Ok = $manager->connexion(
                new Client([
				    "Mail" => $mail,
				    "Password" => $password
			    ])
            );
            if ($Ok == false) $monErreur = "Votre Mail ou mot de passe est faux ou vous n'avez pas de compte";
        }
?>
    <div class="align-self-center">
        <div class="row justify-content-center mt-4">                  <!-- formulaire de connexion -->
            <div class="col-4 text-center" style="background-color: #8a8f94;">
                <form method="post">
                    <h1>Connexion</h1>
                    <div class="p-4" style="background-color: #a4aab0;">
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password1" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required >
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            <hr/>
            <?php if (isset($monErreur)) echo $monErreur.'<hr/>'; ?>
            <a href="inscri.php" class="link-danger">Vous disposer pas de compte vous pouvez en créer sue la page inscription</a>
        </div>
    </div>
        <?php require_once "include/footer.php"; ?>
	</body>
</html>