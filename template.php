<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css">
		<link rel="icon" href="images/icon.svg">
		<title><?php echo $title; ?> | EvanKH.com</title>
		<meta name="theme-color" content="#f88008">
	</head>
	<body>
		<header>
			<div id="logo"><img src="images/icon.svg"></div>
			<a href="http://evankh.com"><h1>EvanKH.com</h1></a>
		</header>
		<div id="body">
			<nav>
				<a href="index.php"><h2>Home</h2></a>
				<a href="projects.php"><h2>Projects</h2></a>
				<a href="blog.php"><h2>Blog</h2></a>
				<a href="about.php"><h2>About Me</h2></a>
				<a href="resume.php"><h2>Resume</h2></a>
			</nav>
			<main>
				<h1><?php echo $title; ?></h1>
				<?php if(isset($by)) { echo "<div id=\"byline\"><h2>by $by on $date</h2></div>\n"; } else { echo "\n"; } ?>
				<div id="content">
					<?php echo $content, "\n"; ?>
				</div>
			</main>
		</div>
		<footer>
			<div id="footer-graphic">
				<div id="footer-graphic-left"></div>
				<div id="footer-graphic-right"></div>
			</div>
			<div id="footer-content">
				<div id="copyright">&copy;2018 Evan K. Hoffman | All content licensed <a href="license.php">CC BY-NC 4.0</a> unless otherwise noted</div>
				<div id="contact"><a href="contact.php">contact</a></div>
			</div>
		</footer>
	</body>
</html>