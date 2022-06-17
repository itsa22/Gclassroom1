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
    <link rel="stylesheet" href="com.css">
    <title>Document</title>
</head>
<body>
    <a href="page_etu.php" class="btn btn-secondary btn-lg" role="button" aria-pressed="true" style="background-color:#545212;font-size:30px">Acceuil</a>
    <a href="liste_cours_prof.php" class="btn btn-secondary btn-lg" role="button" aria-pressed="true" style="background-color:#545212;font-size:30px">Retour</a>

    <table border=1 class="style">
        <thead>
            <tr>
                <th>Module</th>
                <th>Fichier</th>
                <th>Message de l'enseignant</th>
            </tr>
        </thead>
        <?php 
            include("fonction.php");  
            $id_cours=$_GET['id_cours'];
            #echo $id_cours;
            $req=$conn->prepare("SELECT id_cours, id_module, fichier, message_prof FROM cours WHERE id_cours='$id_cours'");
            $req->execute();
            while($data=$req->fetch()){
            $id_cours=$data['id_cours'];
            $id_module=$data['id_module'];
            $fichier=$data['fichier'];
            $message_prof=$data['message_prof'];
            $recup_module=$conn->prepare("SELECT nom_module FROM module WHERE id_module='$id_module'");
            $recup_module->execute();
                while($data_module=$recup_module->fetch()){
                    $nom_module=$data_module['nom_module'];


            

        ?>

        <tbody>
            <tr>
                <th><?php echo $nom_module,' INFO-',$id_module ?></th>
                <th><?php 
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
            </tr>
        </tbody>
        <?php } } ?>
    </table>
    <h1>Les commentaires:</h1>
    <?php
        include("fonction.php");
        $recup=$conn->prepare("SELECT nom_prof, email, prenom_prof from professeur WHERE id_prof='$id_prof'");
        $recup->execute();
        $data_recup=$recup->fetch();
        $nom_prof=$data_recup['nom_prof'];
        $prenom_prof=$data_recup['prenom_prof'];
        $email=$data_recup['email'];
        if(!empty($_POST['commentaire'])){
            $commentaire=$_POST['commentaire'];
            $insert_comm=$conn->prepare("INSERT INTO commenter(id_com, id_cours, email, nom_com, prenom_com, commentaire) VALUE (NULL, :id_cours, :email, :nom_com, :prenom_com, :commentaire)");
            $insert_comm->execute(array(
                "id_cours"=>$id_cours,
                "email"=>$email,
                "nom_com"=>$nom_prof,
                "prenom_com"=>$prenom_prof,
                "commentaire"=>$commentaire
                
            ));
            #echo "<p style='color:green'>$nom_etu $prenom_etu</p><p>$commentaire</p>";
            
        }
    ?>

    
    <?php
        include("fonction.php");
        $req_select_com=$conn->prepare("SELECT nom_com, prenom_com, commentaire, date_com FROM commenter WHERE id_cours='$id_cours'");
        $req_select_com->execute();
        
        while($data_com=$req_select_com->fetch()){
        $nom_com=$data_com['nom_com'];
        $prenom_com=$data_com['prenom_com'];
        $coms=$data_com['commentaire'];
        $date_com=$data_com['date_com'];
    
    ?>
    <div style='border: 1px solid' class="com">
        <h2 style='color:green'><?php echo $nom_com,' ',$prenom_com ?></h2> <p><?php echo $date_com ?></p>
        <p><?php echo $coms ?></p>
    </div>
    <?php } ?>
    <br><br><br>
    <form action="" method="post">
        <input type="text" name="commentaire" placeholder="Votre commentaire">
        <input type="submit" name="submit" value="Commenter" class="btn btn-primary btn-lg">
    </form>
    
</body>
</html>