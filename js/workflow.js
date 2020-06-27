
var workflow_interval;
var timestep;
var direction;
var max_steps = 80.0;

function translate(start,end) {
    return start + ((end-start)*(Math.min(timestep,max_steps*.9)/max_steps));
}

function drawWorkflow() {
    var canvas = document.getElementById('workflow_canvas');
    var div = document.getElementById('splash-center');
    canvas.height = div.offsetHeight;
    canvas.width  = div.offsetWidth;
    if (canvas.getContext){
        var ctx = canvas.getContext('2d');
        ctx.globalCompositeOperation = 'lighter';

        // Draw 3 circles at proper positions
        // Draw 4 labels at proper positions and opacity
        ctx.fillStyle="#56A0D3";
        ctx.beginPath();
        ctx.arc(translate(95,170),translate(125,250),75,0,2*Math.PI,false);
        ctx.closePath();
        ctx.fill();
        ctx.stroke();

        ctx.fillStyle="#6BB635";
        ctx.beginPath();
        ctx.arc(translate(255,170),translate(250,250),75,0,2*Math.PI,false);
        ctx.closePath();
        ctx.fill();
        ctx.stroke();

        ctx.fillStyle="#BD0A0A";
        ctx.beginPath();
        ctx.arc(translate(95,170),translate(355,250),75,0,2*Math.PI,false);
        ctx.closePath();
        ctx.fill();
        ctx.stroke();


        ctx.globalCompositeOperation = 'source-over';
        ctx.fillStyle="rgba(255, 255, 255, "+String(translate(1,0))+")";
        ctx.font = "20px Calibri";
        ctx.fillText("Functional", translate(52,127), translate(123,248));
        ctx.fillText("Screening",translate(54,129), translate(141,266));
        ctx.fillText("Proteomics", translate(212,127), translate(255,255));
        ctx.fillText("Disease", translate(65,140), translate(360,255));

        ctx.fillStyle="rgba(0, 0, 0, "+String(translate(-1,1))+")";
        ctx.fillText("Integration",125,255);
    }
}

function drawWorkflowStep() {
    timestep += direction;
    if (timestep < 0 || timestep > max_steps) clearInterval(workflow_interval);
    drawWorkflow();
    // alert(timestep);
}

function loadWorkflow() {
    timestep = 0;
    direction = 1;
    drawWorkflow();

    document.getElementById('workflow_canvas').onmouseover = function() {
        direction = 1;
//        cancelRequestAnimFrame(workflow_interval);
        timestep = Math.max(0,timestep);
        /*	(function animloopWorkflow(){
                drawWorkflowStep();
                alert("forward" + String(timestep));
                if (timestep >= 0 && timestep <= max_steps) workflow_interval = requestAnimFrame(animloopWorkflow);
            })();*/
        clearInterval(workflow_interval);
        workflow_interval = setInterval(drawWorkflowStep, 1000 / 60);
    }
    document.getElementById('workflow_canvas').onmouseout = function() {
        direction = -1;
//        cancelRequestAnimFrame(workflow_interval);
        clearInterval(workflow_interval);
        timestep = Math.min(max_steps*.9,timestep);
        /*	(function animloopWorkflowRev(){
                drawWorkflowStep();
                alert("rev" + String(timestep));
                if (timestep >= 0 && timestep <= max_steps) workflow_interval = requestAnimFrame(animloopWorkflowRev);
            })();*/
        workflow_interval = setInterval(drawWorkflowStep, 1000 / 60)
    }

}