<?php
try {
    //code...
    $conn = new PDO('mysql:host=localhost; dbname=classroom','root', '');
} catch (PDOException $th) {
    //throw $th;
    echo $th->getMessage();
}    