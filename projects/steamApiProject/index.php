<?php
  $title = "Cristian David - CS major";
  $description = "My Projects";
  $keywords = "";
  $tabLocation = "projects";
  include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/header.php");
?>

<link rel="stylesheet" type="text/css" href="/MAINcrdavid/projects/steamApiProject/css/steamApiGeneral.css" />

<style>
.pageContent{
  border-top:1px solid #61b6d9;
  border-bottom:1px solid #61b6d9;
}
  
  
</style>

<div class="separator"></div>

<div class="row">
  <div class="medium-6 medium-offset-3 columns" id="constructionAlert">
    <div data-alert class="alert-box alert round">
      This is a project to demonstrate API calls. It will eventually be turned into a steam item market information display.
      <a class="close" onclick="closeAlert()">&times;</a>
    </div>
  </div>
</div>

<div class="row">
  <div class="medium-3 medium-offset-9 columns">
    <a onclick="mainMenu()" class="button info small" style="margin-bottom:0px;">Back To Main</a>
  </div>
</div>

<div class="row pageContent">
  <div class="medium-12 columns">
    
    <div class="row">
      <div class="medium-12 columns">
    
        <div class="row" id="formBoard">
          <div class="medium-12 columns">
            <fieldset>
              <div class="row collapse">
                <label><b>Enter your steam ID:</b></label>
                  <div class="medium-10 columns">
                    <input id="IDArea" type="text" placeholder="Your steam ID can be found under your profile -> Edit Profile -> Custom URL">
                  </div>
                  <div class="medium-2 columns">
                    <a onclick='findInfo()' class="button postfix">Go</a>
                  </div>
              </div>
              <p id="errorMsg" style="color:red; display:none;"></p>
            </fieldset>
          </div>
        </div>
        
        <div class="row" id="resultsBoard" >
          <div class="medium-12 columns">
            <div style="display:none">
              
            </div>
          </div>
        </div>
  
      </div>
    </div>
    
  </div>
</div>


<script>
  $(".se-pre-con").bind('ajaxStart', function(){
      $(this).show();
  }).bind('ajaxStop', function(){
      $(this).hide();
  });
  
  function closeAlert(){
    $("#constructionAlert").toggle(500);
  }
  function mainMenu(){
    $("#formBoard").show(500);
    $("#resultsBoard").hide(500);
  }
  
  
  
  
  function getCookie(name) {
      var dc = document.cookie;
      var prefix = name + "=";
      var begin = dc.indexOf("; " + prefix);
      if (begin == -1) {
          begin = dc.indexOf(prefix);
          if (begin != 0) return null;
      }
      else
      {
          begin += 2;
          var end = document.cookie.indexOf(";", begin);
          if (end == -1) {
          end = dc.length;
          }
      }
      return unescape(dc.substring(begin + prefix.length, end));
  } 
  
  
  var cookieExists = false;
  
  $(function() {
    var possibleCookie = getCookie("userID");
    if(possibleCookie){
      cookieExists = true;
      findInfo();
    }
  });
  
  
  function findInfo(){
    var userID = $("#IDArea").val();
    if(cookieExists && userID == ""){
      userID = getCookie("userID");
    }
    
    if(userID == ""){
      $("#errorMsg").show();
      $("#errorMsg").text("Please enter a userID. Go to your steam profile, find your custom URL, and enter the value found at: /ID/[this value]");
    }else{
      $(".se-pre-con").show();
      
      // Set cookie for next visit
      document.cookie="userID="+userID;
      
      $.ajax({
        url: '/MAINcrdavid/projects/steamApiProject/retrieveSummary.php',
        data: {id: userID},
        success: function(data){
          // Deal with hiding and showing proper content
          $("#resultsBoard").prop("innerHTML", data);
          $("#formBoard").hide(500);
          $("#resultsBoard").show(500);
          $(".se-pre-con").hide();
        },
        error: function(){
          alert(error);
        }
      });
    }
  }
</script>

<div class="separator"></div>

<?include($_SERVER['DOCUMENT_ROOT']."/MAINcrdavid/HeaderFooter/footer.php");?>