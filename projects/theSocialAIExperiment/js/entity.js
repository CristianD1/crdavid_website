// This file provides functionality for implementing canvas entities.

// Creates a position object with the coordinates (x, y)
function Posn(x, y) {
	this.x = x;
	this.y = y;
}

// Creates a shape with a size of size
// 		Take note that circles have radii so 
//		      x is radii and y is whatever you like.
// Shape: one of ("square", "circle")
function Shape(shape, x, y) {
	this.type = shape;
	this.radius = x;
	this.width = x;
	this.height = y;
}

// defines entity object at position x, y
function Entity(pos, dir, shape, color) {
	this.pos = pos;
	this.dir = dir;
	this.shape = shape;
	this.color = color;
	
	this.draw = function(ctx) {
		ctx.save();
		
		ctx.fillStyle = this.color;
		
		if (this.shape.type == "square") {
			var width = this.shape.width;
			var height = this.shape.height;
			
			ctx.translate(this.pos.x, this.pos.y);
			ctx.rotate(this.dir);
			ctx.fillRect(-width/2, -height/2, width, height);
		} else if (this.shape.type == "circle") {
			ctx.beginPath();
			ctx.arc(this.pos.x, this.pos.y, this.shape.radius, 0, Math.PI * 2, true);
		} else {
			console.log("I came here to have a good time and I feel personally attacked right now.");
		}
		
		ctx.fill();
		
		ctx.restore();
	}
}
