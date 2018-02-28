<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

    <script src="main.js"></script>
</head>
<body>

    <div class="container">
        <h2>QR Codes</h2>


        <div class="cardDiv">


        <!-- Cards Start HERE -->

        	<?php 
	       	//looks though the codes folder and displays all the images
	       $folder = "codes";
	       $results = scandir('codes');
	       foreach ($results as $result) {
	       	if ($result === '.' or $result === '..') continue;
	       	if (is_file($folder . '/' . $result)) {
                   //create another var just to check if the name has WE in it, the if else statement for the
                   //logo happens AFTER the one removing the WE from the name so another var has to be made.
                   $resultsWithWELogo = $result;
                   echo '
                   <div class="card" style="width:200px">
                    <img class="card-img-top" src="'.$folder . '/' . $result.'" alt="QR Code" style="width:100%">
                    <div class="card-body">
                    ';
                    //checking if the name has 'WE' in it, then we replace WE with nothing.
                    if (strpos($result, 'WE') !== false) {
                        $result = str_replace('WE', '', $result);
                    }                    
                    echo '
                    <h4 class="card-title">'.$result.'                    
                    ';
                    //checking if var $resultsWithWELogo (aka the name of the qr code WITHOUT removing the WE has the letters WE in it)
                    //if it does, put a logo in the title;
                    if (strpos($resultsWithWELogo, 'WE') !== false) {
                        echo '<img class="WELogo" src="WELogo.png"></img>';
                    }
                    echo '
                    </h4>
                    <p><a href="remove.php?name='.$result.'" class="btn btn-danger btn-xs" role="button">Remove</a></p>
                    </div>
                    </div>';
	       	}
	       }
	       ?>

        <!-- Cards end HERE -->

        </div>    <!-- Card div ends here -->

    </div>

    <div class="container">
        <div class="jumbotron">
        <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">1) Select the QR Code to upload</label>
                <input type="file" name="file">
                <p class="help-block">2) Now type in the name of the food below.</p>
                <strong><p class="help-block">If it is a WE item, type the letters "WE" after the name!</p></strong>
                <input type="text" name="name" id="name" >
                <p class="help-block">3) Now hit upload!</p>
            </div>
            <input type="submit" class="btn btn-lg btn-primary" value="Upload">
        </form>
        </div>
    </div>


    <div class="container">
        <div class="jumbotron">
            <h1>Now after all all those files are done:</h1>
            <h4>Please enter the meal name: (example: dinner, breakfast...)</h4>
            <form action="menuPDF.php" method="post">
                <div class="form-group">
                    <input type="text" name="menu_name" id="menu_name">
                </div>
                <input type="submit" class="btn btn-lg btn-primary" value="Convert to a PDF">
            </form>
        </div>
    </div>


</body>
</html>