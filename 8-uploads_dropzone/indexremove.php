<!doctype html>
<html>

<head>
    <!-- CSS -->
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="js/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/dropzone/dist/dropzone.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <div class='content'>
            <form action="upload.php" class="dropzone" id="dropzonewidget">

            </form>
        </div>
    </div>

    <script>
    Dropzone.autoDiscover = false;
    $(".dropzone").dropzone({
        addRemoveLinks: true,
        removedfile: function(file) {
            var name = file.name;

            $.ajax({
                type: 'POST',
                url: 'remove.php',
                data: {
                    name: name,
                    request: 2
                },
                sucess: function(data) {
                    console.log('success: ' + data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
                void 0;
        }
    });
    </script>
</body>

</html>