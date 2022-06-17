<?php
    include("fonction.php");
    $id_module=$_GET["id_mod"];
    if(!empty($_POST['message']) && isset($_FILES["fichier"])){
        $message=$_POST['message'];
        $name=$_FILES['fichier']["name"];
        $type=$_FILES['fichier']["type"];
        $tmp_name=$_FILES['fichier']["tmp_name"];
        $error=$_FILES['fichier']["error"];
        $size=$_FILES['fichier']["size"];
        #echo "<pre>";
        #print_r($_FILES['my_image']);
        #echo"</pre>";
        if($error===0){
            
            $file_ex= pathinfo($name, PATHINFO_EXTENSION);
            $file_ex_lc=strtolower($file_ex);
            #$allowed_exs=array("jpg", "jpeg", "png", "pdf", "mp4", "mp3", "exe", "docx", "txt");
            if(isset($file_ex_lc)){
                $new_file_name=uniqid("FILE-", true).'.'.$file_ex_lc;
                $file_upload_path='your_file/'.$new_file_name;
                move_uploaded_file($tmp_name, $file_upload_path);
                $insert_file=$conn->prepare("INSERT INTO cours(id_cours, id_module, fichier, message_prof) VALUES (NULL, :id_module, :fichier, :message_prof)");
                $insert_file->execute(array(
                    'message_prof'=>$message,
                    'id_module'=>$id_module,
                    'fichier'=>$new_file_name
                ));
                header("location: create_cours.php");
            }else{
                echo "Erreur de fichier";
            }
        }else if(!empty($_POST['message'])){
            $message=$_POST['message'];
            
            $insert_message=$conn->prepare("INSERT INTO cours(id_cours, message_prof, id_module) VALUES (NULL,:message_prof, :id_module)");
            $insert_message->execute(array(
                'message_prof'=>$message,
                'id_module'=>$id_module
            ));
            header("location: create_cours.php");
        }  
    }else if(isset($_FILES["fichier"])){
        $name=$_FILES['fichier']["name"];
        $type=$_FILES['fichier']["type"];
        $tmp_name=$_FILES['fichier']["tmp_name"];
        $error=$_FILES['fichier']["error"];
        $size=$_FILES['fichier']["size"];
        #echo "<pre>";
        #print_r($_FILES['my_image']);
        #echo"</pre>";
        if($error===0){
            
            $file_ex= pathinfo($name, PATHINFO_EXTENSION);
            $file_ex_lc=strtolower($file_ex);
            #$allowed_exs=array("jpg", "jpeg", "png", "pdf", "mp4", "mp3", "exe", "docx", "txt");
            if(isset($file_ex_lc)){
                $new_file_name=uniqid("FILE-", true).'.'.$file_ex_lc;
                $file_upload_path='your_file/'.$new_file_name;
                move_uploaded_file($tmp_name, $file_upload_path);
                $insert_file=$conn->prepare("INSERT INTO cours(id_cours, id_module, fichier) VALUES (NULL, :id_module, :fichier)");
                $insert_file->execute(array(
                    
                    'id_module'=>$id_module,
                    'fichier'=>$new_file_name
                ));
                header("location: create_cours.php");
            }else{
                echo "Erreur de fichier";
            }
        }else{
            echo "erreur insertion";
        }    
        
    }else{
        #header("location: create_cours.php");
        echo "inserrer un message ou un fichier";
    }

?>