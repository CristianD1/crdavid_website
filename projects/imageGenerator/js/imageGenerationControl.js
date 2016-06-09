function Tree(position, scale, branches){
  this.position = position;
  this.scale = scale;

  // draw the tree
  var trunk = new paper.Path.Rectangle(position, pnt(position.x, Math.random()*position.x+scale));
  trunk.fillColor = 'black';

  trunk.draw();

  var branches = [];



}

function Branch(startPos, endPos, scale){
  this.startPos = startPos;
  this.endPos = endPos;
  this.scale = scale;

  this.draw = function(){
    // Draw the branch
    var path = new paper.Path;
    path.strokeColor = 'black';
    path.moveTo(startPos);
    path.lineTo(endPos);

    // Draw the branch bush
    var bush = new paper.Path.Circle({
      center: endPos,
      radius: scale,
      fillColor: 'green'
    });
  }
}




/* ---- RANDOM HELPERS ---- */
function rnd(rS, rE){
  return Math.round(Math.random()*rS+rE);
}
function pnt(x, y){
  return new paper.Point(x, y);
}  