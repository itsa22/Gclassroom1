<?php
    session_start();
    include("fonction.php");
    if(isset($_SESSION['id_admin'])){
        header("location: page_admin.php");
    }else if(isset($_SESSION['id_prof'])){
        header("location: page_prof.php");
    }else if(isset($_SESSION['id_etu'])){
        header("location: page_etu.php");
    }else{

        if (!empty($_POST['email'])&& !empty($_POST['mdp'])){
            $email = $_POST['email'] ;
            $mdp1 = $_POST['mdp'] ;
            $req_recup_prof=$conn->prepare("SELECT id_prof, COUNT(id_prof) AS nombre  FROM professeur WHERE email='$email' AND mot_de_passe='$mdp1' ");  
            $req_recup_etu=$conn->prepare("SELECT id_etu, COUNT(id_etu) AS nombre  FROM etudiant WHERE email='$email' AND mot_de_passe='$mdp1' ");
            $req_recup_admin=$conn->prepare("SELECT id_admin, COUNT(id_admin) AS nombre  FROM administrateur WHERE email='$email' AND mot_de_passe='$mdp1' ");
            $req_recup_prof->execute();
            $req_recup_etu->execute();
            $req_recup_admin->execute();
            $data_prof=$req_recup_prof->fetch();
            $data_etu=$req_recup_etu->fetch();
            $data_admin=$req_recup_admin->fetch();
            $nombre_prof=$data_prof['nombre'];
            $nombre_etu=$data_etu['nombre'];
            $nombre_admin=$data_admin['nombre'];
            if($nombre_prof==1){
                $id_prof=$data_prof['id_prof'];
                $recup_id=$conn->prepare("SELECT id_prof FROM professeur WHERE id_prof='$id_prof'");
                $recup_id->execute();
                $data_recup=$recup_id->fetch();
                $_SESSION['id_prof']=$data_recup['id_prof'];

                header("location:page_prof.php");
            }
            else if($nombre_etu==1){   

                $id_etu=$data_etu['id_etu'];
                $recup_id=$conn->prepare("SELECT id_etu FROM etudiant WHERE id_etu='$id_etu'");
                $recup_id->execute();
                $data_recup=$recup_id->fetch();
                $_SESSION['id_etu']=$data_recup['id_etu'];
                
                header("location:page_etu.php");
    
            }
            else if($nombre_admin==1){   
                $id_admin=$data_admin['id_admin'];
                $recup_id=$conn->prepare("SELECT id_admin FROM administrateur WHERE id_admin='$id_admin'");
                $recup_id->execute();
                $data_recup=$recup_id->fetch();
                $_SESSION['id_admin']=$data_recup['id_admin'];

                header("location:page_admin.php");
            }
            else{
                header("location:index.php");
            }
    
        }
        else{
            header("location:index.php");
        }

    }
    
    

?>


