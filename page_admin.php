<?php
    session_start();

    $id_admin=$_SESSION['id_admin'];
    if(!isset($id_admin)){
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
    <link rel="stylesheet" href="CSS/page_admin.css">
    <link rel="stylesheet" href="fontawesome.min.css">
    <link rel="stylesheet" href="fontawesome.min.js">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
                
            <?php
            
            include("fonction.php");
            
            $recup_liste=$conn->prepare("SELECT nom_admin, prenom_admin,email, image_url FROM administrateur WHERE id_admin='$id_admin'");
            $recup_liste->execute();
            $data_admin=$recup_liste->fetch();
            $nom_admin=$data_admin['nom_admin'];
            $image=$data_admin['image_url'];
            $prenom_admin=$data_admin['prenom_admin'];
            $email=$data_admin['email'];
            ?>
            <div class="head">
                <img class="sary" src="your_image/<?=$image?>" alt="" style="height:200px;width:200px;">
                <h1 style='color:white'>Administrateur</h1>
                <h2 style='color:white'>connecté(e) en tant que *<?php echo $email ?>* </h2>
                <h1 style='color:white'><?php echo $nom_admin,' ',$prenom_admin; ?></h1><br>
            </div>
            <div class="inter">
                <div class="form-group">
                    <a href="create_etu.php" style='text-decoration:none' class="form-control">Ajouter un étudiant</a>
                </div>
                <div class="form-group">
                    <a href="create_prof.php" style='text-decoration:none' class="form-control">Ajouter un professeur</a>
                </div>
                <div class="form-group">
                    <a href="liste_etudiant.php" style='text-decoration:none' class="form-control">Listes des étudiants</a>
                </div>
                <div class="form-group">
                    <a href="liste_prof.php" style='text-decoration:none' class="form-control">Listes des professeurs </a>
                </div>
                <div class="form-group">
                    <a href="edt_admin.php" style='text-decoration:none' class="form-control">Emploi du temps</a>
                </div>
                <div class="form-group">
                    <a href="create_module.php" style='text-decoration:none' class="form-control">Module</a>
                </div>
            </div>
            <div>
                <a href="logout.php" class="btn btn-info out">Se déconnecté(e)</a>
            </div>
        </div>
    </div>
    
    
    

</body>
</html>