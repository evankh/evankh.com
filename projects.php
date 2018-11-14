<?php
	function check_tag($filename, $tag) {
		$file = @fopen("projects/".$filename, "r");
		if($file) {
			$contents = fread($file, filesize("projects/".$filename));
			fclose($file);
			return strpos($contents, $tag);
		}
		return FALSE;
	}
	function parse_tags($tags) {
		$alltags = explode(", ", $tags);
		$return = "";
		foreach($alltags as $tag) {
			$return = $return."<a href=\"projects.php?tag=".str_replace("+", "%2B", $tag)."\">".$tag."</a> &nbsp; &nbsp;";
		}
		return $return;
	}
	function file_preview($filename) {
		$file = @fopen("projects/".$filename, "r");
		if($file) {
			$title = rtrim(fgets($file), "\r\n");
			$brief = rtrim(fgets($file), "\r\n");
			$url = rtrim(fgets($file), "\r\n");
			$tags = rtrim(fgets($file), "\r\n");
			$langs = rtrim(fgets($file), "\r\n");
			fclose($file);
			return "<div class=\"project\"><a href=\"".$url."\"><h2>".$title."</h2></a><p>".$brief."<p>Tagged: ".parse_tags($tags)."<p>Languages: ".parse_tags($langs)."</div>";
		}
		// Ignore the . and .. entries, or any other malformed filenames that may get passed in accidentally
		return "";
	}
	if(isset($_GET["project"])) {
		$filename = "projects/".$_GET["project"].".txt";
		$file = @fopen($filename, "r");
		if($file) {
			$title = rtrim(fgets($file), "\r\n");
			$brief = rtrim(fgets($file), "\r\n");
			$url = rtrim(fgets($file), "\r\n");
			$tags = rtrim(fgets($file), "\r\n");
			$langs = rtrim(fgets($file), "\r\n");
			$content = fread($file, filesize($filename));
			fclose($file);
		} else {
			$title = 404;
			$content = "Page not found. You may have found a broken link, or I may not have made this page yet. Sorry :(";
		}
	} else if(isset($_GET["tag"])) {
		$allposts = scandir("projects/");
		$title = "Projects tagged \"".$_GET["tag"]."\"";
		$content = "";
		if($allposts) {
			foreach($allposts as $filename) {
				if(strpos($filename, ".txt") && check_tag($filename, $_GET["tag"])) {
					$content = $content.file_preview($filename)."\n";
				}
			}
		} else {
			// I haven't posted anything yet, or I messed up the site
			$content = ":(";
		}
		if(strlen($content) == 0) {
			$content = "There's no projects tagged \"".$_GET["tag"]."\" yet.";
		}
	} else {
		$allposts = scandir("projects/");
		$title = "Projects";
		$content = "";
		if($allposts) {
			foreach($allposts as $filename) {
				if(strpos($filename, ".txt")) {
					$content = $content.file_preview($filename)."\n";
				}
			}
		} else {
			// I haven't posted anything yet, or I messed up the site
			$content = ":(";
		}
	}
	require 'template.php';
?>