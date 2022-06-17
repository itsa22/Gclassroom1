<?php
    session_start();

    $id_admin=$_SESSION['id_admin'];
    if(!isset($id_admin)){
        header("location: index.php");
        #echo "cannot login";
    }
    
?>

<?php
    include('fonction.php');
    if(isset($_FILES["my_image"])){
        $name=$_FILES['my_image']["name"];
        $type=$_FILES['my_image']["type"];
        $tmp_name=$_FILES['my_image']["tmp_name"];
        $error=$_FILES['my_image']["error"];
        $size=$_FILES['my_image']["size"];
        #echo "<pre>";
        #print_r($_FILES['my_image']);
        #echo"</pre>";
        if($error===0){
            if($size>125000){
                $em="image depasse 125000";
                header("location: create_etu.php?error=$em"); 
            }else{
                $img_ex= pathinfo($name, PATHINFO_EXTENSION);
                $img_ex_lc=strtolower($img_ex);
                $allowed_exs=array("jpg", "jpeg", "png");
                if(in_array($img_ex_lc, $allowed_exs)){
                    $new_img_name=uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path='your_image/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    #$req_insert_img =$conn->prepare('INSERT INTO etudiant(image_url) VALUE ("'.$new_img_name.'")');
                    #$req_insert_img->execute();
                    #$req_insert_img->fetch();
                    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['tel']) && !empty($_POST["email"]) && !empty($_POST["mdp1"]) && !empty($_POST["mdp2"]))  {
                        if($_POST["mdp1"]==$_POST["mdp2"]){
                            $nom = $_POST['nom'] ;
                            $prenom = $_POST['prenom'] ;
                            $tel = $_POST['tel'] ;
                            $email = $_POST['email'] ;
                            $mdp1 = $_POST['mdp1'] ;
                            
                            $req_recup_prof=$conn->prepare("SELECT COUNT(id_prof) AS nombre  FROM professeur WHERE email='$email' ");
                            $req_recup_prof->execute();
                            $data_prof=$req_recup_prof->fetch();
                            
                            if($data_prof['nombre']==1){
                                echo "Ce compte existe déja";
                            }
                            else{
                                $req_insert = $conn->prepare('INSERT INTO professeur (id_prof, nom_prof, prenom_prof, tel, email, mot_de_passe, image_url) VALUES 
                                (NULL, :nom_prof,:prenom_prof,:tel,:email,:mdp,:photo)');
                
                                 // on envoie la requête
                                $req_insert->execute(array(
                                "nom_prof"=>$nom,
                                "prenom_prof"=>$prenom,
                                "tel"=>$tel,
                                "email"=>$email,
                                "mdp"=>$mdp1,
                                "photo"=>$new_img_name
                                )); 
                                #echo "<h1 style='color: green'>un compte a été crée</h1>";
                                #$em="compte créer";
                                #header("location: create_etu.php?error=$em"); 
                                echo "<h1 style='color: green'>un compte a été crée</h1><br><a href='liste_prof.php'>voir la liste des professeurs</a>";

                                
                            }
                            
                
                        }
                        else{
                            echo "<h1 style='color: red'>veuillez bien confirmer votre mot de passe</h1>";
                        }
                        
                    }
                    else{
                        echo "<h1 style='color: red'>veuillez remplir toutes les formulaires</h1>";
                    }

                    
                }else{
                    echo "format image incompatible"; 
                }
            }
        }else{
            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['tel']) && !empty($_POST["email"]) && !empty($_POST["mdp1"]) && !empty($_POST["mdp2"]))  {
                if($_POST["mdp1"]==$_POST["mdp2"]){
                    $nom = $_POST['nom'] ;
                    $prenom = $_POST['prenom'] ;
                    $tel = $_POST['tel'] ;
                    $email = $_POST['email'] ;
                    $mdp1 = $_POST['mdp1'] ;
                    
                    $req_recup_prof=$conn->prepare("SELECT COUNT(id_prof) AS nombre  FROM professeur WHERE email='$email' ");
                    $req_recup_prof->execute();
                    $data_prof=$req_recup_prof->fetch();
                    
                    if($data_prof['nombre']==1){
                        echo "Ce compte existe déja";
                    }
                    else{
                        $req_insert = $conn->prepare('INSERT INTO professeur (id_prof, nom_prof, prenom_prof, tel, email, mot_de_passe) VALUES 
                        (NULL, :nom_prof,:prenom_prof,:tel,:email,:mdp,)');
        
                         // on envoie la requête
                        $req_insert->execute(array(
                        "nom_prof"=>$nom,
                        "prenom_prof"=>$prenom,
                        "tel"=>$tel,
                        "email"=>$email,
                        "mdp"=>$mdp1
                        
                        )); 
                        #echo "<h1 style='color: green'>un compte a été crée</h1>";
                        #$em="compte créer";
                        #header("location: create_etu.php?error=$em"); 
                        echo "<h1 style='color: green'>un compte a été crée</h1><br><a href='liste_prof.php'>voir la liste des professeurs</a>";
                        
                    }
                    
        
                }
                else{
                    echo "<h1 style='color: red'>veuillez bien confirmer votre mot de passe</h1>";
                }
                
            }
            else{
                echo "<h1 style='color: red'>veuillez remplir toutes les formulaires</h1>";
            }
        }
        
    }
    
    else{
        echo "veuillez remplir les informations";
    }


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.js">
    <link rel="stylesheet" href="etu.css">
    <title>Document</title>
</head>
<body>
    <center>
        <h1 style="color:white">Inscription Prof</h1>
        <h3 style="color:white">Choisir une photo de profile</h3>        
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="my_image"><br>
            
            
            <div class="form-group" style="width:900px">
                <input type="text" name="nom" placeholder="Nom" class="form-control">
            </div>
            <div class="form-group" style="width:900px">    
                <input type="text" name="prenom" placeholder="Prenom" class="form-control">
            </div>
            <div class="form-group" style="width:900px">   
                <input type="number" name="tel" placeholder="Tel" class="form-control">
            </div>
            <div class="form-group" style="width:900px">    
                <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
            <div class="form-group" style="width:900px">
                <input type="password" name="mdp1" placeholder="Mot de passe" class="form-control">
            </div>
            <div class="form-group" style="width:900px">
                <input type="password" name="mdp2" placeholder="Confirmer votre mot de passe" class="form-control">
            </div>
            <input type="submit" value="Enregistrer" class="btn btn-warning" style="background-color:red"><br>
        </form>
    </center>
</body>
</html>

