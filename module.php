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
        
        ));header("location: liste_module.php");
        }
        
        
        
    }else{
        echo "veuillez remplir les informations";
    }
?>