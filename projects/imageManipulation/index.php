<?php
  $title = "Cristian David - CS major";
  $description = "My Projects";
  $keywords = "";
  $tabLocation = "projects";
  include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/header.php");
?>
<script src="Foundation5/js/foundation/foundation.slider.js"></script>
<script src="Foundation5/js/foundation/foundation.tooltip.js"></script>
<script src="Foundation5/js/foundation/foundation.reveal.js"></script>
<link rel="stylesheet" type="text/css" href="/MAINcrdavid/projects/imageManipulation/css/imageManip.css" />

<div class="separator"></div>

<div class="row" id="infoAlert">
  <div class="medium-6 medium-offset-3 columns">
    <div data-alert="" class="alert-box alert round">
      <a onclick="showModal('#firstModal')" style="color:white;">Click me for more information on this project&hellip;</a>
      <a class="close" onclick="closeAlert()">×</a>
    </div>
  </div>
</div>
<div id="firstModal" class="reveal-modal" data-reveal aria-labelledby="firstModalTitle" aria-hidden="true" role="dialog">
  <h2 id="firstModalTitle">The Image Manipulator.</h2>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  <p>
  This page was purely an experiment to learn more about how image processing works on a pixel level.</br>
  Every function on this page was created from scratch by me (with research - credit given appropriately in js comments).</br></br>
  The main purpose of this page was to implement the most commonly used edge detection algorithm - Canny Edge Detection.</br>
  This algorithm is implemented as follows:</br>
  <ul>
    <li><b>Gaussian Blur</b>
      <ul>
        <li>This is an algorithm used to help reduce 'noise' in the image so it is not detected as an edge.</li>
        <li>Using a specified radius, gaussian blur moves through each pixels in an image and blurs them by referencing the pixels ($radius pixels away)</li>
      </ul>
    </li>
    <li><b>Sobel Intensity Gradient</b>
      <ul>
        <li>Sobel filter uses two kernels: Kx = [[-1,0,1],[-2,0,2],[-1,0,1]] and Ky = [[-1,0,1],[-2,0,2],[-1,0,1]] and applies each to the each pixel to map out the corresponding gradients.</li>
        <li>Using this new gradient set, we calculate the edge gradient by plugging the gradients into G = sqrt(Gx^2 + Gy^2).</li>
        <li>At this point we have the effects of edge detection clearly visible in our image.</li>
      </ul>
    </li>
    <li><b>Non-maximum Suppression</b>
      <ul>
        <li>At this point we have the edges but we'd like to refine them.</li>
        <li>To do so, we suppress the edges that arent the most clearly identified by comparing neighbouring gradient angles.</li>
      </ul>
    </li>
    <li><b>Double Threshold</b>
      <ul>
        <li>Easy step here, just mark the strongly defined edges to separate them further from any remaining image 'noise'.</li>
      </ul>
    </li>
    <li><b>Edge Tracking by Hysteresis</b>
      <ul>
        <li>Intelligently determine which weak edges to keep judging by their possible connections to strong edges.</li>
      </ul>
    </li>
  </ul>
  </p>
</div>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">

    <section class="left tab-bar-section left-tab-bar" style="z-index:5;">
      <h1 class="title" id="optionsMenuOpener" onclick="openSimMenu()">Image Options</h1>
    </section>

    <aside class="left-off-canvas-menu">
      <!-- OPTION MENU -->
        <div class="row" id="menuOptions">
            <div class="large-12 columns selectionBox">
                  <hr>
                  <div class="row menuRow">
                    <div class="button expand" onclick="setImage();">Reset</div>
                  </div>
                  <hr>
                  <div class="row menuRow">
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Setting the detection value changes the radius of the gaussian blur and thus changes the precision of the edges.">
                        </hr>Edge Detection</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="edgeDetect" data-slider data-options="start: 0; end:20; initial: 3; display_selector: #detEdge;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="detEdge"></span>
                        </div>
                    </label>
                    <div class="button small" onclick="cannyEdgeDetection(parseInt($('#edgeDetect').attr('data-slider')));">Detect</div>
                  </div>
                  <hr>
                  <div class="row menuRow">
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Various filters to apply to the whole image">
                        Image Filters
                      </span>
                        <select id="filterSelect">
                            <option value="none">None</option>
                            <option value="sepia">Invert</option>
                        </select>
                    </label><hr>
                  </div>
                  <div class="row menuRow">
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Change brightness of the default image">
                        Brightness</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="imageBrightness" data-slider data-options="start: 0; end:300; initial: 100; display_selector: #imgBrightness;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="imgBrightness"></span>
                        </div>
                    </label>
                    <div class="button small" onclick="imageBrightness(parseInt($('#imageBrightness').attr('data-slider')));">Set Brightness</div>
                    <hr>
                  </div>
                  <div class="row menuRow">
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="The value set here represents the radius of the blur that each pixel experiences. Higher values take longer to compute.">
                        Blur Image</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="gaussBlur" data-slider data-options="start: 0; end: 10; initial: 5; display_selector: #gaussBluePrev;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="gaussBluePrev"></span>
                        </div>
                    </label>
                    <div class="button small" onclick="gaussianBlur(parseInt($('#gaussBlur').attr('data-slider')));">Add Blur</div>
                    <hr>
                  </div>
                  <div class="row menuRow">
                    <b>Grayscale Tints</b></br>
                    <label>
                        <span style="padding-left:15px;" data-tooltip aria-haspopup="true" class="has-tip" title="Add red tint to grayscale version of the image">
                        Red</br>
                        </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="tintRed" data-slider data-options="start: 0; end:300; initial: 0; display_selector: #tintR;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="tintR"></span>
                        </div>
                    </label>
                  </div>
                  <div class="row menuRow">
                    <label>
                        <span style="padding-left:15px;" data-tooltip aria-haspopup="true" class="has-tip" title="Add green tint to grayscale version of the image">
                        Green</br>
                        </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="tintGreen" data-slider data-options="start: 0; end:300; initial: 0; display_selector: #tintG;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="tintG"></span>
                        </div>
                    </label>
                  </div>
                  <div class="row menuRow">
                    <label>
                        <span style="padding-left:15px;" data-tooltip aria-haspopup="true" class="has-tip" title="Add blue tint to grayscale version of the image">
                        Blue</br>
                        </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="tintBlue" data-slider data-options="start: 0; end:300; initial: 0; display_selector: #tintB;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="tintB"></span>
                        </div>
                    </label></br>
                    <div class="button small" onclick="imageTint(parseInt($('#tintRed').attr('data-slider')), parseInt($('#tintGreen').attr('data-slider')), parseInt($('#tintBlue').attr('data-slider')));">Set Tints</div>
                    <hr>
                  </div>
                  </hr>

            </div>
        </div>
      <!-- END OPTION MENU -->
    </aside>

    <section class="main-section" style="min-height:750px;">
      <!-- MAIN SIMULATION CONTENT -->

      <div class="row" style="padding-top:10px;">
          <div class="large-12 columns" id="canvasContainer">
        
              <canvas class="theDisplay" id="theScreen"></canvas>
              <canvas style="display:none;" class="theDisplay" id="backImg"></canvas>
          </div>
      </div>

      <!-- END MAIN SIMULATION CONTENT -->
    </section>


    <section class="right tab-bar-section right-tab-bar" style="left:auto">
      <h1 class="title" id="optionsMenuOpener" onclick="openImgMenu()">Image List</h1>
    </section>

    <aside class="right-off-canvas-menu">
      <div id="imageList">

      </div>
    </aside>

    <a class="exit-off-canvas"></a>

  </div>
