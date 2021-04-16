<?php
session_start();

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
// $filter1 = $bdd->query('SELECT * FROM products p  WHERE p.name CONTAINS' $_POST["mark"]);
// $filter2 = $bdd->query('SELECT * FROM products p WHERE p.price >' $_POST["amount1"] 'AND price <' $_POST["amount2"]);

if(isset($_GET["action"])){
    switch($_GET["action"]) {
        case "add":
        if(isset($_POST["add"]))  
        {  
            if(isset($_SESSION["cart"]))  
            {  
                $array_id = array_column($_SESSION["cart"], "item_id");  
                if(!in_array($_GET["id"], $array_id))  
                {  
                        $count = count($_SESSION["cart"]);  
                        $cart = array(  
                            'item_id'        =>     $_GET["id"],  
                            'item_name'      =>     $_POST["name"],  
                            'item_price'     =>     $_POST["price"],  
                            'item_quantity'  =>     $_POST["quantity"]  
                        );  
                        $_SESSION["cart"][$count] = $cart;  
                }  
                else  
                {  
                    $key = array_key_exists($_SESSION["cart"], $_GET["id"]);
                    $cart = array(  
                        'item_id'        =>     $_GET["id"],  
                        'item_name'      =>     $_POST["name"],  
                        'item_price'     =>     $_POST["price"],  
                        'item_quantity'  =>     $_POST["quantity"]  
                    );  
                    $_SESSION["cart"][$key] = array_merge($_SESSION["cart"], $cart);
                }  
            }  
            else  
            {  
                $cart = array(  
                        'item_id'         =>     $_GET["id"],  
                        'item_name'       =>     $_POST["name"],  
                        'item_price'      =>     $_POST["price"],  
                        'item_quantity'   =>     $_POST["quantity"]  
                );  
                $_SESSION["cart"][0] = $cart;  
            }  
        }
        break;
        case "delete":
            foreach($_SESSION["cart"] as $keys => $values)  
            {  
                if($values["item_id"] == $_GET["id"])  
                {  
                    unset($_SESSION["cart"][$keys]);  
                }  
            }  
        break;
        case "empty":
            unset($_SESSION["cart"]);
        break;
    }
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Born To Ride - PHP Website </title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" type="text/css" rel="stylesheet" />

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- JQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 10000,
                values: [ 0, 10000 ],
                slide: function( event, ui ) {
                    $( "#amount1" ).val(ui.values[ 0 ] + "€");
                    $( "#amount2").val(ui.values[ 1 ] + "€");
                }
            });
        $( "#amount1" ).val($( "#slider-range" ).slider( "values", 0 ) + "€");
        $( "#amount2" ).val($( "#slider-range" ).slider( "values", 1 ) + "€");
        } );
  </script>
</head>

<?php include("components/header.php");?>

