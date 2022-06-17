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
    <link rel="stylesheet" href="CSS/page_etu.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
            <?php
            
            include("fonction.php");
            
            $recup_liste=$conn->prepare("SELECT nom_prof, prenom_prof,email, image_url FROM professeur WHERE id_prof='$id_prof'");
            $recup_liste->execute();
            $data_prof=$recup_liste->fetch();
            $nom_prof=$data_prof['nom_prof'];
            $image=$data_prof['image_url'];
            $prenom_prof=$data_prof['prenom_prof'];
            $email=$data_prof['email'];
            ?>
            <div style="color:white;font-size:20px;text-align:end">Connecté(e) en tant que <?php echo $email ?></div>
            <img src="your_image/<?=$image?>" alt="" style="height:200px;width:200px;">
            <h1 style='color:white'>Professeur</h1>
            <div class="form">
                <h3 style='color:gray'><?php echo $nom_prof,' ',$prenom_prof; ?></h3>
                <div class="form-group">
                    <a href="ask_permission_update_prof.php" style='text-decoration: none' class="form-control"> Modifier le profil </a>
                </div>
                <div class="form-group">
                    <a style='text-decoration: none' href="emploi_du_temps.php" class="form-control">Emploi du temps</a>
                </div>
                <div class="form-group">
                    <a style='text-decoration: none' href="create_cours.php" class="form-control">Cours</a>
                </div>
                <div>
                    <a style='text-decoration: none' href="logout.php" class="btn btn-info">Se déconnecté(e)</a>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>


