<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "include/head.php"; ?>
    <script src="assets/js/pc-gamer.js"></script>
</head>
	<body class="body-bg-white">
		<?php
		require_once "include/autoload.php";
		require_once "include/nav.php";
		
        $req = $bdd->query("SELECT * FROM produit WHERE idCateg = '2' ");
        $produit = $req->fetchAll();
        $req = $bdd->query("SELECT cheminImg FROM imageProd WHERE idCateg = '2' ");
        $imageProd = $req->fetchAll();
        ?>
		<div class="box-produit">
			<h1 class="text-center pb-4">Écran</h1>
            <?php foreach($produit as $produit){ foreach($imageProd as $imageProd){?>
			<table id="datatable" class="table table-striped">
				<thead>
					<tr>
						<th class="no-sort"></th>
						<th>Photo : </br><img src='<?= $imageProd[0]?>'></th>
						<th>Nom : </br><?= $produit["nom"]?></th>
						<th>Ancien Prix : </br><?= $produit["ancienPrix"]?>€</th>
						<th>Prix en Promo : </br><?= $produit["prixPromo"]?>€</th>
						<th>Description : </br><?= $produit["description"]?></th>
					</tr>
				</thead>
			</table>
            <?php }}?>
		</div>
        
    

		<?php require_once "include/footer.php"; ?>
	</body>
</html>