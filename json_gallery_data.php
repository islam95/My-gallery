<?php
	
header("Content-Type: application/json");
$folder = $_POST["folder"]; // POST from AJAX requiest that is "folder" from send method.
$jsonData = '{'; //Setting up a string to render as JSON.
$dir = $folder."/"; // directory for the folder.
$dirHandle = opendir($dir); // Reading(open) the folder that is specified in the directory.
$i = 0; // iteration variable
while ($file = readdir($dirHandle)){
	// The file cannot be a folder and must have specified extension (.jpg, .png, etc.).
	if(!is_dir($file) && preg_match("/.jpg|.jpeg|.gif|.png/i", $file)){
		$i++; // incrementing variable.
		$src = "$dir$file"; // the final name of the file with its directory
		$jsonData .= '"img'.$i.'":
						{ 
							"num":"'.$i.'",
							"src":"'.$src.'", 
							"name":"'.$file.'" 
						},';
	}
}
closedir($dirHandle);
$jsonData = chop($jsonData, ","); // chop (delete) the last comma from the JSON.
//$jsonData .= '"gallerydetails":{"piccount":'.$i.'}';
$jsonData .= '}'; // Compound JSON with closing curly brace.

echo $jsonData;
?>