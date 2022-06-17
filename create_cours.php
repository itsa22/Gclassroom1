<?php
    include("liste_cours_prof.php");
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
    <link rel="stylesheet" href="CSS/create_cours.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
        <center><h2 style="color:white">Créer un cours</h2>
    <table class="table">
    <thead>
        <tr>
            <th>votre module</th>
        
            <th>votre message</th>
            <th>fichier</th>
        </tr>
    </thead>

    <?php
        include("fonction.php");
        $req_module=$conn->prepare("SELECT id_module, nom_module FROM module WHERE id_prof='$id_prof'");
        $req_module->execute();
        while($data_module=$req_module->fetch()){
            $id_module=$data_module['id_module'];
            $nom_module=$data_module['nom_module'];
    ?>

    <tbody>
        <tr>
            <th><?php echo $nom_module,' INFO ',$id_module ?></th>
            <form action="php_create_cours.php?id_mod=<?php echo $id_module; ?>" method="post" enctype="multipart/form-data">
                <th><input type="text" name="message" placeholder="Inserer votre message"></th>
                <th><input type="file" name="fichier"></th>

                <th><input type="submit" name="submit" value="ajouter"></th>
            </form>
            
        </tr>
    </tbody>
    <?php } ?>
</table>

    
   <h2><a href="page_prof.php" style="color:white">Acceuil</a></h2>
   <h2><a href="create_cours.php">Actualiser</a></h2>
        </center>
        </div>
    </div>
   
</body>
</html>


