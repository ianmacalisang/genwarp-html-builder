<?php

	$uploads_dir = 'elements/bundles';//specify the upload folder, make sure it's writable!
	$relative_path = '../bundles';//specify the relative path from your elements to the upload folder

	$allowed_types = array("image/jpeg", "image/gif", "image/png", "image/svg", "application/pdf");


	/* DON'T CHANGE ANYTHING HERE!! */

	$return = array();


	//does the folder exist?
	if( !file_exists( $uploads_dir ) ) {

		$return['code'] = 0;
		$return['response'] = "The specified upload location does not exist. Please provide a correct folder in /_upload.php";

		die( json_encode( $return ) );

	}

	//is the folder writable?
	if( !is_writable( $uploads_dir ) ) {

		$return['code'] = 0;
		$return['response'] = "The specified upload location is not writable. Please make sure the specified folder has the correct write permissions set for it.";

		die( json_encode( $return ) );

	}

	if ( !isset($_FILES['imageFileField']['error']) || is_array($_FILES['imageFileField']['error']) ) {

		$return['code'] = 0;
		$return['response'] = $_FILES['imageFileField']['error'];

		die( json_encode( $return ) );

	}

	$name = $_FILES['imageFileField']['name'];

	$file_type = $_FILES['imageFileField']['type'];


	if(in_array($file_type, $allowed_types)) {

		if (move_uploaded_file( $_FILES['imageFileField']['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME'])."/".$uploads_dir."/".$name ) ) {

			//echo "yes";

		} else {

			$return['code'] = 0;
			$return['response'] = "The uploaded file couldn't be saved. Please make sure you have provided a correct upload folder and that the upload folder is writable.";

		}

		//print_r ($_FILES);

		$return['code'] = 1;
		$return['response'] = $relative_path."/".$name;

	} else {

		$return['code'] = 0;
		$return['response'] = "File type not allowed";

	}



	echo json_encode( $return );

?>