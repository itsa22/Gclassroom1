
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS/edt_admin.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="mb-3">
            <center>
            <h1 style='color:white'>Ajouter un emploi du temps</h1>
            <table class="table">
            <thead>
            <tr>
                <th>id_module</th>
                <th>Salle</th>
                <th>Date</th>
                <th>Horaire</th>
                
            </tr>
            </thead>

            <?php
            include("fonction.php");
            if(!empty($_POST['salle']) && !empty($_POST['date_edt']) && !empty($_POST['dheure']) && !empty($_POST['dmin'])){
            $salle=$_POST['salle'];
            $date_edt=$_POST['date_edt'];
            $dheure=$_POST['dheure'];
            $dmin=$_POST['dmin'];
            $fheure=$_POST['fheure'];
            $fmin=$_POST['fmin'];
            $id=$_POST['id_module'];
            $horaire="De ".$_POST['dheure'].":" .$_POST['dmin']." à ".$_POST['fheure'].":" .$_POST['fmin'];


            $inscri_horaire = $conn->prepare('INSERT INTO emploi_du_temps(id_module, salle, Date_edt, horaire) VALUES (:id_module, :salle, :date_edt, :horaire)');        
            // on envoie la requête
            $inscri_horaire->execute(array(
                "id_module"=>$id,
                "salle"=>$salle,
                "date_edt"=>$date_edt,
                "horaire"=>$horaire

                ));
            
                    header("location: edt_admin.php");
                }else{
                    echo "veuillez remplir toutes les forumulaires";
                }
                ?>


                <tbody>
                <tr>
                <form action="" method="post">
                    <th><select name="id_module" id="">
                        <?php
                            include("fonction.php");
                            $recup_id_module=$conn->prepare("SELECT id_module FROM module");
                            $recup_id_module->execute();
                            while($data= $recup_id_module->fetch()){
                                $id=$data['id_module'];
                                ?>
                                <option value=" <?php echo $id; ?>"><?php echo $id; ?></option>
                                <?php
                            }
                        ?>
                    </select></th>
                    <th><input type="number" name="salle"></th>
                    <th><input type="Date" name="date_edt"></th>
                    <th>De<input type="number" name="dheure">h <input type="number" name="dmin">min <br>à<input type="number" name="fheure">h <input type="number" name="fmin">min</th>
                    <th><input type="submit" name="submit" value="Ajouter" class="btn btn-info"></th>

                </form>
            </tr>
        </tbody>

    </table>
    </center>
            </div>
        
        </div>
    </div>
    
</body>
</html>




