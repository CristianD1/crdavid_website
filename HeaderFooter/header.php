<?php
	// Header.php generates a header for a page on CrDavid.
	// Each header will automatically generate a <head> tag, along with the opening tag of the <body>.
	// The user is capable of defining a title ($title), description ($description), keywords ($keywords), script list ($scriptLst), and css list ($cssLst).
	// If undefined, each variable will be initialized to an empty state.
	// Note that the base directory will be set to https://skillzon.com/MAIN/.
	// By default, jquery.js, modernizr.js, foundation.js and foundation.topbar.js are loaded.
	// foundation is automatically initialized, and all imported foundation modules are also initialized.
?>


<!DOCTYPE html>	

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta name="title" content="Cristian David"/>
		<meta name="description" content="Web/Software Developer"/>
		<link rel="image_src" href="http://crdavid.com/MAINcrdavid/pics/homebanner.jpg"/>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<base href="http://crdavid.com/MAINcrdavid/"><!--[if lte IE 6]></base><![endif]-->

<?php
if(isset($description)) {
	echo "\t\t", '<meta name="description" content="', $description, '">', PHP_EOL;
}
if(isset($keywords)) {
	echo "\t\t", '<meta name="keywords" content="', $keywords, '">', PHP_EOL;
}
if(isset($title)) {
	echo "\t\t", '<title>', $title, '</title>', PHP_EOL;
}
if(!isset($tabLocation)){
	$tabLocation = "noTab";
}
?>

		<script type="text/javascript" src="Foundation5/js/vendor/jquery.js"></script>


		<link rel="icon" type="image/png" href="pics/favicon.png">
		<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="Foundation5/js/vendor/modernizr.js"></script>
		<script type="text/javascript" src="Foundation5/js/foundation/foundation.js"></script>
		<script type="text/javascript" src="Foundation5/js/foundation/foundation.topbar.js"></script>
		<script type="text/javascript" src="Foundation5/js/foundation/foundation.offcanvas.js"></script>

		<script type="text/javascript" src="Foundation5/js/foundation/foundation.accordion.js"></script>
		<script type="text/javascript" src="Foundation5/js/foundation/foundation.tab.js"></script>
		

		<!-- JQUERY LOADING SIGN -->
		<style>
			.no-js #loader { display: none;  }
			.js #loader { display: block; position: absolute; left: 100px; top: 0; }
			.se-pre-con {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url(pics/crdavidLoading.gif) center no-repeat;
			}
		</style>
		<script>
			$(window).load(function() {
				// Animate loader off screen
				$(".se-pre-con").fadeOut("slow");
			});
		</script>	

		<!-- END LOADING SIGN -->


		<?if($tabLocation == "stories"){?>
			<!-- Page turn CSS -->
			<script type="text/javascript" src="flipBookFiles/extras/jquery-ui-1.8.20.custom.min.js"></script>
			<script type="text/javascript" src="flipBookFiles/extras/modernizr.2.5.3.min.js"></script>
			<script type="text/javascript" src="flipBookFiles/lib/turn.js"></script>
		<?}?>
	
		<?if($tabLocation == "projects"){?>
			<link rel="stylesheet" type="text/css" href="css/imageRollMain.css" />
        	<link rel="stylesheet" type="text/css" href="css/imageRollMainCommon.css" />
        	<link rel="stylesheet" type="text/css" href="css/imageRollMainStyle2.css" />

        	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
			<!--script type="text/javascript" src="js/modernizr.custom.69142.js"></script-->
			<script type="text/javascript" src="js/jquery.hoverfold.js"></script> 

			<link rel="stylesheet" type="text/css" href="css/poemGen.css"/>
		<?}?>

		<?if($tabLocation == "home"){?>
			<link rel="stylesheet" type="text/css" href="css/explodingParticlesdefault.css" />
			<link rel="stylesheet" type="text/css" href="css/explodingParticlesComponent.css" />
			<script src="js/modernizr.custom.js"></script>
		<?}?>

		<?if($tabLocation == "work"){?>
			
		<?}?>

<?php
if(isset($scriptLst)) {
	foreach ($scriptLst as $script) {
		echo "\t\t", '<script type="text/javascript" src="', $script, '"></script>', PHP_EOL;
	}
}

if(isset($cssLst)) {
	foreach ($cssLst as $css) {
		echo "\t\t", '<link rel="stylesheet" type="text/css" href="', $css, '" />', PHP_EOL;
	}
}

?>

		<?if($tabLocation == "stories"){?>
				<link rel="stylesheet" type="text/css" href="css/book.css" />
		<?}?>
		<link rel="stylesheet" type="text/css" href="css/general.css" />

		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie+Flower|Slabo">
		<link rel="stylesheet" type="text/css" href="Foundation5/css/foundation.min.css" />

		<script>
			$(document).ready(function() {
				$(document).foundation();
			});
		</script>
		
	</head>

	<body class="bodyBackground">

		<div class="se-pre-con"></div>
		
		<?if($tabLocation == "home"){?>
			<div class="row">
				<div class="large-12 columns" id="employmentContainer">
					<div class="container">
						<div class="ip-slideshow-wrapper">
							<nav>
								<span class="ip-nav-left"></span>
								<span class="ip-nav-right"></span>
							</nav>
							<div class="ip-slideshow"></div>
						</div>
					</div><!-- /container -->
					<script src="js/particlesSlideshow.js"></script>
				</div>
			</div>
		<?}?>
		
		<div class="row">
			<div class="large-12 columns">
				<nav class="top-bar" data-topbar role="navigation">
					<ul class="title-area">
						<?if($tabLocation == "home"){?><li class="name active"><?
						}else{?><li class="name"><?}?>
							<h1><a href="index.php">CrDavid</a></h1>
						</li>
						<li class="divider"></li>
						<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
					</ul>
					
					<section class="top-bar-section">
						<ul class="right">
							<li class="divider"></li>
							<?if($tabLocation == "work"){?><li class="active"><?
							}else{?><li><?}?>
								<a href="workExperiences.php">Work Experience</a></li>
							<li class="divider"></li>
							
							<li class="divider"></li>
							<?if($tabLocation == "projects"){?><li class="active"><?
							}else{?><li><?}?>
								<a href="projects.php">Projects</a>
							</li>
							<li class="divider"></li>
							
							<?if($tabLocation == "stories"){?><li class="active"><?
							}else{?><li><?}?>
								<a href="stories.php">Writings</a></li>
							<li class="divider"></li>
							
							<li class="divider"></li>
							<li>
								<a href="CristianRazvanDavidResume.pdf" target="_blank">Resume</a>
							</li>
							<li class="divider"></li>
						</ul>
					</section>
				</nav>
			</div>
		</div>
				
		<section class="main-section">
