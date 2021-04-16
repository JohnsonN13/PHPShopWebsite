<?php

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Born To Ride - PHP Website</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="https://kit.fontawesome.com/8b650b525a.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"> -->

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        function btnclick(_url) {
            $.ajax({
                url: _url,
                type: 'post',
                success: function(data) {
                    $('#content').html(data);
                },
                error: function() {
                    $('#content').text('An error occurred');
                }
            });
        }
    </script>
</head>

<body>

    <div class="wrapper">

        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Born To Ride</h3>
            </div>

            <div class="sidebar-profile">
                <img src="images/avatar.png" alt="Avatar">
                <p> Bienvenue John Doe </p>
            </div>

            <div class="components">
                
                <a href="" onclick="btnclick('components/manage.php')">Gestion du site</a>
               
                <div class="dropdown">
                <a href="" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle"> Produits</a>
                    <div class="dropdown-menu" id="pageSubmenu">
                        <a href="#" class="dropdown-item" onclick="btnclick('components/allproducts.php')">Tous les produits</a>
                        <a href="#" class="dropdown-item" onclick="btnclick('components/addproduct.php')">Ajouter un nouveau produit</a>
                    </div>
                </div>
                
                <a href="#" disabled>Contact</a>
                
            </div>

            <div class="back">
                <a href="index.php" class="article">
                    <button type="button" class="btn btn-warning">Revenir au magasin</button>
                </a>
            </div>

        </nav>

        <div id="contentside">

        <div id="navup">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <h4> Partie administrateur</h4>
                </div>
            </nav>
        </div>


        <div id="content">

            <?php include('components/manage.php');?>
        </div>
    </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="main.js"></script>

</body>

</html>