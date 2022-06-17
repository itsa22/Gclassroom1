<?php 
    include("fonction.php");  
    $id_recup=$_GET["id_cours"];
    echo $id_recup;
    $delete=$conn->prepare("DELETE  FROM cours WHERE id_cours='$id_recup'");
    $delete->execute();
    header("location:create_cours.php");
    

?>