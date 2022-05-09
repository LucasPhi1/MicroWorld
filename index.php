<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>microworld</title>
	<?php require_once "include/head.php"; ?>
</head>
	<body>
		<?php
		require_once "include/autoload.php";
		require_once "include/nav.php";

		?>
<div style="
    text-align: center;
    margin-top: 10%;" >
	<img src="./asset/img/logoMW.png" >
</div>


		<?php require_once "include/footer.php"; ?>
	</body>
</html>