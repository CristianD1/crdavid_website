<?php
  $title = "Cristian David - CS major";
  $description = "My Projects";
  $keywords = "";
  $tabLocation = "projects";
  include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/header.php");
?>
<link rel="stylesheet" type="text/css" href="/MAINcrdavid/projects/imageGenerator/css/imageGenPage.css" />

<script type="text/javascript" src="/MAINcrdavid/projects/imageGenerator/js/paper-full.js"></script>
<script type="text/javascript" src="/MAINcrdavid/projects/imageGenerator/js/imageGenerationControl.js"></script>

<div class="separator"></div>

<div class="row">
  <div class="large-12 columns">
    <canvas id="imgGen"></canvas>
  </div>
</div>

<div class="separator"></div>

<script type="text/javascript">

  var canvas = document.getElementById('imgGen');
  // Create an empty project and a view for the canvas:
  paper.setup(canvas);


  $("#imgGen").click(function() {
      
    var path = new paper.Path.Rectangle([75, 75], [100, 100]);
    path.strokeColor = 'black';

    // Draw the view now:
    paper.view.draw();
      
  });


</script>

<?include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/footer.php");?>