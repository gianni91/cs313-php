<?php
	header("Content-type: text/xml\n\n");
	echo "success"; 
       	$text = $_POST["passText"];
       	$ideaFile = fopen("FHE_Ideas.txt", "w") or die("failed to write to file");
       	fwrite($ideaFile, $text);
       	fclose($ideaFile);

?>
