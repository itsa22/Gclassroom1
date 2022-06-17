<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.js">
    <link rel="stylesheet" href="edt.css">
    <title>Document</title>
</head>
<body>
    <center>
    <div class="titre">
        Emploi du temps
    </div>
    <table border=2 class="style">
            <thead>
                <tr>
                    
                    <th>Module</th>
                    <th>Enseignant</th>
                    <th>Salle</th>
                    <th>Date</th>
                    <th>Horaire</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    include("fonction.php");
                    $recup_liste=$conn->prepare("SELECT id_edt, id_module, salle, Date_edt, Horaire FROM emploi_du_temps");
                    $recup_liste->execute();
                    while($data_edt = $recup_liste->fetch()){
                        $id_edt=$data_edt['id_edt'];
                        $id_module=$data_edt['id_module'];
                        $salle=$data_edt['salle'];
                        $Date_edt=$data_edt['Date_edt'];
                        $Horaire=$data_edt['Horaire'];
                        $recup_nom_module=$conn->prepare("SELECT nom_module FROM module WHERE id_module='$id_module'");
                        $recup_nom_module->execute();
                        while($data_nom_module = $recup_nom_module->fetch()){
                            $nom_module=$data_nom_module['nom_module'];

                            $recup_id=$conn->prepare("SELECT id_prof FROM module WHERE id_module='$id_module'");
                            $recup_id->execute();
                            while($data_id_prof = $recup_id->fetch()){
                                $id_prof=$data_id_prof['id_prof'];

                                $recup_nom_prof=$conn->prepare("SELECT nom_prof FROM professeur WHERE id_prof='$id_prof'");
                                $recup_nom_prof->execute();
                                while($data_nom_prof = $recup_nom_prof->fetch()){
                                    $nom_prof=$data_nom_prof['nom_prof'];

                                    $recup_prenom_prof=$conn->prepare("SELECT prenom_prof FROM professeur WHERE id_prof='$id_prof'");
                                    $recup_prenom_prof->execute();
                                    while($data_prenom_prof = $recup_prenom_prof->fetch()){
                                    $prenom_prof=$data_prenom_prof['prenom_prof'];
                        
                ?>
                
                <tr>
                    
                    <th><?php echo $nom_module,' INFO-',$id_module ?></th>
                    
                    
                    <th><?php echo $nom_prof,' ',$prenom_prof ?>   </th>
                    <td><?php echo $salle ?></td>
                    <td><?php echo $Date_edt ?></td>
                    <td><?php echo $Horaire ?></td>
                
                </tr>
                <?php } } } } }?>
            </tbody>
        </table>
    </center>
    <a href="page_prof.php" class="btn btn-secondary btn-lg" role="button" aria-pressed="true" style="background-color:#545212;font-size:30px">Retour</a>
    <!-- <a href="page_prof.php" class="btn btn-success" style="background-color:blue;font-size:40px;margin-left:550px">Acceuil</a> -->
    
    
</body>
</html>

<style>
    .alb{
        width:200px;
        height:200px;
        padding:5px;
    }
    .alb img{
        width:100%;
        height:100%
    }
</style>
