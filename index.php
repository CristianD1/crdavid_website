<?php
	$title = "Cristian David - CS major";
	$description = "Welcome";
	$keywords = "";
	$tabLocation = "home";

session_start();

$db_host ="localhost";
$db_user ="skillzon";
$db_pass ="Cristian1";
$db_database ="SkillzOnBase";

// Create Connection
$conn = new mysqli($db_host, $db_user,  $db_pass, $db_database);
// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlSelect = "SELECT ProjectName, Link, Language FROM Projects ORDER BY DateCreated DESC LIMIT 2;";

$projs = $conn->query($sqlSelect);

$projsArr = array();
while($row = $projs->fetch_assoc()) {
	array_push($projsArr, array($row["ProjectName"], $row["Link"], $row["Language"]));
}

$conn->close();

$_SESSION['projsArr'] = $projsArr;

?>
		<?include("HeaderFooter/header.php");?>
		<div class="separator"></div>

		<div class="row"> <!-- Main page element -->
			<div class="large-8 columns">

				<img src="pics/homebanner.jpg">

				<div class="panel">
					<h1 style="align:center"> Welcome to CrDavid </h1></br>
					<p>
						Welcome to my personal blog/website where I try to keep track of programs i've built over my journey across the magical land of typing on a keyboard and making things work!</br></br>
						I'm currently a second year University of Waterloo Computer Science student interested in just about anything programming related and constantly curious about the possibilities. Between my courses and assignments I try to keep up with maintaining this site and continually adding projects that i've done for potential employers, friends, and even myself just to remember the cool things I can do.
					</p>
				</div>

				<div class="separator"></div>

			</div>
			<div class="large-4 columns">
				<a href="https://www.linkedin.com/in/cristiandavid" target="_blank">
						<img src="pics/compressedMyFace.jpg">
					<div class="panel"><!-- Me info -->
						<h2>Cristian David</h2>
						<p>19 year old University of Waterloo computer science student interested in a wide variety of programming aspects including:
							<ul><li>Back-end web development</li>
									<li>Artificial Intelligence</li>
									<li>Front-end web Development</li>
									<li>Software Development</li>
									<li>Video game design/dev</li>
									<li>Algorithm Design</li></ul>
						</p>
					</div>
				</a>
				<div class="projectBox">
					<div class="titleBox" style="padding:13px;">
						Latest Projects
					</div>
					<div class="projectList">
						<?php
							$projsArr = $_SESSION['projsArr'];
						?>
						<?php
							foreach ($projsArr as $proj) {
								?>
									
									<div class="row">
										<div class="large-12 columns">
											<a href="<?php echo $proj[1]?>">
												<div class="TopProject"><p><?php echo $proj[0]." (".$proj[2].")";?></p></div>
											</a>
										</div>
									</div>
									
								<?php
							}
						?>
						<?php
							// Stop session
							session_unset();
							session_destroy();
						?>
				</div>
			</div>
			<div class="separator"></div>
		</div>


		<?php include("HeaderFooter/footer.php"); ?>
