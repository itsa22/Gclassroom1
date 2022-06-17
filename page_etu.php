<?php
    session_start();

    $id_etu=$_SESSION['id_etu'];
    if(!isset($id_etu)){
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
    <link rel="stylesheet" href="CSS/page_etu.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
            <?php
            
            include("fonction.php");
            
            $recup_liste=$conn->prepare("SELECT nom_etu, prenom_etu,email, image_url FROM etudiant WHERE id_etu='$id_etu'");
            $recup_liste->execute();
            $data_etu=$recup_liste->fetch();
            $nom_etu=$data_etu['nom_etu'];
            $image=$data_etu['image_url'];
            $prenom_etu=$data_etu['prenom_etu'];
            $email=$data_etu['email'];
            ?>
            <div style='color:white;text-align:end;font-size:20px'>Connecté(e) en tant que <?php echo $email ?></div>
            <div class="image">
                <img src='your_image/<?=$image?>' style='height:200px;width:200px;'>
            </div>
            
            <h1 style='color:white'>Etudiant</h1>
            <div class="form">
                <h3 style='color:gray'><?php echo $nom_etu,' ',$prenom_etu; ?></h1><br></h3>
                <div class="form-group">
                    <a href="ask_permission_update_etu.php" style='text-decoration: none' class="form-control"> Modifier le profil </a>
                </div>
                <div class="form-group">
                    <a style='text-decoration: none' href="emploi_du_temps.php" class="form-control">Emploi du temps</a>
                </div>
                <div class="form-group">
                    <a style='text-decoration: none' href="liste_cours_etu.php" class="form-control">Cours</a>
                </div>
                <div>
                    <a style='text-decoration: none' href="logout.php" class="btn btn-info">Se déconnecté(e)</a>
                </div>
            </div>
        </div>
    </div>
        
    
</body>
</html>