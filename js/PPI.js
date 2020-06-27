var network = [];
var interval;

window.requestAnimFrame = (function(){
      return  window.requestAnimationFrame       || 
              window.webkitRequestAnimationFrame || 
              window.mozRequestAnimationFrame    || 
              window.oRequestAnimationFrame      || 
              window.msRequestAnimationFrame     || 
        function( callback ){
            window.setTimeout(callback, 1000 / 60);
        };
})();

window.cancelRequestAnimFrame = ( function() {
    return window.cancelAnimationFrame          ||
        window.webkitCancelRequestAnimationFrame    ||
        window.mozCancelRequestAnimationFrame       ||
        window.oCancelRequestAnimationFrame     ||
        window.msCancelRequestAnimationFrame        ||
        clearTimeout
} )();

function nodeAttr(index,neighbors) {
    this.index=index;
    this.neighbors=neighbors;
    this.color="rgb("+Math.floor(255*Math.random())+","+Math.floor(255*Math.random())+","+Math.floor(255*Math.random())+")";
    this.x=344*Math.random();
    this.y=500*Math.random();
    this.vx=0.0;
    this.vy=0.0;
    this.fx=0.0;
    this.fy=0.0;
    this.size=0;
}

function draw(network) {
    var canvas = document.getElementById('PPI_canvas');
    var div = document.getElementById('splash-left');
    var i,j = 0;
    canvas.height = div.offsetHeight;
    canvas.width  = div.offsetWidth;
    if (canvas.getContext){
    	var ctx = canvas.getContext('2d');
    	ctx.scale(2, 2);
    	ctx.translate(-canvas.width / 4, -canvas.height / 4);
    	ctx.globalCompositeOperation = 'source-over';
    	ctx.strokeStyle="#56A0D3";
    	ctx.lineWidth = .5;
	ctx.globalAlpha = 1.0;
    	for (i=0; i<network.length; i++) {
    	    nodei = network[i];
	    ctx.fillStyle=nodei.color;
	    ctx.beginPath();
	    ctx.arc(nodei.x, nodei.y, nodei.size, 0, 2*Math.PI, false);
	    ctx.closePath();
	    ctx.fill()
	}
	ctx.globalCompositeOperation = 'destination-over';
	ctx.globalAlpha = 0.4;
	for (i=0; i<network.length;i++) {
	    nodei = network[i];
	    for (j=0; j<nodei.neighbors.length; j++) {
		ctx.beginPath();
		ctx.moveTo(nodei.x, nodei.y);
		ctx.lineTo(network[nodei.neighbors[j]].x, network[nodei.neighbors[j]].y);
		ctx.stroke();
	    }
	}
    }
}

function springEmbeddedStep(network,init) {
    var timestep = 2;
    var damping = .2;
    var k = -.01;
    var coul = 2;
    var totalKineticEnergy = 1000.0;
    var nodei, nodej;
    var dx, dy;
    var i,j
    for (i=0; i<network.length; i++) {
	network[i].fx=0.0;
	network[i].fy=0.0;
    }
    
    if (init == 0) {
	timestep = 1;
	for (i=0; i<network.length; i++) {
	    nodei = network[i];
	    for (j=i+1; j<network.length; j++) {
		nodej = network[j];
		dx = nodei.x-nodej.x;
		dy = nodei.y-nodej.y;
		r2 = (dx*dx)+(dy*dy)*coul;
		x = dx/r2;
		y = dy/r2;
		nodei.fx += x;
		nodei.fy += y;
		nodej.fx -= x;
		nodej.fy -= y;
	    }
	}
    }
    for (i=0; i<network.length; i++) {
	nodei = network[i];
	
	for (j=0; j<nodei.neighbors.length; j++) {
	    j_index = nodei.neighbors[j];
	    nodej = network[j_index];
	    x = (nodei.x-nodej.x)*k;
	    y = (nodei.y-nodej.y)*k;
	    nodei.fx += x;
	    nodei.fy += y;
	    nodej.fx -= x;
	    nodej.fy -= y;
	}
    }
    
    for (i=0; i<network.length; i++) {
	nodei = network[i];
	nodei.vx = (nodei.vx + timestep * nodei.fx) * damping;
	nodei.vy = (nodei.vy + timestep * nodei.fy) * damping;
	nodei.x += timestep * nodei.vx;
	nodei.y += timestep * nodei.vy;
    }
    
}

function drawStep() {
    springEmbeddedStep(network,0);
    draw(network);
}

window.onload = function() {
    loadWorkflow();
    var i,j;
    var numNodes = 300;
    var node0 = new nodeAttr(0,[1]);
    var node1 = new nodeAttr(1,[0]);
    var numEdges = 0;
    network.push(node0);
    network.push(node1);
    
    //Barabasi-Albert simulation of scale free network
    for (i=2; i<numNodes; i++) {
	var nodei = new nodeAttr(i,[])
	numEdges = 0.0;
	for (j=0; j<network.length; j++) {
	    numEdges += network[j].neighbors.length;
	}
	for (j=0; j<network.length; j++) {
	    p = .5*network[j].neighbors.length/numEdges;
	    ran = Math.random();
	    if (ran < p) {
		network[j].neighbors.push(i);
		nodei.neighbors.push(j);
	    }
	}
	if (nodei.neighbors.length > 0) {
	    network.push(nodei);
	} else {
	    i--;
	}
	
    }
    
    //Clean up to have one edge between nodes instead of two
    //Set size relative to the node's degree
    for (i=0; i<network.length; i++) {
		nodei = network[i];
		nodei.neighbors.sort(function(a,b) {return a<b});
		nodei.size = 1.5+((nodei.neighbors.length/Number(numNodes))*40);
		for (j=nodei.neighbors.length-1; j>=0; j--) {
			if (nodei.neighbors[j]<i) {
				nodei.neighbors.pop();
			} else {
				break;
			}
	}
	
    }
    
    for (i=0;i<5;i++) { 
	springEmbeddedStep(network,1);
    }
    draw(network);

	interval = setInterval(drawStep, 1000/40);

}