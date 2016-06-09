
function display(image){
	canvas.height = canvas.width * image.height/image.width;

	ctx.drawImage(image, 0, 0, canvas.width, canvas.width * image.height/image.width);
	ctx.save();

	imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
	pixels = imageData.data;

	numPixels = imageData.width * imageData.height;
}

function showPixelColor(e){
	$(pixelDisplay).css('left', (e.pageX+5)+"px");
	$(pixelDisplay).css('top', (e.pageY-20)+"px");

  	var canvasOffset = $(canvas).offset();
  	var canvasX = Math.floor(e.pageX-canvasOffset.left);
  	var canvasY = Math.floor(e.pageY-canvasOffset.top);
   
  	var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  	var pixels = imageData.data;
  	var pixelRedIndex = ((canvasY - 1) * (imageData.width * 4)) + ((canvasX - 1) * 4);
  	var pixelcolor = "rgba("+pixels[pixelRedIndex]+", "+pixels[pixelRedIndex+1]+", "+pixels[pixelRedIndex+2]+", "+pixels[pixelRedIndex+3]+")";
   
  	$(pixelDisplay+" > .pixelHoverColor").css("background-color", pixelcolor);
  	$(pixelDisplay+" > .colorInfo").html(pixelcolor);
}


function imageBrightness(brightVal){
	pixels.set(backImgData.data);

	brightVal = brightVal/10;

	for (var i = 0; i < numPixels; i++) {
	    pixels[i*4] = pixels[i*4]*brightVal; // Red
	    pixels[i*4+1] = pixels[i*4+1]*brightVal; // Green
	    pixels[i*4+2] = pixels[i*4+2]*brightVal; // Blue
	}
	imageData.data.set(pixels);

	ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.putImageData(imageData, 0, 0);
}

function imageTint(r, g, b){
	pixels.set(backImgData.data);

	for (var i = 0; i < numPixels; i++) {
      	var average = parseInt((11*pixels[i*4] + 16*pixels[i*4+1] + 5*pixels[i*4+2]) / 32);
      	// set red green and blue pixels to the average value
      	pixels[i*4] = average + r;
      	pixels[i*4+1] = average + g;
      	pixels[i*4+2] = average + b;
  	}

  	imageData.data.set(pixels);
  	ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.putImageData(imageData, 0, 0);

}

function imageSepia(){
	for (var i = 0; i < numPixels; i++) {
	    pixels[i*4] = 255-pixels[i*4]; // Red
	    pixels[i*4+1] = 255-pixels[i*4+1]; // Green
	    pixels[i*4+2] = 255-pixels[i*4+2]; // Blue
	};
	imageData.data = pixels;

	ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.putImageData(imageData, 0, 0);
}

function cannyEdgeDetection(blur){

	pixels.set(backImgData.data);

	// First we apply grayscale with no tints
	imageTint(0, 0, 0);

	// Apply gaussian blur to eliminate noise (higher radius for less detailed edge detection)
	gaussianBlur(blur);

	// Find the intensity gradient of the image
	sobelGradient();

}

function sobelGradient(){
	// This method was developed with the help of the wikipedia article:
	//		https://en.wikipedia.org/wiki/Sobel_operator

	var sobel = [];

	var w = imageData.width;
	var h = imageData.height;

	var Kx = [[-1,0,1],[-2,0,2],[-1,0,1]];
	var Ky = [[-1,0,1],[-2,0,2],[-1,0,1]];

	function pixelDataPos(pix){
		return function(y, x){
			return pix[((w * y ) + x) * 4];
		}
	}

	pixMult = pixelDataPos(pixels);

	for (x = 0; x < h; x++) {
      	for (y = 0; y < w; y++) {
			// https://en.wikipedia.org/wiki/Kernel_(image_processing)#Convolution

			// gradient approximations
			var Gx = (
		            (Kx[0][0] * pixMult(x - 1, y - 1)) +
		            (Kx[0][1] * pixMult(x, y - 1)) +
		            (Kx[0][2] * pixMult(x + 1, y - 1)) +

		            (Kx[1][0] * pixMult(x - 1, y)) +
		            (Kx[1][1] * pixMult(x, y)) +
		            (Kx[1][2] * pixMult(x + 1, y)) +

		            (Kx[2][0] * pixMult(x - 1, y + 1)) +
		            (Kx[2][1] * pixMult(x, y + 1)) +
		            (Kx[2][2] * pixMult(x + 1, y + 1))
		        );

	        var Gy = (
			        (Ky[0][0] * pixMult(x - 1, y - 1)) +
			        (Ky[0][1] * pixMult(x, y - 1)) +
			        (Ky[0][2] * pixMult(x + 1, y - 1)) +

			        (Ky[1][0] * pixMult(x - 1, y)) +
			        (Ky[1][1] * pixMult(x, y)) +
			        (Ky[1][2] * pixMult(x + 1, y)) +

			        (Ky[2][0] * pixMult(x - 1, y + 1)) +
			        (Ky[2][1] * pixMult(x, y + 1)) +
			        (Ky[2][2] * pixMult(x + 1, y + 1))
		        );

			// gradient magnitude
			var G = Math.sqrt( Math.pow(Gx, 2) + Math.pow(Gy, 2) )>>0;
			sobel.push(G, G, G, 255);
		}
	}

	// Make sobel data compatible with canvas
	var clampedSobel = new Uint8ClampedArray(sobel);

	imageData.data.set(clampedSobel);
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.putImageData(imageData, 0, 0);

}

