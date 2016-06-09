$(document).ready(function() {
    
  var leftPos = 0;
  var topPos = 0;
  var screenWidth = $(document).width();
  console.log(screenWidth);
  
  $('img').each(function(index, image){
    $(image).center(leftPos + 'px', topPos + 'px');
    
    leftPos += 100;
    if(leftPos >= screenWidth - 100){
      topPos += 100;
      leftPos = 0;
    }
  });
});

jQuery.fn.center = function (left, top) {
    this.css("z-index", "1000")
    this.css("position","fixed");
    this.css("min-width", "100px");
    this.css("min-height", "100px");
    this.css("max-width", "100px");
    this.css("max-height", "100px");
    //this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
    //                                            $(window).scrollTop()) + "px");
    //this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
    //                                            $(window).scrollLeft()) + "px");
    this.css("left", left);
    this.css("top", top);
    return this;
}

function deathSequence(object){
  $(object).animate({
      opacity: 0.25,
      left: "+=50",
      height: "toggle"
    }, 5000, function() {
      // Animation complete.
    });
}