</div>







<div class='pin' id="pixelHover">
  <div class="pixelHoverColor"></div>
  <div class="colorInfo"></div>
</div>

<div class="separator"></div>

<script>

  /* --------- Globals         --------- */
  var pixelDisplay = "#pixelHover";



  var imageData = null;
  var pixels = null;
  var numPixels = null;

  var brightness = 0;

  var imagePath = imgPath("cat.jpg");


  var image;

  var canvas = document.getElementById("theScreen");
  canvas.setAttribute('width', $("#canvasContainer").width());
  canvas.setAttribute('height', $("#canvasContainer").height());
  var ctx = canvas.getContext("2d");



  var backImg;

  var backCanvas = document.getElementById("backImg");
  backCanvas.setAttribute('width', canvas.width);
  backCanvas.setAttribute('height', canvas.height);
  var c2x = backCanvas.getContext("2d");
  var backImgData = null;

  
  /* --------- Functions      --------- */

  $(document).ready(function() {

    // Get list of images to be displayed in the imageList menu
    $.ajax({
      url: "/MAINcrdavid/projects/imageManipulation/images/",
      success: function(data){
        var imageList = [];
          $(data).find("a:contains(.jpg)").each(function(){
            imageList.push(imgPath($(this).attr("href")));
          });
          // Set the images inside the image list menu
          for(var i = 0; i < imageList.length; i++){
            var imgStr = "<img class='hvr-pulse-grow' src='"+imageList[i]+"' style='width:100%; height:auto;' onclick='newImageSelected(this)'>";
            $("#imageList").html($("#imageList").html() + imgStr);
          }
      }
    });

    setImage();

  });

  function newImageSelected(val){
    imagePath = val.src;
    setImage();
  }

  function setImage(){
    image = new Image();
    image.src = imagePath;

    backImg = new Image();
    backImg.src = imagePath;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    c2x.clearRect(0, 0, canvas.width, canvas.height);

    // Deal with image display once it's loaded properly
    $(image).load(function(){
      // create the main image
      display(image);

      // Create the backup image
      backCanvas.setAttribute('width', canvas.width);
      backCanvas.setAttribute('height', canvas.height);
      c2x.drawImage(backImg, 0, 0, canvas.width, canvas.height);
      backImgData = c2x.getImageData(0, 0, canvas.width, canvas.height);
    });
  }

   /* ----------- HELPERS ------------- */
  function imgPath(name){
    return ("/MAINcrdavid/projects/imageManipulation/images/"+name);
  }


  /* ------------ DOM EDITORS ---------- */
  

  $("#filterSelect").on('change', function(){
    var option = this.value;

    if(this.value == "none"){
      display(image);
    }else if(this.value == "sepia"){
      imageSepia();
    }
  });

  $(canvas).mouseenter(function(e) {
    $("#pixelHover").show();
  });
  $(canvas).mousemove(function(e) {
      showPixelColor(e);
  });
  $(canvas).mouseleave(function() {
    $("#pixelHover").hide();
  });

 
  function closeAlert(){
    $("#infoAlert").toggle(500);
  }
  function showModal(id){
    $(id).foundation('reveal','open');
  }
  function openSimMenu(){
    $(".off-canvas-wrap").foundation("offcanvas", "toggle", "move-right");
    setTimeout(function(){
        $(document).foundation('slider', 'reflow');
    }, 1000);
  }
  function openImgMenu(){
    $(".off-canvas-wrap").foundation("offcanvas", "toggle", "move-left");
    setTimeout(function(){
        $(document).foundation('slider', 'reflow');
    }, 1000);
  }

</script>

<script type="text/javascript" src="/MAINcrdavid/projects/imageManipulation/js/imageControl.js"></script>

<?include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/footer.php");?>