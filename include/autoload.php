<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=microworld1;charset=utf8','root','');
}catch(PDOException $e){
    die(print_r("Erreur bdd:".$e->getMessage()));
}

spl_autoload_register(function($class) {
    require_once("classe/$class.class.php");
});
