<?php
	$title = "About me";
	$file = fopen("about.txt", "r");
	$content = fread($file, filesize("about.txt"));
	fclose($file);
	require 'template.php';
?>