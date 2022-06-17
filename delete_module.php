<?php 
    include("fonction.php");  
    $id_recup=$_GET["id"];
    echo $id_recup;
    $delete=$conn->prepare("DELETE  FROM module WHERE id_module='$id_recup'");
    $delete->execute();
    header("location:liste_module.php");
    

?>