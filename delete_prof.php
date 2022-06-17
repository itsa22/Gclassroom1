<?php 
    include("fonction.php");  
    $id_recup=$_GET["id"];
    echo $id_recup;
    $delete=$conn->prepare("DELETE  FROM professeur WHERE id_prof='$id_recup'");
    $delete->execute();
    header("location:liste_prof.php");
    

?>