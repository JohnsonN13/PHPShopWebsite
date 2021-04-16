<?php

try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;port=8889;dbname=borntoride;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM products ORDER BY id');

foreach($reponse as $product) {

?>

<div class="card2 shadow row">

    <div class="card-body col-md-6">
        <h5 class="card-title">Nom du produit : <?php echo $product["name"]?></h5>
        <p>Prix du produit : <span class="price"><?php echo $product["price"]?> €</span></p>
    </div>

    <div class="col-md-6 buttongrp" role="group">  
        <a class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Etat : actif">
            <i class="fas fa-check"></i>
        </a>
        <a class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier l'état">
            <i class="far fa-edit"></i>
        </a>
        <a class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer le produit">
            <i class="far fa-trash-alt"></i>
        </a>
    </div>

</div>

<?php
}
?>