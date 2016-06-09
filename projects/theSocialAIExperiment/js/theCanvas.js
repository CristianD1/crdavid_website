/* --------- Entity Storage --------- */
var subjectList = [];
var foodList = [];

/* --------- Screen settings --------- */
var canvas;
var canvasHeight = $(window).height()*0.75;
var canvasWidth = $("#canvasContainer").width()-10;

canvas = document.querySelector('canvas#board');
canvas.setAttribute('width', canvasWidth);
canvas.setAttribute('height', canvasHeight);

var surface = canvas.getContext('2d');

var eventDisplay = "#eventInformation";
var eventString = "";

function GameSettings(){
    
    /* --------- Population settings --------- */
    this.populationLimit = $("#popLimit").attr("data-slider");
    this.startingPopulation = $("#popInit").attr("data-slider");
    this.splitRatio = $("#popSplitRatio").attr("data-slider");
    
    /* --------- Sustenance Settings --------- */
    this.foodSpawnRate = $("#fdSpawnRate").attr("data-slider"); // Food spawned per frame
    //this.foodDispersion = $("#foodDispersion").html(); // Minimum distance apart
    this.foodLifespan = $("#fdLifespan").attr("data-slider"); // Frames until food disappears
    
    /* --------- Subject Settings --------- */
    this.personality = $("#personalitySelect").val();
    this.lifespan = $("#subLifespan").attr("data-slider"); // Frames until death
    this.movementSpeed = $("#subMovementSpeed").attr("data-slider"); // Pixels per frame
    this.rotationalSpeed = $("#subRotationSpeed").attr("data-slider");
}

function Simulation(){

    // Initialize Game Settings
    this.settings = new GameSettings();
    
    this.ONE_FRAME_TIME = 1000 / 6 ;
    
    this.currentPopulation = this.settings.startingPopulation;
    
    this.paused = true;
    this.running = true;
    this.interval = null;
 
    
    this.start = function(){
        // Create initial population
        for(var i = 0; i < this.settings.startingPopulation; ++i){
            subjectList.push( new Subject(this.settings, Math.round(Math.random() * 100), Math.round(Math.random() * 100), Math.round(Math.random() * 2 * Math.PI)) );
        }
        
        for(var i = 0; i < this.settings.startingPopulation; ++i){
            
            var tX = Math.round(Math.random() * canvasWidth);
            var tY = Math.round(Math.random() * canvasHeight);
            
            foodList.push( new Food(tX, tY, 0) );
        }
        
        this.run();
    };
    
    this.run = function() {
        if (this.paused && this.running) {
            this.paused = false;
            
            var self = this;
            this.interval = setInterval( function() { self.runFrame(self) }, this.ONE_FRAME_TIME );
        }
    };
    
    this.runFrame = function(self) {
        self.draw(self, surface);
        
        self.update(self);
    };
    
    this.pause = function(){
        if(this.interval != null) {
            
            clearInterval(this.interval);
            
            this.paused = true;
            
        }
    };
    
    this.unpause = function(){
        this.run();
    };
    
    this.stop = function(){
        if (this.interval != null) {
            
            clearInterval(this.interval);
            
            this.running = false;
            
            this.currentPopulation = 0;
            
            // reset sim globals and board
            subjectList = [];
            foodList = [];
            eventString = "";
            surface.clearRect(0, 0, canvas.width, canvas.height);
            displayEventOutput("NONE");
        }
    };
    
    this.update = function(self){
        var deathList = [];
        var decayList = [];
        
        var subLen = subjectList.length;
        var foodLen = foodList.length;
        
        /* DEAL WITH FOOD EVENTS */
        for(var i = 0; i < foodLen; ++i){
            eventString = foodList[i].update(self.settings.foodLifespan);

            if(eventString == "dead"){
                decayList.push(i);

                //displayEventOutput("Food has decayed, food remaining: " + foodLen);
            }
        }

        for (var i = 0; i < decayList.length; ++i) {
           var index = decayList[i] - i;
           
           foodList.splice(index, 1);
        }
        /* END FOOD EVENTS */

        /* DEAL WITH SUBJECT EVENTS */
        for(var i = 0; i < subLen; ++i){
            eventString = subjectList[i].update(self.settings.lifespan);
            
            if(eventString == "dead"){
                deathList.push(i);
                
                displayEventOutput("Subject death occured, population: " + subLen);
            }else if(subLen < this.settings.populationLimit && eventString == "split"){
                for(var x = 0; x < this.settings.splitRatio; ++x){
                    if(subLen < this.settings.populationLimit){
                        subjectList.push( new Subject(this.settings, subjectList[i].pos.x, subjectList[i].pos.y, Math.round(Math.random() * 2 * Math.PI)) );
                    }
                }
                displayEventOutput("Subject birth occured, population: " + subLen);
            }else if(eventString == "foodless"){
                displayEventOutput("No food left.")
            }
        }
        
        for (var i = 0; i < deathList.length; ++i) {
           var index = deathList[i] - i;
           
           subjectList.splice(index, 1);
        }
        /* END SUBJECT EVENTS */

        var spawnFood = Math.round(Math.random() * 2);
        
        if( spawnFood == 2 ){
            for(var i = 0; i < this.settings.foodSpawnRate; ++i){
                var tX = Math.round(Math.random() * canvasWidth);
                var tY = Math.round(Math.random() * canvasHeight);
                
                foodList.push( new Food(tX, tY, 0) );
            }
        }
        
    };
    
    this.draw = function(self, ctx){

        ctx.fillStyle = 'black';
        ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        
        for(var i = 0; i < subjectList.length; ++i){
            subjectList[i].draw(ctx);
        }
        
        for(var i = 0; i < foodList.length; ++i){
            foodList[i].draw(ctx);
        }
    };
    
}

function displayEventOutput(content){
    if(content == "NONE"){
        $(eventDisplay).val("");
    }else{
        if($(eventDisplay).val().length > 5000){
            $(eventDisplay).val("");
        }
        
        $(eventDisplay).val(content + "\n\n" + $(eventDisplay).val());
    }
}