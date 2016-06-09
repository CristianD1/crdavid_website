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
<link rel="stylesheet" type="text/css" href="/MAINcrdavid/projects/theSocialAIExperiment/css/theExperiment.css" />

<script type="text/javascript" src="/MAINcrdavid/projects/theSocialAIExperiment/js/scColor.js"></script>

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
  <h2 id="firstModalTitle">The social AI experiment.</h2>
  <p>This project was meant to be a simulation of the most basic social interactions in society. Currently comprised of two personality traits (passive/aggressive), the different settings help determine whether or not a community will thrive.</p></br></br>
  <p>
    <ul>
      <li><h2>The personalities:</h2>
        <ul>
          <li><h4>Aggressive</h4>
            <ul>
              <li>Every subject for himself.</li>
              <li>All subjects target the nearest food.</li>
              <li>Even if there is a subject in front of him, the current subject will continue to try to get the same food.</li>
              <li>Aggressive behavior leads to packs being formed where the last in the packs generally die out.</li>
              <li>TODO: possibly add violence between subjects that inhibits them from focusing on their target</li>
            </ul>
          </li>
          <li><h4>Passive</h4>
            <ul>
              <li>Every subject has one target food that none other has.</li>
              <li>Subjects will not take food if it is being targeted.</li>
              <li>Results in groups being queued waiting for their turn for food but often die in the process</li>
              <li>TODO: intelligently determine best outcome for all subjects to work together</li>
            </ul>
          </li>
        </ul>
      </li>
      <li><h2>Future additions:</h2>
        <ul>
          <li><h4>Mixing Traits</h4>
            <ul>
              <li>Allow users to select various traits to be mixed.</li>
              <li>Brings the possibility for complex overall personalities.</li>
              <li>Significantly different outcomes allow for interesting (realistic?) interactions.</li>
            </ul>
          </li>
          <li><h4>Custom defined traits?</h4></li>
        </ul>
      </li>
    </ul>
  </p>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">

    <nav class="tab-bar" style="z-index:100;">
      <section class="middle tab-bar-section">
      <!-- left-off-canvas-toggle -->
        <h1 class="title" id="optionsMenuOpener" onclick="openSimMenu()">Simulation Options</h1>
      </section>
    </nav>

    <aside class="left-off-canvas-menu">
      <!-- OPTION MENU -->
      
        <div class="row" id="simulationOptions">
            <div class="large-12 columns selectionBox">
                    <h4> Subject Values </h4>
                    <hr>
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Pre-defined personality to apply to everyone in the population.">
                        Personality Types
                      </span>
                        <select id="personalitySelect">
                            <option value="aggressive">Aggressive</option>
                            <option value="passive">Passive</option>
                        </select>
                    </label><hr>

                  
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Number of frames before the subject dies.">
                        Lifespan</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="subLifespan" data-slider data-options="start: 10; end:200; display_selector: #subjectLifespan;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="subjectLifespan"></span>
                        </div>
                    </label><hr>
                  
                    
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Pixels moved per frame.">
                        Movement Speed</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="subMovementSpeed" data-slider data-options="start: 2; end:50; display_selector: #subjectMovementSpeed;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="subjectMovementSpeed"></span>
                        </div>
                    </label><hr>
                    
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Degrees turned per frame.">
                        Rotation Speed</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="subRotationSpeed" data-slider data-options="start: 1; end:10; display_selector: #subjectRotationSpeed;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="subjectRotationSpeed"></span>
                        </div>
                    </label><hr>
            </div>
        </div>
        <div class="row" id="simulationOptions">
            <div class="large-12 columns selectionBox">
                    <h4> Sustenance Values </h4>
                    <hr>

                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Pieces of food spawn per frame.">
                        Spawn Rate</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="fdSpawnRate" data-slider data-options="start: 1; end:20; display_selector: #foodSpawnRate;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="foodSpawnRate"></span>
                        </div>
                    </label><hr>
                    
                    <!--label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Minimum pixel distance between food spawns.">
                        Disperison</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" data-slider data-options="start: 1; end:50; display_selector: #foodDispersion;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="foodDispersion"></span>
                        </div>
                    </label><hr-->
                    
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Frames before food disappears.">
                        Lifespan</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="fdLifespan" data-slider data-options="start: 5; end:100; display_selector: #foodLifespan;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="foodLifespan"></span>
                        </div>
                    </label><hr>
            </div>
        </div>
        <div class="row" id="simulationOptions">
            <div class="large-12 columns selectionBox">
                    <h4> Population Values </h4>
                    <hr>

                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Population size before birth is disallowed.">
                        Population Limit</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="popLimit" data-slider data-options="start: 10; end:500; display_selector: #populationLimit;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="populationLimit"></span>
                        </div>
                    </label><hr>
                    
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Starting population size.">
                        Initial Population</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="popInit" data-slider data-options="start: 1; end:10; display_selector: #initialPopulation;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="initialPopulation"></span>
                        </div>
                    </label><hr>
                    
                    <label>
                      <span data-tooltip aria-haspopup="true" class="has-tip" title="Number of births per food use.">
                        Split Ratio</br>
                      </span>
                        <div class="small-10 columns">
                          <div class="range-slider round" id="popSplitRatio" data-slider data-options="start: 1; end:4; display_selector: #splitRatio;">
                            <span class="range-slider-handle" role="slider" tabindex="0"></span>
                            <span class="range-slider-active-segment"></span>
                          </div>
                        </div>
                        <div class="small-2 columns">
                          <span id="splitRatio"></span>
                        </div>
                    </label><hr>
            </div>
        </div>
      
      <!-- END OPTION MENU -->
    </aside>

    <section class="main-section">
      <!-- MAIN SIMULATION CONTENT -->
      <div>
        <div class="row">
          <div class="large-6 large-offset-3 columns">
              <a class="button expand" id="simStartBtn" onclick="startSimulation();">Run Simulation</a>
              <div class="row" id="runningOptions" style="display:none;">
                <div class="large-6 columns">
                  <a class="button expand" id="simStopBtn" onclick ="stopSimulation();">Stop Simulation</a>
                </div>
                <div class="large-6 columns">
                  <a class="button expand" id="simPauseBtn" onclick ="pauseSimulation();">Pause Simulation</a>
                </div>
              </div>
          </div>
        </div>

        <div class="row" style="padding-top:10px;">
            <div class="large-12 columns" id="canvasContainer">
          
                <canvas class="theBoard" id="board">
                  
                <script type="text/javascript" src="/MAINcrdavid/projects/theSocialAIExperiment/js/theCanvas.js"></script>
                <script type="text/javascript" src="/MAINcrdavid/projects/theSocialAIExperiment/js/entity.js"></script>
                <script type="text/javascript" src="/MAINcrdavid/projects/theSocialAIExperiment/js/theSubject.js"></script>
                <script type="text/javascript" src="/MAINcrdavid/projects/theSocialAIExperiment/js/theFood.js"></script>
                
          
            </div>
        </div>

        <div class="row">
          <div class="large-12 columns">
              <textarea id="eventInformation" cols="200" rows="30" readonly="readonly"></textarea>
          </div>
        </div>
      </div>
      <!-- END MAIN SIMULATION CONTENT -->
    </section>

    <a class="exit-off-canvas"></a>

  </div>
