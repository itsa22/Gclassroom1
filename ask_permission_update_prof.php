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
    <link rel="stylesheet" href="CSS/ask.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
                <h1>Pour modifier, entrer votre mot de passe</h1>
            <?php
            include("fonction.php");
            if(!empty($_POST['mdp'])){
                $mdp=$_POST['mdp'];
                $req_mdp=$conn->prepare("SELECT mot_de_passe FROM professeur WHERE id_prof='$id_prof'");
                $req_mdp->execute();
                $data_mdp=$req_mdp->fetch();
                if($data_mdp['mot_de_passe']==$mdp){
                    header("location:update_profil_prof.php");
                }else{
                    echo "mot de passe incorrecte";
                }
            }else{
                echo "entrer votre mot de passe";
            }
            
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <input type="password" name="mdp" placeholder="Tapez votre mot de passe" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Continuer" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
