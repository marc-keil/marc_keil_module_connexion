<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', '');


if(!isset($_SESSION['id']) ||  $_SESSION['id'] != 1) {
    exit();
}


if(isset($_GET['supprimer']) && !empty($_GET['supprimer'])) {
    $supprimer = (int) $_GET['supprimer'];
    $req = $bdd->prepare('DELETE FROM utilisateurs WHERE id = ?');
    $req->execute(array($supprimer));
}

$utilisateurs = $bdd->query('SELECT * FROM utilisateurs ORDER BY id ASC');

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
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylesss.css">
    <title>Espace Administrateur</title>
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
<body>
<main class="jacky">
            <div class="tajine">
                <section class="oui"><br/>
    <div align=center>
    <table border=1><br>
    <h2>Espace Administrateur</h2>
            <br />
        <thead>
        <tr class=test>
            <th class=test>ID</th>
            <th class=test>Login</th>
            <th class=test>Nom</th>
            <th class=test>Prénom</th>
            <th class=test>Action</th>
        </tr>
        </thead>
        <?php while($u = $utilisateurs->fetch()) { ?>
    <tr class=test>
      <td class=test><?= $u['id'] ?> </td>
      <td class=test><?= $u['login'] ?> </td>
      <td class=test><?= $u['nom'] ?> </td>
      <td class=test><?= $u['prenom'] ?> </td>
      <td class=test><a class=testad href="administration.php?supprimer=<?= $u['id'] ?>">Supprimer</a></td>
    </tr>
     
    <?php } ?>
    </table>
    <br>            <form method="POST" action="profil.php">
            <input type="submit" class ="formconnexion" name="Retour" value="Retour" ><br><br><br>
            </form>
    </div>
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
</head>