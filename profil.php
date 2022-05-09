<?php
session_start();
if(empty($_SESSION['id'])){
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "include/head.php"; ?>
</head>
	<body class="body-bg-#8a8f94">
		<?php
		require_once "include/autoload.php";
		require_once "include/nav.php";

        if (isset($_POST['submit'])) {
            $managerClient = new ClientManager($bdd);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $tel = htmlspecialchars($_POST['tel']);
            $mail = htmlspecialchars($_POST['mail']);
            $adress = htmlspecialchars($_POST['adress']);
            $dernierPassword = sha1($_POST['dernierPassword']);
            $dernierPasswordOk = $managerClient->verifPassword(
                new Client([
                    "Id" => $_SESSION['id'],
                    "Password" => $dernierPassword
                ])
            );
            if ($dernierPasswordOk == false) {
                $monErreur = "Le mot de passe ne correspond pas.";
            } else {
                if (!empty($_POST['Password1']) && !empty($_POST['Password2'])) {
                    if ($_POST['Password1'] == $_POST['Password2']) {
                        $password = sha1($_POST['Password1']);
                        $managerClient->update(
                            new Client([
                                "Id" => $_SESSION['id'],
                                "Nom" => $nom,
                                "Prenom" => $prenom,
                                "Tel" => $tel,
                                "Mail" => $mail,
                                "Adresse" => $adress,
                                "Password" => $password
                            ])
                        );
                    } else {
                        $monErreur = "Les mots de passe ne sont pas identique.";
                    }
                } else {
                    $managerClient->update(
                        new Client([
                            "Id" => $_SESSION['id'],
                            "Nom" => $nom,
                            "Prenom" => $prenom,
                            "Tel" => $tel,
                            "Mail" => $mail,
                            "Adresse" => $adress,
                            "Password" => $dernierPassword
                        ])
                    );
                }
            }
        }

		?>
<form class="box-perso" method="post">
    <div class="card p-3 text-black" style="background-color: #8a8f94;">
        <h2 class="text-center pb-2">Profil</h2>
        <?=@$monErreur?>
        <div class="p-4" style="background-color: #a4aab0;">
            <!-- Tableau des information de l'utilisateur -->
            <table class="table">
                <tbody>
              <tr>
                  <th>nom :</th>
                  <td><input type="text" class="form-control" name="nom" pattern="[a-zA-Zéè]{3,15}" value="<?=$_SESSION['nom']?>" required></td>
              </tr>
              <tr>
                <th>prenom :</th>
                <td><input type="text" class="form-control" name="prenom" pattern="[a-zA-Zéè]{3,15}" value="<?=$_SESSION['prenom']?>" required></td>
              </tr>
                <tr>
                    <th>mail :</th>
                    <td><input type="text" class="form-control" name="mail" pattern="[a-z0-9._%+-éèàùç]+@[a-z0-9.-]+\.[a-z]{2,3}" value="<?=$_SESSION['mail']?>" required></td>
                </tr>
              <tr>
                  <th>tel :</th>
                  <td><input type="tel" class="form-control" name="tel" pattern="[0-9]{10}" value="<?=$_SESSION['tel']?>" required></td>
                </tr>
                <tr>
                    <th>adresse :</th>
                    <td><input type="text" class="form-control" name="adress" value="<?=$_SESSION['adresse']?>" required></td>
                </tr>
                <tr>
                    <th>dèrnier mot de passe :</th>
                    <td><input type="password" class="form-control" name="dernierPassword" required></td>
                </tr>
              <tr>
                  <th>nouveau mot de passe :</th>
                  <td><input type="password" class="form-control" name="Password1"></td>
                </tr>
                <tr>
                    <th>nouveau mot de passe :</th>
                    <td><input type="password" class="form-control" name="Password2"></td>
                </tr>
            </tbody>
          </table>
          <button type="submit" name="submit" class="btn btn-outline-primary">Valider les changement</button>
          
        </div>
    </div>
</form>


		<?php require_once "include/footer.php"; ?>
	</body>
</html>