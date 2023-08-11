<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <button type="button" id="button1" class="btn btn-success btn-block">Click Here To Start Progress Bar</button>
                <p>&nbsp;
                <p>
                    <button type="button" id="button2" class="btn btn-danger btn-block">Click Here To Stop Progress Bar</button>
            </div>
            <div class="col-md-12">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <div id="progressbar" style="border:1px solid #ccc; border-radius: 5px; "></div>

                vvvvvdvzZXVCZVCVcvvc
                <br>
                <div id="information"></div>
            </div>
        </div>
    </div>

    <iframe id="loadarea" style="display:none;"></iframe><br />
    <script type="text/javascript" src="js3/jquery-1.12.4.js"></script>
    <script>
        $("#button1").click(function() {
            document.getElementById('loadarea').src = 'tablevat44.php';
        });
        $("#button2").click(function() {
            document.getElementById('loadarea').src = '';
        });
    </script>
</body>


</html>