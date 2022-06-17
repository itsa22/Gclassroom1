<?php
    session_start();
    include("fonction.php");
    
   
    $email = $_POST['email'] ;
    $mdp1 = $_POST['mdp'] ;
    $req_recup_etu=$conn->prepare("SELECT COUNT(id_etudiant) AS nombre  FROM etudiant WHERE email='$email' AND mot_de_passe='$mdp1' ");
    $req_recup_etu->execute();
    $data_etu=$req_recup_etu->fetch();
    if($data_etu['nombre']==1){
        echo "succes";
    }else{
        echo "failed ";
    }

?>