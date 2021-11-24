<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=marc-keil_moduleconnexion', 'marc-keil', 'pizza1013');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    // $getid = intval($_SESSION['id']);
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();

    if(isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $infoutilisateur['login'])
    {
        $login= $_POST['newlogin']; 
        $requetelogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // SAVOIR SI LE MEME LOGIN EST PRIS
        $requetelogin->execute(array($login));
        $loginexist = $requetelogin->rowCount(); // rowCount = Si une ligne existe = PAS BON

        if($loginexist !== 0) 
        {
            $msg = "Le login existe déjà !";
        }
        else 
        {
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin->execute(array($newlogin, $_SESSION['id']));
        header('Location: profil.php');
        }
    }

    
    if(isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $infoutilisateur['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('Location: profil.php');
    }


    if(isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $infoutilisateur['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('Location: profil.php');
    }

    if(isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2']))
    {
    
       $mdp1 = $_POST['newmdp'];
       $mdp2 = $_POST['newmdp2'];
        
        if($mdp1 == $mdp2)
        {
            $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
            $insertmdp = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $insertmdp->execute(array($hachage, $_SESSION['id']));
            header('Location: profil.php');
        }
        else
        {
            $msg = "Vos mots de passes ne correspondent pas !";
        }
    
    }
 
    
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
    <title>Edition profil</title>
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
            <h2>Edition de mon profil</h2>
            <br />
            <form method="POST" action="">
            <table>
                <tr>
                    <td class=test align="right">    
                    <label for="login">Login :</label><br /><br />
                    </td>
                    <td class=test>
                    <input type="text" name="newlogin" placeholder="Login" value="<?php echo $infoutilisateur['login']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="prenom">Prenom :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newnom" placeholder="Nom" value="<?php echo $infoutilisateur['nom']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="nom">Nom :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $infoutilisateur ['prenom']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="newmdp">Password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp" placeholder="Mot de passe" > <br /><br />
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="newmdp2">Confirmation du password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp2" placeholder="Confirmation mot de passe" > <br /><br />
                    </td>
                </tr>
            </table>
            
            <?php 
        if(isset($msg))
        {
        echo '<font color="red">'.$msg.'</font><br /><br />'; 
        }
        ?>
        
            <a href="profil.php">
            <input type="submit" class ="formconnexion"name="confirmation" value="Confirmé !">
            </a>
            <br><br><br>
            <form method="POST" action="profil.php">
            <input type="submit" class ="formconnexion" name="Retour" value="Retour" ><br><br><br>
            </form>
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
else 
{
header("Location: connexion.php");
}

?>