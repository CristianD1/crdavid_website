<?php
  $title = "Cristian David - CS major";
  $description = "My Stories";
  $keywords = "";
  $tabLocation = "stories";
  include("HeaderFooter/header.php");
?>

<div class="separator"></div>

<div class="row">
  <div class="large-12 columns" align="center">
    <div id="flipbook">
      <div class="hard frontBookCover"></div> <!-- Front cover -->
      <div class="hard leftPage"></div> <!-- inside front -->
      <div class="rightPage"> <!-- right page (INDEX) -->
        <?php
          include("pages/page3.php");
        ?>
      </div>
      <div class="leftPage">
        <?php
          include("pages/page4.php");
        ?>
        <div class="row clickablePosition">
          <div class="large-12 columns">
            <button class = "large-10 columns clickableIndex indexReturn">
              Index...
            </button>
          </div>
        </div>
      </div> <!-- left page -->
      <div class="rightPage">
        <?php
          include("pages/page5.php");
        ?>
      </div> <!-- right page -->
      <div class="leftPage">
        <?php
          include("pages/page6.php");
        ?>
        <div class="row clickablePosition">
          <div class="large-12 columns">
            <button class = "large-10 columns clickableIndex indexReturn">
              Index...
            </button>
          </div>
        </div>
      </div> <!-- left page -->
      <!-- BEGINNING OF CARING HANDS STORY -->
          <div class="rightPage">
            <?php
              include("pages/page7.php");
            ?>
          </div> <!-- right page -->
          <div class="leftPage">
            <?php
              include("pages/page8.php");
            ?>
            <div class="row clickablePosition">
              <div class="large-12 columns">
                <button class = "large-10 columns clickableIndex indexReturn">
                  Index...
                </button>
              </div>
            </div>
          </div> <!-- left page -->
          <div class="rightPage">
            <?php
              include("pages/page9.php");
            ?>
          </div> <!-- right page -->
          <div class="leftPage">
            <?php
              include("pages/page10.php");
            ?>
            <div class="row clickablePosition">
              <div class="large-12 columns">
                <button class = "large-10 columns clickableIndex indexReturn">
                  Index...
                </button>
              </div>
            </div>
          </div> <!-- left page -->
          <div class="rightPage">
            <?php
              include("pages/page11.php");
            ?>
          </div> <!-- right page -->
          <div class="leftPage">
            <?php
              include("pages/page12.php");
            ?>
            <div class="row clickablePosition">
              <div class="large-12 columns">
                <button class = "large-10 columns clickableIndex indexReturn">
                  Index...
                </button>
              </div>
            </div>
          </div> <!-- left page -->
          <div class="rightPage">
            <?php
              include("pages/page13.php");
            ?>
          </div> <!-- right page -->
          <div class="leftPage">
            <?php
              include("pages/page14.php");
            ?>
            <div class="row clickablePosition">
              <div class="large-12 columns">
                <button class = "large-10 columns clickableIndex indexReturn">
                  Index...
                </button>
              </div>
            </div>
          </div> <!-- left page -->
      <!-- END OF CARING HANDS STORY -->
      <div class="hard rightPage"></div> <!-- right page -->
      <div class="hard backBookCover"></div> <!-- back cover -->
    </div>
  </div>
</div>

<div class="row">
  <div class="large-12 columns center" style="align:center">
    <button id="prevBtn">Previous Page</button>
    <button id="nextBtn">Next Page</button>
  </div>
</div>

<?php include("HeaderFooter/footer.php"); ?>

<script type="text/javascript">

  $("#flipbook").turn({
    width: 900,
    height: 700,
    autoCenter: true
  });

  $(document).ready(function(){
    $('#nextBtn').click(function(){
      $("#flipbook").turn("next");
    });
    $('#prevBtn').click(function(){
      $("#flipbook").turn("previous");
    });

    $("#flipbook").bind("turned", function(event, page, view) {
      $(".pageNum4").click(function(){
        $("#flipbook").turn("page", 4);
      });
      $(".pageNum5").click(function(){
        $("#flipbook").turn("page", 5);
      });
      $(".pageNum6").click(function(){
        $("#flipbook").turn("page", 6);
      });
      $(".pageNum7").click(function(){
        $("#flipbook").turn("page", 7);
      });

      $(".indexReturn").click(function(){
        $("#flipbook").turn("page", 3);
      });
    });
  });
</script>
