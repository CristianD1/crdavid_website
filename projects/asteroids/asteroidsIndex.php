<?php

  $title = "Cristian David - CS major";

  $description = "My Projects";

  $keywords = "";

  $tabLocation = "projects";

  include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/header.php");

?>



<div class="separator"></div>



<div class="row">

	<div class="large-12 columns">

		<div class="panel">

			<h3><div style="text-align:center">About the program</div></h3>

			</br>

			<p>This entire program was created with java's vector graphics ability and various mathematical algorithms.</br>

				 Being nearly entirely dynamically generated (other than the menus), this was my first project on dynamic generation algorithms.</br></p>

			<img src="http://crdavid.com/MAINcrdavid/projects/asteroids/screens/Main.jpg">

			</br>

			<p>There is a shop that allows you to upgrade specific abilities (including special abilities).</br>

				 The abilities (such as bullet spread) are mathematically calculated to produce the desired effect.</p>

			</br>

			<img src="http://crdavid.com/MAINcrdavid/projects/asteroids/screens/shop.png">

			</br>

			<p>As levels progress, more asteroids get added for extra difficulty, and the speed of said asteroids increase.</br>

			   For fairness, the generation of asteroids is restricted such that both their initial path and their position would not immediately destroy the players ship.</p>

			</br>

			<img src="http://crdavid.com/MAINcrdavid/projects/asteroids/screens/level7.png">

			</br>

			<p>Each asteroid breaks apart into two separate and smaller asteroids (that are dynamically designed and created).</br>

			   At the same time, they occasionally drop a varying green square that gives money.</br>

			</br>

			<img src="http://crdavid.com/MAINcrdavid/projects/asteroids/screens/asteroidsBreak.png">

			</br>

		</div>

	</div>

</div>



<div class="row">

	<div class="large-12 columns">

		<div class="panel">

			<h6>Please visit <a href="https://github.com/CristianD1/Asteroids/tree/master"> my GitHub </a> for the code.</h6>

		</div>

	</div>

</div>



<div class="separator"></div>

<div class="separator"></div>



<?php include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/footer.php"); ?>