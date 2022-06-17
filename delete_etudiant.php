<?php 
    include("fonction.php");  
    $id_recup=$_GET["id"];
    echo $id_recup;
    $delete=$conn->prepare("DELETE  FROM etudiant WHERE id_etu='$id_recup'");
    $delete->execute();
    header("location:liste_etudiant.php");
    

?>