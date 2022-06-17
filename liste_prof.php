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
    <link rel="stylesheet" href="CSS/liste.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
            <center><h1>Liste des enseignants</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>tel</th>
                            <th>email</th>
                            <th>photo</th>
                            <th>supprimer</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                                include("fonction.php");
                                $recup_liste=$conn->prepare("SELECT id_prof, nom_prof, prenom_prof, tel, email FROM professeur");
                                $recup_liste->execute();
                                while($data_prof = $recup_liste->fetch()){
                                    $id=$data_prof['id_prof'];
                                    $nom=$data_prof['nom_prof'];
                                    $prenom=$data_prof['prenom_prof'];
                                    $tel=$data_prof['tel'];
                                    $email=$data_prof['email'];
                                
                            ?>
                            
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $nom ?></td>
                                <td><?php echo $prenom ?></td>
                                <td><?php echo $tel ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php 
                                    include("fonction.php");
                                    $req_recup=$conn->prepare("SELECT id_prof,image_url FROM professeur WHERE id_prof='$id'");
                                    $req_recup->execute();
                                    while($professeur = $req_recup->fetch()){?>
                                    <div class='alb'> 
                                        <img src="your_image/<?=$professeur['image_url']?>" alt="">
                                    </div>
                            
                                <?php } ?></td>
                                <td><form action="delete_prof.php?id=<?php echo $id; ?>" method="post">
                                    <input type="submit" name="supprimer" value="supprimer" class="btn btn-danger">
                                </form></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <h2><a href="page_admin.php" class="btn btn-default">Acceuil</a></h2>
            </center>
        </div>
    </div>
    
</body>
</html>

<style>
    .alb{
        width:200px;
        height:200px;
        padding:5px;
    }
    .alb img{
        width:50%;
        height:50%
    }
</style>