</div>

<div class="separator"></div>


<script>
  
  var theExperiment = undefined;
  
  $(function() {
    $(document).foundation('reflow');
    theExperiment = new Simulation();

    initLibrary(); // For color hue changing

  });
  
  function openSimMenu(){
    $(".off-canvas-wrap").foundation("offcanvas", "toggle", "move-right");
    setTimeout(function(){
        $(document).foundation('slider', 'reflow');
    }, 1000);
  }

  function startSimulation(){
    //$('html,body').animate({scrollTop:$("#canvasContainer").offset().top}, 500);
    
    if(theExperiment == undefined){
      theExperiment = new Simulation();
    }
    // Make sure we have the most recent settings
    theExperiment.settings = new GameSettings();
    
    theExperiment.start();
    
    $("#simStartBtn").hide();
    $("#runningOptions").show();
  }
  
  function stopSimulation(){
    $("#runningOptions").hide();
    $("#simStartBtn").show();
    
    theExperiment.stop();
    delete theExperiment;
    theExperiment = undefined;
  }
  
  function pauseSimulation(){
    if($("#simPauseBtn").text() == "Pause Simulation"){
      $("#simPauseBtn").text("Unpause Simulation");
      
      theExperiment.pause();
      
    }else if($("#simPauseBtn").text() == "Unpause Simulation"){
      $("#simPauseBtn").text("Pause Simulation");
    
      theExperiment.unpause();
    
    }
  }
  
  



  function closeAlert(){
    $("#infoAlert").toggle(500);
  }
  function showModal(id){
    $(id).foundation('reveal','open');
  }


</script>




<?include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/footer.php");?>