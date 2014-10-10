'use strict';
var rowChart1 = dc.rowChart("#row-chart-1");
var boxChart1 = dc.boxPlot("#box-chart-1");

d3.json("http://cancer.unc.edu/majorlab/members/ms/qualityControlQuery.php",function(error,data) {
	var dateFormat = d3.time.format("%m/%d/%Y");

	for (var i = 0; i < data.length; i++) {
	    for (var prop in data[i]) {
		if (data[i].hasOwnProperty(prop)) {
		    if (prop == "filename") {

		    } else if (prop == "CreatedTime" || prop == "UpdatedTime") {
			data[i][prop] = dateFormat.parse(data[i][prop]);
		    } else {
			data[i][prop] = +data[i][prop]
		    }
		}
	    }
	}
	
	var ndx = crossfilter(data);
	var all = ndx.groupAll();
	
	var dim_XIC_WideFrac = ndx.dimension(function (d) { return Math.round(d.XIC_WideFrac*2)/2; });
	var group_XIC_WideFrac = dim_XIC_WideFrac.group();

	var dim_1 = ndx.dimension(function (d) { return ""; });
	var group_1 = dim_1.group()
	    .reduce(
		    function(p,v) {
			p.push(v.XIC_WideFrac);
			return p;
		    },
		    function(p,v) {
			p.splice(p.indexOf(v.XIC_WideFrac), 1);
			return p;
		    },
		    function() {
			return [];
		    }
		    );
	
	
	rowChart1
	    .width(100)
	    .height(150)
	    .margins({top: 20, left: 15, right: 15, bottom: 20})
	    .group(group_XIC_WideFrac)
	    .dimension(dim_XIC_WideFrac)
	    .gap(1)
	    .renderLabel(false)
	    .transitionDuration(1500)
	    .xAxis().ticks(3);

	boxChart1
	    .width(150)
	    .height(150)
            .margins({top: 20, left: 30, right: 30, bottom: 20})
            .group(group_1)
            .dimension(dim_1)
	    .y(d3.scale.ordinal().domain([-5,2]))
	    //.elasticX(true)
	    //.elasticY(true)
	    

	dc.renderAll();
    });
