<?php
	function file_preview($filename) {
		$file = @fopen("blogs/".$filename, "r");
		if ($file) {
			$title = rtrim(fgets($file), "\r\n");
			$by = rtrim(fgets($file), "\r\n");
			$date = rtrim(fgets($file), "\r\n");
			$preview = fread($file, 250);
			fclose($file);
			return "<a href=\"blog.php?date=".$date."&amp;title=".trim(strstr($filename, ".txt", TRUE), "0..9-_")."\"><h2>".$title."</h2></a> ".$date."<p>".$preview.(strlen($preview) < 250 ? "</p>" : "...</p>");
		}
		// Ignore the . and .. entries, or any other malformed filenames that may get passed in accidentally
		return "";
	}
	if(isset($_GET["date"]) && isset($_GET["title"])) {
		$filename = "blogs/".$_GET["date"]."_".$_GET["title"].".txt";
		$file = @fopen($filename, "r");
		if($file) {
			$title = rtrim(fgets($file), "\r\n");
			$by = rtrim(fgets($file), "\r\n");
			$date = rtrim(fgets($file), "\r\n");
			$content = fread($file, filesize($filename));
			fclose($file);
		} else {
			$title = 404;
			$content = "Page not found. You may have found a broken link, or I may not have made this page yet. Sorry :(";
		}
	} else {
		$allposts = scandir("blogs/", SCANDIR_SORT_DESCENDING);
		$title = "Blog";
		$content = "";
		if($allposts) {
			foreach($allposts as $filename) {
				$content = $content.file_preview($filename)."\n";
			}
		} else {
			// I haven't posted anything yet, or I messed up the site
			$content = ":(";
		}
	}
	require 'template.php';
?>
