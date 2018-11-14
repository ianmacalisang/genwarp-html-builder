<?php
		
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	
	$filename = "elements/preview_".generateRandomString(20).".html";
	
	$previewFile = fopen($filename, "w");

	$pageContent = stripcslashes($_POST['page']);

	$pageContent = str_replace("../bundles/", "bundles/", $pageContent);
	
	fwrite($previewFile, stripcslashes($pageContent));
	
	fclose($previewFile);
	
	header('Location: '.$filename);
	
	
?>