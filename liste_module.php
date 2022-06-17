<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS/edt_admin.css">
    <title>liste module</title>
</head>
<body>
    <div class="container">
        <div class="mb-3">
        <center><h1 style='color:white'>Listes des modules</h1>
    <table border=2>
        <thead>
            <tr>
                <th>nom_module</th>
                <th>Enseignant</th>
                <th>email de l'enseignant</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                include("fonction.php");
                
                $recup_liste=$conn->prepare("SELECT id_module, nom_module, id_prof FROM module");
                $recup_liste->execute();
                
                while($data_module = $recup_liste->fetch()){
                    $id_module=$data_module['id_module'];
                    $nom_module=$data_module['nom_module'];
                    $id_prof=$data_module['id_prof'];
                    $recup_nom_prof=$conn->prepare("SELECT nom_prof FROM professeur WHERE id_prof='$id_prof'");
                    $recup_nom_prof->execute();
                    while($data_nom_f= $recup_nom_prof->fetch()){
                        $nom_prof= $data_nom_f['nom_prof'];

                        $recup_prenom_prof=$conn->prepare("SELECT prenom_prof FROM professeur WHERE id_prof='$id_prof'");
                        $recup_prenom_prof->execute();
                        while($data_prenom_prof= $recup_prenom_prof->fetch()){
                            $prenom_prof=$data_prenom_prof['prenom_prof'];

                            $recup_email_prof=$conn->prepare("SELECT email FROM professeur WHERE id_prof='$id_prof'");
                            $recup_email_prof->execute();
                            while($data_email=$recup_email_prof->fetch()){
                                $email=$data_email['email'];

            ?>
            
            <tr>
                
                <td><?php echo $nom_module,' INFO-',$id_module  ?></td>
                <td><?php echo $nom_prof,' ',$prenom_prof ?></td>
                <td><?php echo $email ?></td>
                
                <td><form action="delete_module.php?id=<?php echo $id_module; ?>" method="post">
                    <input type="submit" name="supprimer" value="supprimer" class="btn btn-danger">
                </form></td>
            </tr>
            <?php } } } }?>
        </tbody>
    </table>
    
    </center>
        </div>
    </div>
    
</body>
</html>
