// chart
$.get("/statistik/getCategories").done(function(data) {
    data = JSON.parse(data);
    donut()
        .$el(d3.select("#chart"))
        .data(data['categories'])
        .render();
})

// maps
var width = 1150,
    height = 400,
    centered;

var projection = d3.geo.equirectangular()
    .scale(1250)
    .rotate([-120, 0])
    .translate([width / 2, height / 3]);

var path = d3.geo.path()
    .projection(projection);

var svg = d3.select("#map")
    .attr("width", width)
    .attr("height", height);

svg.append("rect")
    .attr("class", "background")
    .attr("width", width)
    .attr("height", height)
    .on("click", clicked);

var g = svg.append("g");

d3.json("/assets/js/scripts/indonesia.json", function(error, id) {
    if (error) throw error;

    $.get("/statistik/getStates").done(function(data) {
        data = JSON.parse(data);
        g.append("g")
            .attr("id", "subunits")
            .selectAll("path")
            .data(topojson.feature(id, id.objects.states_provinces).features)
            .enter().append("path")
            .attr("d", path)
            .on("click", clicked)
            .attr('fill', function(d) {
                if (data['states'].includes(d.properties.name)) {
                    return '#D8666B';
                }
            })
            .style("cursor", "pointer");

    })

    $.get("/statistik/getPoints").done(function(data) {
        data = JSON.parse(data);
        g.selectAll("circle")
            .data(data['coordinates'])
            .enter()
            .append("circle")
            .attr("transform", function(d) {
                return "translate(" + projection([
                    //coordinates should be passed longitude,latitude
                    d[0], d[1]
                ]) + ")"
            })
            .attr("r", 2)
            .style("fill", "blue");

    });

    g.append("path")
        .datum(topojson.mesh(id, id.objects.states_provinces, function(a, b) { return a !== b; }))
        .attr("id", "state-borders")
        .attr("d", path);
});


function clicked(d) {
    var x, y, k;

    if (d && centered !== d) {
        var centroid = path.centroid(d);
        x = centroid[0];
        y = centroid[1];
        k = 4;
        centered = d;
    } else {
        x = width / 2;
        y = height / 2;
        k = 1;
        centered = null;
    }

    g.selectAll("path")
        .classed("active", centered && function(d) { return d === centered; });

    g.transition()
        .duration(750)
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")")
        .style("stroke-width", 1.5 / k + "px");
}