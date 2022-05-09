<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <div class="container-fluid">
        <a class="navbar-brand ps-2" href="index.php"><img src="./asset/img/logoMW.png" width="75"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idDeLaCible">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="idDeLaCible">
            <ul class="navbar-nav m-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="ordi.php">Ordinateur</a>
                </li>
                <li class="nav-item mx-2 dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Peripherique</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ecran.php">Ecran</a></li>
                        <li><a class="dropdown-item" href="clavier.php">Clavier</a></li>
                        <li><a class="dropdown-item" href="souris.php">Souris</a></li>
                    </ul>
                </li>
               
                <?php 
                if (isset($_SESSION['id'])) { 
                ?>
                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Produit</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ajoutProd.php">Ajouter un produit</a></li>

                        </ul>
                    </li>
                <?php 
                }
                if (isset($_SESSION['id'])) { 
                    echo '<li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>';
                }
                ?>
            </ul>
            <ul class="navbar-nav d-flex">
            <?php
                //* deconnection || connection et inscription
                    if (isset($_SESSION['id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="include/deco.php">Déconnexion</a></li>';
                    } else {
                        echo'<li class="nav-item"><a href="inscri.php" class="nav-link">Inscription</a></li>';
                        echo'<li class="nav-item"><a href="connexion.php" class="nav-link">Connexion</a></li>';
                    }
            ?>
            </ul> 
        </div>
    </div>
</nav>
