<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Menu PDF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <!-- HTML2CANVAS -->
    <!-- jQUERY -->
    <script src="html2canvas.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!--<script  src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>-->
</head>
<script>
	$(document).ready(function(){
		html2canvas(document.querySelector("#pdf")).then(canvas =>{
			var link = document.createElement('a');
				link.innerHTML = '<button class="btn btn-lg btn-primary downloadBtn">Download</button>';
				link.addEventListener('click', function(ev){
					link.href 		= canvas.toDataURL("image/png");
					link.download 	= "MenuPDF.png";
				}, false);
			document.body.prepend(link);
			//document.body.appendChild(canvas); 
			//var myImage = canvas.toDataURL("image/png");
            //window.open(myImage);
		});
		
	});
</script>

<body>
    <div id="pdf" class="pdf">

        <?php 

        $menu = $_POST['menu_name'];
        echo '
        <div class="heading">
        <h1 class="menuHeading">'.$menu.'</h1>
        </div>
        ';

        ?>

    <div class="codes">
    <?php 

//looks though the codes folder and displays all the images
$folder = "codes";
$results = scandir('codes');
foreach ($results as $result) {
if ($result === '.' or $result === '..') continue;
if (is_file($folder . '/' . $result)) {
    //This one is the complete opposit. The Name goes BEFORE the image so first we use resultswithwelogo 
    //remove the WE and just use that var as the h1
    //then we use results (which is the name of the file, no change whatsoever) and just
    //tell it to echo that image
    $resultsWithWELogo = $result;
    echo '
    <div class="card" style="width:300px">
    <img class="card-img-top QRCodeImage" src="'.$folder . '/' . $result.'" alt="QR Code" style="width:100%">

    <div>
    ';
    //checking if the name has 'WE' in it, then we replace WE with nothing.
    if (strpos($resultsWithWELogo, 'WE') !== false) {
        $resultsWithWELogo = str_replace('WE', '', $resultsWithWELogo);
    }  
    //print out h1 of name without WE                  
    echo '
    <h2>'.$resultsWithWELogo.'                    
    ';
    //checking to see if image is a WE item (has WE in the name)
    if (strpos($result, 'WE') !== false) {
        echo '<img class="WELogo" src="WELogo.png"></img>';
    }
    echo '
    </h2>
     </div>
     </div>
';
}
}
?>

</div>
</div>

</body>


</html>