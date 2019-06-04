<!DOCTYPE html>
<html>
    <head>
        <title>Delivery Note</title>
        <link href="web/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <h1>Upload json file</h1>
            <form action="showDeliveryNote.php" enctype="multipart/form-data" method="POST" >
                <input type="file" name="jsonFile" id="jsonFile" accept="application/json">
                <input type="submit" name="submit" value=" Upload " >
            </form>
        </div>
    </body>
</html>

