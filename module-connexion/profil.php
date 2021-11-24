<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=marc-keil_moduleconnexion', 'marc-keil', 'pizza1013');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $getid = intval($_SESSION['id']); // Convertie ma valeur en int ( ID = un numéro )
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?'); // créer une requete qui va récuperer tout de mon utilisateur de mon id actuel
    $requtilisateur->execute(array($getid)); // return le tableau de mon utilisateur
    $infoutilisateur = $requtilisateur->fetch(); // récupere les informations que j'appelle

    if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
    
{
    $connect = "Vous êtes connecté(e)";
}
else
{
    $connect = "Connexion";
}
        
    

?>

<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylesss.css">
    <title>Espace Membre</title>
    </head>
    <header class="page-header" >
        <div class="banner">
            <h1 class="titre1">
                <a href="./index.php">
                    Accueil
                </a>
            </h1>
        </div>
            <nav>
                <ul>          
                    <li><a href="index.php">Accueil</a>
                    </li>
                    <li><a href="connexion.php"><?php echo $connect; ?></a>
                   </li>
                   <?php if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
                    { ?>
                    <li><a href="deconnexion.php"><input type="submit" name="boutondeco" class="boutondeco" value="Déconnexion"></a></li>
                    <?php
                    }    
                    ?>
                
                </ul>
            </nav>
    </header>
    <body>
    <main class="jacky">
            <div class="tajine">
                <section class="oui"><br/>
        <div align="center">
            <h2>Profil de <?php echo $infoutilisateur['login'] ?> </h2>
            <br /><br />
            Login = <?php echo $infoutilisateur['login'] ?>
            <br />
            Nom = <?php echo $infoutilisateur['nom'] ?>
            <br />
            Prenom = <?php echo $infoutilisateur['prenom'] ?>
            <br /><br />
            <a class="profila" href="editionprofil.php"> Editer son profil</a>
            <br /><br />
            <?php
            if($_SESSION['id'] == 1) 
    { ?>
            <a href="administration.php">
            <input type="submit" class="admin" name="admin" value="Administration">
            </a>
        <?php
    }
    ?>
            <br><br>
            <a href="deconnexion.php">
            <input type="submit" class ="deco" name="deconnexion" value="Se déconnecté"><br><BR><br>
            </a>

        </div>
        </section>
            </div>
   </main>
        <footer>
                <div class="footerr">
                    <div>

                            <a href="https://github.com/marc-keil/marc_keil_module_connexion">
                            <img src="https://zupimages.net/up/21/43/vxwj.png" width="125" height="125">
                            </a>
                        
                    </div>


                        
                </div>
            </footer>
    
</html>
<?php

}
?>