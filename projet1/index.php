<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
$connect = "";

if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $connect = "Vous êtes connecté(e)";
}
else
{
    $connect = "Connexion";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylesss.css">
    <title>Accueil</title>
</head>
<body>
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
                    <li><a href="inscription.php">Inscription</a>
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

    <main class="jacky">
            <div class="tajine">
                <section class="oui"><br/>
                     <p class="h5">Vous souhaitez un nouveau compte ?<br/>Consultez et échangez vos comptes entre membres.<br/>
                        Pour accéder à notre espace membre, veuillez-vous connecter.</p><br/>
                       <a href="connexion.php"><button type="button" class="button">Connexion</button><br/><br/></a>
                       <p class="h4">ou</p><br/>
                       <a href="inscription.php"><button type="button" class="button">Inscrivez-vous</button></a><br><BR><br>             
                </section>
            </div>
   </main>

    <footer>
                <div class="footerr">
                    <div>

                            <a href="https://github.com/Alex-Zicaro/voyages">
                            <img src="https://zupimages.net/up/21/43/vxwj.png" width="125" height="125">
                            </a>
                        
                    </div>


                        
                </div>
            </footer>
    

</body>
</html>