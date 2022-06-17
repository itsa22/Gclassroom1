<?php
    session_start();

    $id_prof=$_SESSION['id_prof'];
    if(!isset($id_prof)){
        header("location: index.php");
        #echo "cannot login";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS/upd.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
        <a href="page_prof.php" class="btn btn-default accueil">Acceuil</a>
    <center>
        <form action="" method="post">
            <h1 style="font-size:40px;color:aliceblue">Modification du profile</h1>
            <div class="form-group">
                <label for="" style='color:white'>Nouveau nom</label>
                <input type="text" name="nouveau_nom" placeholder="Nouveau nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="" style='color:white'>Nouveau prenom</label>
                <input type="text" name="nouveau_prenom" placeholder="Nouveau prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="" style='color:white'>Nouveau tel</label>
                <input type="number" name="nouveau_tel" placeholder="Nouveau tel" class="form-control">
            </div>
            <?php
            include("fonction.php");
                if(!empty($_POST['nouveau_tel'])){
                    $nouveau_tel=$_POST['nouveau_tel'];
                    $update_tel=$conn->prepare("UPDATE professeur SET tel='$nouveau_tel' WHERE id_prof='$id_prof'");
                    $update_tel->execute();
                }

            ?>

            <div class="tt">
                <?php
                    include("fonction.php");
                    if(!empty($_POST['nouveau_mdp']) && !empty($_POST['nouveau_mdp2'])){
                        $nouveau_mdp=$_POST['nouveau_mdp'];
                        $nouveau_mdp2=$_POST['nouveau_mdp2'];
                            
                        if($nouveau_mdp==$nouveau_mdp2){
                            $update_mdp=$conn->prepare("UPDATE professeur SET mot_de_passe='$nouveau_mdp' WHERE id_prof='$id_prof'");
                            $update_mdp->execute();
                            echo "Le mot de passe a été changé";
                        }else{
                            echo("Retapez le nouveau mot de passe");
                        }
                    }else{
                        echo "Entrer le nouveau mot de passe";
                    }

                ?>
            </div>
            
            <div class="form-group">
                <input type="password" name="nouveau_mdp" placeholder="Nouveau mot de passe" class="form-control">
            </div>
            <div class="form-group">
                <br>
                <input type="password" name="nouveau_mdp2" placeholder="Confiremez mot de passe" class="form-control">
            </div>
            <br>
            <input type="submit" name="submit" value="Enregistrer" class="btn btn-success">
        </form>
        </center>    
        </div>
    </div>
</body>
</html>

<?php
include("fonction.php");
    if(!empty($_POST['nouveau_nom'])){
        $nouveau_nom=$_POST['nouveau_nom'];
        $update_nom=$conn->prepare("UPDATE professeur SET nom_prof='$nouveau_nom' WHERE id_prof='$id_prof'");
        $update_nom->execute();
        echo "votre nouveau nom est ",$nouveau_nom,"<br>";
    }
    if(!empty($_POST['nouveau_prenom'])){
        $nouveau_prenom=$_POST['nouveau_prenom'];
        $update_prenom=$conn->prepare("UPDATE professeur SET prenom_prof='$nouveau_prenom' WHERE id_prof='$id_prof'");
        $update_prenom->execute();
        echo "votre nouveau prenom est ",$nouveau_prenom;
    }
   
    
?>


