<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Livraria Dropzone para fazer o upload dos ficheiros, possui os recurso dragdrop -->
    <link rel="stylesheet" href="js/dropzone/dist/dropzone.css">
    <script src="js/dropzone/dist/dropzone.js"></script>
</head>
<body>
    <div class="container">
        <!-- Cria o form com a class dropzone. Dropzone liga automaticamente ao formulário -->
        <form action="upload.php" class="dropzone" id="dropzoneFrom">
        </form>

        <!-- Se utilizar outra classe em vez de dropzone então deve personalizar com CSS -->
        <div class="dropzone"></div>


        <!-- 
            Upload com botão 
            Arrastar os ficheiros depois clicar no botão para enviar para o servidor.
        -->
        <p>Arrasta os ficheiros e depois clica no botão</p>
        <button class="btn btn-secondary" id="startUpload">Carregar Ficheiros</button>

        <!-- Zona/div onde serão colocados os ficheiros submetidos -->
        <div class="gallery">
            <h3>Uploaded Files:</h3>
            <?php
                // Mostra o nome dos ficheiros que se enccontram no servidor (uploaded)
                require_once "utils.php";
                $db = connect_db();
                $sql = "SELECT * FROM files ORDER BY id DESC";
                $result = $db->query($sql);
                if($result->rowCount() > 0){
                    while($row = $result->fetch()){
                        //echo $row["file_name"];
                        $filePath = 'uploads/' . $row["file_name"];
                        // mime_content_type() deteta o tipo de conteúdo de um ficheiro
                        $fileMime = mime_content_type($filePath);
            ?>
                        <!-- A tag embed pode ser usada para  visualizar os ficheiros numa página web -->
                        <embed src="<?php echo $filePath; ?>" type="<?php echo $fileMime; ?>" width="350px" height="240px" />
            <?php
                    }
                }else {
                    echo '<p>Não foram encontrados ficheiros ...</p>';
                }
            ?>
        </div>
    </div>


    <script>
        /* 
            Os Dropzone possui várias opções de configuração para personalizar o drag and drop dos ficheiros para upload
            Por defeito, o upload inicia automaticamente depois de arrastar (drap) os ficheiros no dropzone. Pode alterar
            este comportamento adicionando um botão HTML.
            autoProcessQueue - método ou opção que permite submeter os ficheiros clicando num botão. Se tomar o valor false 
            diz ao dropzone para não carregar o ficheiro por arrastamento.
            processQueue() - método que inicia o envio dos ficheiros
        */
        Dropzone.autoDiscover = false;
        $(function(){
            // inicializa o dropzone
            var myDropzone = new Dropzone(".dropzone", {
                url: "upload.php",      // nome do ficheiro a submeter para o servidor
                paramName: "file",      // nome do ficheiro input
                maxFilesize: 2,         // tamanho máximo permitido pelo upload
                maxFiles: 2,            // número máximo de ficheiro permitidos para upload
                acceptedFiles: "image/*,application/pdf",    // lista de ficheiros mime permitidos
                autoProcessQueue: false,     // método que permite submeter os ficheiros por um botão
                acceptedFiles:".png.jpg,.gif,.bmp,.jpeg,.pdf"    // ficheiros aceites para upload
            });

            // tratamento do botão
            $("#startUpload").click(function(){
                // inicia o processo de envio
                myDropzone.processQueue();
            });

            /* // tratamento do botão
            $("#complete").click(function(){
                // complete é o id do botão
                myDropzone.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });
            }); */

            myDropzone.on("complete", function(file) {
                if(myDropzone.getQueuedFiles().length == 0 && myDropzone.getUploadingFiles().length == 0){
                    var _this = myDropzone;
                    _this.removeAllFiles();
                }
                // myDropzone.removeFile(file);
            });
            
        });
    </script>
</body>
</html>