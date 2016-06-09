
function Food(x, y, dir){
	
	this.lifeTimer = 0;

	this.beingTracked = false; // True if a subject is going after this food
	this.tracker = null;
	
	Entity.call(this, new Posn(x, y), dir, new Shape("circle", 2, 2), "red");
	

	this.update = function(totalLifespan){
		var currEvent = "";

		if(this.lifeTimer >= totalLifespan){
			// Food is decayed
			currEvent = "dead";
		}else{
			this.lifeTimer ++;
		}

		return currEvent;
	}

}

Subject.prototype = Object.create(Entity.prototype);