<body>

    <div class="cart_section">
        <h4 class="list-title"> Votre panier </h4>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix à l'unité</th>
                    <th scope="col">Prix total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
               
                <?php   
                    if(!empty($_SESSION["cart"])) {  
                        $total = 0;  
                        $total_quantity = 0;
                        foreach($_SESSION["cart"] as $keys => $values) {  
                ?>  

                <tr>
                    <th scope="row"><?php echo $values["item_name"];?></th>
                    <td><?php echo $values["item_quantity"];?></td>
                    <td><?php echo number_format($values["item_price"],2);?> €</td>
                    <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> €</td>
                    <td>  
                        <a href="index.php?action=delete&id=<?php echo $values["item_id"];?>"> 
                        <button type="button" class="btn btn-danger">Supprimer</button>
                    </a> 
                    </td>
                </tr>

                <?php  
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                    $total_quantity += $values["item_quantity"];
                }  
                ?>

                <tr>
                    <th>Total : </th>
                    <td colspan="2"><?php echo $total_quantity;?></td>
                    <td><?php echo number_format($total,2);?> €</td>
                    <td>
                        <a href="index.php?action=empty">
                        <button type="button" class="btn btn-outline-danger"> Vider le panier</button>
                    </td>

                <?php
                } else {
                ?>
                <tr>
                    <td colspan="5">
                    <?php echo "<h5>Votre panier est vide</h5>"?>
                    </td>
                </tr>
                <?php
                }
                ?>

            </tbody>

        </table>

    </div>

    <div class="product_section">
        <div class="catalog">
            <div class="menu">
                <div class="group">
                    <h4>Marques</h4>

                    <form method="post" action="index.php?action=mark">
                        <div class="choice">
                            <label>
                                <input type="checkbox" value="Rockrider" name="Rockrider"> Rockrider
                            </label>
                        </div>
                        <div class="choice">
                            <label>
                                <input type="checkbox" class="common_selector brand" value="Cube" name="Cube"> Cube
                            </label>
                        </div>
                        <div class="choice">
                            <label>
                                <input type="checkbox" class="common_selector brand" value="RockyMountain" name="RockyMountain"> Rocky Mountain
                            </label>
                        </div>
                        <div class="choice">
                            <label>
                                <input type="checkbox" class="common_selector brand" value="Other" name="Other"> Autres
                            </label>
                        </div>
                        <button type="submit" class="btn my-3" name="mark">Valider</button>
                    </form>
                </div>

                <div class="group">
                    <h4>Prix</h4>

                    <form method="post" action="index.php?action=filter">
                        <input type="" name="amount1" id="amount1" class="form-control" readonly>
                        <div id="slider-range" class="my-2"></div>
                        <input type="" name="amount2" id="amount2" class="form-control" readonly>
                        <button type="submit" class="btn my-3" name="filter">Valider</button>
                    </form>
                </div>
            </div>


            <diV class="products-list">

                <diV class="list-title">
                    <h3>Tous les produits</h3>
                </diV>

                <?php
                    if(isset($_POST["filter"])) {

                        if(isset($_POST["amount1"], $_POST["amount2"]) && !empty($_POST["amount1"]) && !empty($_POST["amount2"])) {
                            $min = $_POST["amount1"];
                            $max = $_POST["amount2"];
                            $query = "SELECT * FROM products WHERE price BETWEEN '$min' AND '$max'";
                        }
                        $reponse = $bdd->query($query);
                    }

                    if(isset($_POST["mark"])) {
                        if(isset($_POST["Rockrider"])) {
                            $query = "SELECT * FROM products WHERE category = 'Rockrider'";
                            $reponse = $bdd->query($query);
                        }
                        else {
                            if(isset($_POST["Cube"])) {
                                $query = "SELECT * FROM products WHERE category = 'Cube'";
                                $reponse = $bdd->query($query);
                            }
                            else {
                                if(isset($_POST["RockyMountain"])) {
                                    $query = "SELECT * FROM products WHERE category = 'RockyMountain'";
                                    $reponse = $bdd->query($query);
                                }
                            }
                        }
                    }


                    while ($product_array = $reponse->fetch())
                    {
                ?>
                <div class="column">

                    <div class="card shadow">
                        <div>
                            <img src="<?php echo $product_array["image"]?>" class="img-fluid card-img-top img">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product_array["name"]?></h5>
                            <p class="card-text">
                                <?php echo $product_array["description"]?>
                            </p>
                            <h5>
                                <span class="price"><?php echo $product_array["price"]?> €</span>
                            </h5>

                            <form method="post" action="index.php?action=add&id=<?php echo $product_array["id"]; ?>">  
 
                                <input type="hidden" name="name" value="<?php echo $product_array["name"]; ?>" />  
                                <input type="hidden" name="price" value="<?php echo $product_array["price"]; ?>" /> 

                                <div class="input-bar">
                                    <div class="input-bar-item">
                                        <input type="text" name="quantity" class="form-control" placeholder="Quantité (ex: 1-9)" required pattern="[1-9]"/>
                                    </div>
                                    <div class="input-bar-item">
                                        <button type="submit" class="btn my-3" name="add">Ajouter au panier</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }

                $reponse->closeCursor();
                ?>
            </diV>

        </div>
    </div>

</body>

</html>