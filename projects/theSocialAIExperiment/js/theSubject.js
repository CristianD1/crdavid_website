

function Subject(gameSettings, x, y, dir){
    
	// Subject settings
	this.lifeTimer = 0;
	this.target = null; // Store the food we are going for

	// Subject specific game settings
	this.lifespan = gameSettings.lifespan;
	this.personality = gameSettings.personality;
	this.movementSpeed = gameSettings.movementSpeed;
    this.rotationalSpeed = gameSettings.rotationalSpeed;
	this.splitRatio = gameSettings.splitRatio;
	
	
	this.update = function(totalLifespan){
		var currEvent;
		
		this.color = surfacecurve.color("#FF0000").hue(this.lifespan - this.lifeTimer).hex6();

		if(this.lifeTimer >= this.lifespan){
			
			// Subject is dead
			
			currEvent = "dead";
				
		}else{
			
			// Determine update position based on personality
			//if( this.personality == "passive" ){
				
				
				
			//}else if( this.personality == "aggressive" ){
				
				this.target = this.nearestFoodPosn(this.pos, this.personality);
				
				// Change the subjects position and rotation
				
				if(this.target != null){
				
					if( findDist(this.pos, this.target.pos) <= Math.pow( this.movementSpeed, 2 ) ){
						if( this.closestSubject( this.pos, this.target.pos ) ){
							// The subject is closest to the food
							//		reset lifespan
							
							var tempFoodList = [];
							
							for( var i = 0; i < foodList.length; ++i ){
								
								if( foodList[i] == this.target ){
									delete foodList[i];
								}else{
									tempFoodList.push(foodList[i]);
								}
								
							}
							
							foodList = tempFoodList;
							tempFoodList = null;
							
							currEvent = "split";
							
							this.lifeTimer = 0;
						}
					}else{
						this.moveTowards(this.target.pos);
					}
					
				}else{
					currEvent = "foodless";
				}
	
			//}
			this.lifeTimer += 1;
		}
		
		return currEvent;
	}
	
	/* ----------- HELPERS ----------- */

	this.closestSubject = function(subPos, tarPos){
		
		var closest = true;
		
		var currDist = findDist(subPos, tarPos);
		
		for( var i = 0; i < subjectList.length; ++i ){
			if( findDist(subjectList[i].pos, tarPos) < currDist ){
				closest = false;
				break;
			}
		}
		
		return closest;
		
	}

	this.moveTowards = function(targetPos){
		
		var angle = Math.atan2(targetPos.y - this.pos.y, targetPos.x - this.pos.x);
		var delta = angle - this.dir;
		var delta_abs = Math.abs(delta);
	
		if (delta_abs > Math.PI) {
			delta = delta_abs - 2*(Math.PI);
		}
	
		if (delta !== 0) {
			var direction = delta / delta_abs;
			this.dir += (direction * Math.min(this.rotationalSpeed, delta_abs));
		}
		this.dir %= 2*(Math.PI);
	
		this.pos.x += Math.cos(this.dir) * this.movementSpeed;
		this.pos.y += Math.sin(this.dir) * this.movementSpeed;
		
	}
	
	this.nearestFoodPosn = function(currPos, personality){
		
		var chosenFood = 0;

		var dist = null;
		var res = null;
		
		var tar = new Posn(0, 0);
		
		for(var i = 0; i < foodList.length; ++i){
			
			if(personality == "passive"){

				if(foodList[i].beingTracked && foodList[i].tracker == this){
					chosenFood = i;
					res = foodList[i];
					break;
				}

				if(!foodList[i].beingTracked){

					tar.x = foodList[i].pos.x;
					tar.y = foodList[i].pos.y;
			
					var currDist = findDist(currPos, tar);
					
					if( dist == null || currDist < dist ){
						dist = currDist;
						res = foodList[i];
						chosenFood = i;
					}

				}

			}else{

				tar.x = foodList[i].pos.x;
				tar.y = foodList[i].pos.y;
		
				var currDist = findDist(currPos, tar);
				
				if( dist == null || currDist < dist ){
					dist = currDist;
					res = foodList[i];
				}

			}
	
		}

		if(foodList[chosenFood] != undefined){
			foodList[chosenFood].beingTracked = true;
			foodList[chosenFood].tracker = this;
		}
		
		return res;
		
	}
	
	Entity.call(this, new Posn(x, y), dir, new Shape("square", 10, 4), surfacecurve.color("#FF0000").hue(this.lifespan).hex6());
    
}

Subject.prototype = Object.create(Entity.prototype);


function findDist(start, end){
	return ( Math.pow(( end.x - start.x ), 2 ) + Math.pow(( end.y - start.y ), 2) );
}
