<?php

  $title = "Cristian David - CS major";

  $description = "My Projects";

  $keywords = "";

  $tabLocation = "projects";

  include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/header.php");
?>


<?php

$xml=simplexml_load_file("wordBank.xml") or die("Error: Cannot open xml");

foreach($xml->children() as $wordBanks){
	foreach($wordBanks->children() as $wordLists){
		echo $wordLists . " -----> " . $wordLists['wordType'];
		echo "</br>";
	}p
	
	echo "</br>";
}
?>


<div class="separator"></div>


<div class="row">

	<div class="large-12 columns">

		<?
		foreach($xml->children() as $wordBanks){
			?>
			<div class="wordBankBox">
			<?
				foreach($wordBanks->children() as $wordLists){
					echo $wordLists . " -----> " . $wordLists['wordType'];
					echo "</br>";
				}
				echo "</br>";
			?>
			</div>
			<?
		}
		?>

	</div>

</div>


<div class="separator"></div>

<div class="separator"></div>



<?php include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/footer.php"); ?>