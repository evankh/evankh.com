<?php
	$filename = "index.txt";
	$file = @fopen($filename, "r");
	if($file) {
		$title = rtrim(fgets($file), "\r\n");
		$content = fread($file, filesize($filename));
		fclose($file);
	} else {
		$title = 404;
		$content = "Page not found. You may have found a broken link, or I may not have made this page yet. Sorry :(";
	}
	require 'template.php';
?>