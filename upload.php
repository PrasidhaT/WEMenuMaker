<?php
//turn on php error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$name     = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$error    = $_FILES['file']['error'];
	$size     = $_FILES['file']['size'];
	$ext	  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    
    $foodName = $_POST['name'];


	switch ($error) {
		case UPLOAD_ERR_OK:
			$valid = true;
			//validate file extensions
			if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
				$valid = false;
				$response = 'Invalid file extension.';
			}
			//validate file size
			if ( $size/10240/10240 > 2 ) {
				$valid = false;
				$response = 'File size is exceeding maximum allowed size.';
			}
			//upload file
			if ($valid) {
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'codes' . DIRECTORY_SEPARATOR. $foodName;
				move_uploaded_file($tmpName,$targetPath); 
				header( 'Location: index.php' ) ;
				exit;
			}
			break;
		default:
			$response = 'Unknown error';
		break;
	}


	echo $response;
}
?>