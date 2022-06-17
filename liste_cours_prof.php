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
    <link rel="stylesheet" href="CSS/create_cours.css">
    <title>liste module</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
        <center>
    <h1 style="color:white">Voici vos cours</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Module</th>
                <th>fichier</th>
                <th>message de l'enseignant</th>
            </tr>
        </thead>

        <tbody>
        
        <?php
            include("fonction.php");
            

                $recup_module=$conn->prepare("SELECT nom_module,id_module FROM module WHERE id_prof='$id_prof'");
                $recup_module->execute();
                while($data_module=$recup_module->fetch()){
                    $nom_module=$data_module['nom_module'];
                    $id_module=$data_module['id_module'];


                    $recup_liste=$conn->prepare("SELECT id_cours, id_module,fichier, message_prof FROM cours WHERE id_module='$id_module'");
                    $recup_liste->execute();
                    while($data_recup=$recup_liste->fetch()){
                        $id_cours=$data_recup['id_cours'];
                        
                        $fichier=$data_recup['fichier'];
                        $message_prof=$data_recup['message_prof'];
                        
        ?>
            <tr>
                <th><?php echo $nom_module,' INFO-',$id_module ?></th>
                <th>
                    <?php 
                        if(isset($fichier)){
                            echo "<form action='download.php?file=$fichier' method='post'>
                            <input type='submit' name='submit' value='télécharger le fichier'>
                        </form>";
                        }else{
                            echo " Pas de fichier  ";
                        }
                    ?>
                </th>
                <th><?php echo $message_prof ?></th>
                <th><form action="commentaire_prof.php?id_cours=<?php echo $id_cours ?>" method="post">
                    <input type="submit" name="commenter" value="voir les commentaires">
                </form></th>
                <th>
                    <form action="delete_cours.php?id_cours=<?php echo $id_cours ?>" method="post">
                        <input type="submit" name="submit" value="supprimer">    
                    </form>
                </th>
            </tr>    
            <?php } } ?>
        </tbody>
    </table>
    <br><br><br></center>
        </div>
    </div>
    
</body>
</html>