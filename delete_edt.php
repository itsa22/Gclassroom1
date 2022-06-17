<?php 
    include("fonction.php");  
    $id_recup=$_GET["id_edt"];
    echo $id_recup;
    $delete=$conn->prepare("DELETE  FROM emploi_du_temps WHERE id_edt='$id_recup'");
    $delete->execute();
    header("location:liste_etudiant.php");
    

?>