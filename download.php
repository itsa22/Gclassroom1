<?php
    
    if(!empty($_GET['file'])){
        $filename = basename($_GET['file']);
        $filepath = 'your_file/' .$filename;
        if(!empty($filename) && file_exists($filepath)){
            header('Content-Description: File Transfer');
            header('Content-Type: application/zip');
            header('content-Disposition: attachment; filename='.$filename);
            header('Content-Transfer-Emcoding: binary');
            
            header('Cache-Control: public');
            
            readfile($filepath);
            exit;
        }else{
            echo "file not exits";
        }
    }
?>