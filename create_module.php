<?php
    session_start();

    $id_admin=$_SESSION['id_admin'];
    if(!isset($id_admin)){
        header("location: index.php");
        #echo "cannot login";
    }
    
?>
<?php
    include("liste_module.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <h1 style="color:white">Ajouter une module</h1>
    <table border=2>
        <thead>
            <tr>
                <th>id_module</th>
                <th>nom_module</th>
                <th>id_prof</th>
            </tr>
        </thead>
    
    <tbody>
        <tr>
        <form action="" method="post">
            <th><input type="number" name="id_module"></th>
            <th><input type="text" name="nom_module"></th>
            <th>
            <select name="id_prof" id=""> 
            <?php
                include("fonction.php");
                $recup_id_prof=$conn->prepare("SELECT id_prof FROM professeur");
                $recup_id_prof->execute();
                while($data= $recup_id_prof->fetch()){
                    $id_prof=$data['id_prof'];
                    ?>
                    <option value=" <?php echo $id_prof; ?>"><?php echo $id_prof; ?></option>
                    <?php
                }
            ?>
            </select>
            </th>
            <th><input type="submit" name="submit" value="ajouter"></th>
            </form>
        </tr>
        </table>
    </tbody>


<div style='float: right; position: relative; top: 100%;'><p>Consultez cette table <br> pour choisir *id_prof* <br> dans module </p>
    <table border=1 >
            <thead>
                
                <tr>
                    <th>id_prof</th>
                    <th>Enseignant</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    include("fonction.php");
                    $req_recup=$conn->prepare("SELECT id_prof, nom_prof, prenom_prof FROM professeur");
                    $req_recup->execute();
                    while($data_prof= $req_recup->fetch()){
                        $id=$data_prof['id_prof'];
                        $nom_prof=$data_prof['nom_prof'];
                        $prenom_prof=$data_prof['prenom_prof'];
                ?>
                <tr>
                    <th><?php echo $id ?></th>
                    <th><?php echo $nom_prof,' ', $prenom_prof ?></th>
                </tr>
            </tbody>
            <?php } ?>
    </table>
</div>

<?php
    include("fonction.php");
    
    if(!empty($_POST['id_module']) && !empty($_POST['nom_module'])){
        $id_module=$_POST['id_module'];
        $req_id_module=$conn->prepare("SELECT count(id_module) AS nombre FROM module WHERE id_module='$id_module'");
        $req_id_module->execute();
        $data_module= $req_id_module->fetch();
        $nombre_module=$data_module['nombre'];
        if($nombre_module > 0){
            echo "ce module existe déja";
        }else{
            $nom_module=$_POST['nom_module'];
            $id_prof=$_POST['id_prof'];
            $req_module=$conn->prepare("INSERT INTO module(id_module, nom_module, id_prof) VALUES (:id_module, :nom_module, :id_prof)");
            $req_module->execute(array(
            "id_module"=>$id_module,
            "nom_module"=>$nom_module,
            "id_prof"=>$id_prof
        
        ));header("location: create_module.php");
        }
        
        
        
    }else{
        echo "Veuillez remplir les informations";
    }
?>
<br><h2><a href="page_admin.php">Acceuil</a></h2></center>
</body>
</html>