/* DEALING WITH BLUR: Credit for O(n) solution goes to http://blog.ivank.net/fastest-gaussian-blur.html */
function gaussianBlur(r){
	if(r != 0){
		// Apply Gauss Blur
		var rArr = [];
		var gArr = [];
		var bArr = [];
		for(var i = 0; i < numPixels; i++){
			rArr.push(pixels[i*4]);
			gArr.push(pixels[i*4+1]);
			bArr.push(pixels[i*4+2]);
		}
		runBlur(rArr, rArr, imageData.width, imageData.height, r);
		runBlur(gArr, gArr, imageData.width, imageData.height, r);
		runBlur(bArr, bArr, imageData.width, imageData.height, r);
		for(var i = 0; i < numPixels; i++){
			pixels[i*4] = rArr[i];
			pixels[i*4+1] = gArr[i];
			pixels[i*4+2] = bArr[i];
		}
	}
	imageData.data.set(pixels);
  	ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.putImageData(imageData, 0, 0);
}

function runBlur (scl, tcl, w, h, r) {
    var bxs = gaussBoxes(r, 3);
    boxBlur (scl, tcl, w, h, (bxs[0]-1)/2);
    boxBlur (tcl, scl, w, h, (bxs[1]-1)/2);
    boxBlur (scl, tcl, w, h, (bxs[2]-1)/2);
}
function boxBlur (scl, tcl, w, h, r) {
    for(var i=0; i<scl.length; i++) tcl[i] = scl[i];
    boxBlurH(tcl, scl, w, h, r);
    boxBlurT(scl, tcl, w, h, r);
}
function boxBlurH (scl, tcl, w, h, r) {
    var iarr = 1 / (r+r+1);
    for(var i=0; i<h; i++) {
        var ti = i*w, li = ti, ri = ti+r;
        var fv = scl[ti], lv = scl[ti+w-1], val = (r+1)*fv;
        for(var j=0; j<r; j++) val += scl[ti+j];
        for(var j=0  ; j<=r ; j++) { val += scl[ri++] - fv       ;   tcl[ti++] = Math.round(val*iarr); }
        for(var j=r+1; j<w-r; j++) { val += scl[ri++] - scl[li++];   tcl[ti++] = Math.round(val*iarr); }
        for(var j=w-r; j<w  ; j++) { val += lv        - scl[li++];   tcl[ti++] = Math.round(val*iarr); }
    }
}
function boxBlurT (scl, tcl, w, h, r) {
    var iarr = 1 / (r+r+1);
    for(var i=0; i<w; i++) {
        var ti = i, li = ti, ri = ti+r*w;
        var fv = scl[ti], lv = scl[ti+w*(h-1)], val = (r+1)*fv;
        for(var j=0; j<r; j++) val += scl[ti+j*w];
        for(var j=0  ; j<=r ; j++) { val += scl[ri] - fv     ;  tcl[ti] = Math.round(val*iarr);  ri+=w; ti+=w; }
        for(var j=r+1; j<h-r; j++) { val += scl[ri] - scl[li];  tcl[ti] = Math.round(val*iarr);  li+=w; ri+=w; ti+=w; }
        for(var j=h-r; j<h  ; j++) { val += lv      - scl[li];  tcl[ti] = Math.round(val*iarr);  li+=w; ti+=w; }
    }
}
function gaussBoxes(sigma, n)  // standard deviation, number of boxes
{
    var wIdeal = Math.sqrt((12*sigma*sigma/n)+1);  // Ideal averaging filter width 
    var wl = Math.floor(wIdeal);  if(wl%2==0) wl--;
    var wu = wl+2;
    var mIdeal = (12*sigma*sigma - n*wl*wl - 4*n*wl - 3*n)/(-4*wl - 4);
    var m = Math.round(mIdeal);
    // var sigmaActual = Math.sqrt( (m*wl*wl + (n-m)*wu*wu - n)/12 );
    var sizes = [];  for(var i=0; i<n; i++) sizes.push(i<m?wl:wu);
    return sizes;
}
/* End Blur functions */


