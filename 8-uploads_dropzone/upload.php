<?php
    
    if(!empty($_FILES))
    {
        require 'utils.php';

        // Os dados do ficheiro são recuperados pelo array $_FILES

        // define a pasta onde ficam os ficheiros uploaded
        $uploadDir = 'uploads/';
        // nome do ficheiro
        $fileName = basename($_FILES['file']['name']);
        // concatena o nome da pasta com o nome do ficheiro
        $uploadFilePath = $uploadDir . $fileName;

        $temp_file = $_FILES['file']['tmp_name'];
        
        // move o ficheiro para a pasta definida em $uploadDir do servidor
        if(move_uploaded_file($temp_file, $uploadFilePath))
        {
            $db = connect_db();
            // insere na tabela files da base de dados do ficheiro
            $sql = "INSERT INTO files(file_name, uploaded_on) VALUES('" . $fileName . "', NOW())";
            $insert = $db->exec($sql);
        }
        unset($db);
    }
?>