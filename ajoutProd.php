<?php session_start(); 
	if(empty($_SESSION['id'])){
		header('location:index.php');
		exit();
	}
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MW</title>
	<?php require_once "include/head.php"; ?>
    
</head>
	<body class="body-bg-white">
		<?php
		require_once "include/autoload.php";
		require_once "include/nav.php";

		if (isset($_POST['submit'])) {
			$v = true;
			$nom = addslashes(htmlspecialchars($_POST['nom']));
			$ancienPrix = htmlspecialchars($_POST['ancienPrix']);
			$prixPromo = htmlspecialchars($_POST['prixPromo']);
			$categ = htmlspecialchars($_POST['categ']);
			$description = htmlspecialchars($_POST['description']);

			if (!empty($_FILES['img']['name'])) {
				$img = $_FILES['img'];
				$ext_img = ".".strtolower(substr(strrchr($_FILES['img']['name'], "."), 1));
				if ($ext_img != ".jpeg" && $ext_img != ".JPEG" && $ext_img != ".jpg" && $ext_img != ".JPG" && $ext_img != ".png" && $ext_img != ".PNG") {
					$v = False;
					$monErreur = "l'image ne correspond pas elle n'as pas le bon format";
				}
			} else {
				$v = false;
				$monErreur = "une image est requise.";
			}
			
			
			if ($v == true) {
				$managerProduit = new ProduitManager($bdd);
				$managerProduit->add(
					new Produit([
						"Nom" => $nom,
						"AncienPrix" => (int)$ancienPrix,
						"PrixPromo" => (int)$prixPromo,
						"IdCateg" => (int)$categ,
						"Description" => $description
					])
				);
				$id = $managerProduit->getByNom($nom)->id;
				$categ = htmlspecialchars($_POST['categ']);
				mkdir('imageProd/'.$id);
				$chemin_img = 'imageProd/'.$id.'/img'.$ext_img;
				$tmp_img = $_FILES['img']['tmp_name'];
				$managerImageProduit = new ImageProdManager($bdd);
				$managerImageProduit->add(
					new ImageProd([
						"Id" => $id,
						"CheminImg" => $chemin_img,
						"IdCateg" => (int)$categ
					])
				);
				move_uploaded_file($tmp_img, $chemin_img);

				
			}
		}
		?>
		<div class="box-perso text-center">
            <form method="post" enctype="multipart/form-data">
                <div class="card p-3 text-black" style="background-color: #8a8f94;">
                <h1 class="pb-4">Ajouter un Produit</h1>
                <div class="p-4" style="background-color: #a4aab0;">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
				<div class="mb-3">
					<label for="ancienPrix" class="form-label">ancien Prix</label>
					<input type="tel" class="form-control" id="ancienPrix" name="ancienPrix" required>
				</div>
                <div class="mb-3">
                    <label for="prixPromo" class="form-label">Prix Promo</label>
                    <input type="tel" class="form-control" id="prixPromo" name="prixPromo" required>
                </div>
				<div class="mb-3">
					<label for="description" class="form-label">description</label>
					<textarea class="w-100 form-control" name="description" id="description" rows="10"></textarea>
				</div>
				<div class="mb-3">
					<label for="categ" class="form-label">Categorie</label>
					<select class="form-select" name="categ" id="categ">
						<?php
							$managerCateg = new CategManager($bdd);
							$listeCateg = $managerCateg->getList();
							foreach ($listeCateg as $li) {
								echo '<option value="'.$li->id.'">'.$li->nom.'</option>';
							}
						?>
					</select>
				</div>
				<!-- Liste d'images -->
				<div class="image-produit-upload mb-3">
					<label class="form-label">Images (une image est requise)</label><br>
					<label for="img">
						<img src="./asset/img/dl.png" width="75" role="button"/>
                    <input class="form-control" type="file" name="img" id='img' onchange="loadFile(1, event)" required>
					
					<div>
						<img style="height:auto; width: 18%;" id="imgAffi" />
					</div>

                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary">Ajouter le produit</button>
                </div>
                </div>
            </form>
        </div>

		<?php require_once "include/footer.php"; ?>
	</body>
</html>