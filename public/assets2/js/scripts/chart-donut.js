function donut() {
    // Default settings
    var $el = d3.select("body")
    var data = {};
    // var showTitle = true;
    var width = 300,
        height = 300,
        radius = Math.min(width, height) / 2;

    var currentVal;
    var color = d3.scale.category20();
    var pie = d3.layout.pie()
        .sort(null)
        .value(function(d) { return d.value; });

    var svg, g, arc;
    var object = {};

    // Method for render/refresh graph
    object.render = function() {
        if (!svg) {
            arc = d3.svg.arc()
                .outerRadius(radius)
                .innerRadius(radius - (radius / 5));

            svg = $el.append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

            svg.append("text")
                .datum(data)
                .attr("x", 0)
                .attr("y", 0 + radius / 30)
                .attr("class", "text-tooltip-percentage")
                .style("text-anchor", "middle")
                .attr("font-weight", "bold")
                .style("font-size", radius / 5 + "px");

            svg.append("text")
                .datum(data)
                .attr("x", 0)
                .attr("y", 0 + radius / 10)
                .attr("class", "text-tooltip-category")
                .style("text-anchor", "middle")
                .attr("font-weight", "bold")
                .style("font-size", radius / 15 + "px");

            g = svg.selectAll(".arc")
                .data(pie(d3.entries(data)))
                .enter().append("g")
                .attr("class", "arc");

            g.append("path")
                // Attach current value to g so that we can use it for animation
                .each(function(d) { this._current = d; })
                .attr("d", arc)
                .style("fill", function(d) { return color(d.data.key); });
            // g.append("text")
            //     .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
            //     .attr("dy", ".35em")
            //     .style("text-anchor", "middle")
            //     .style("font-size", ".7rem")
            //     .style("font-weight", "bold");

            // g.select("text").text(function(d) { return d.data.value + '%'; });

            g.on("mouseover", function(obj) {
                svg.select("text.text-tooltip-percentage")
                    .attr("fill", function(d) { return color(obj.data.key); })
                    .text(function(d) {
                        return d[obj.data.key] + '%';
                    });
                svg.select("text.text-tooltip-category")
                    .attr("fill", function(d) { return color(obj.data.key); })
                    .text(function(d) {
                        return obj.data.key;
                    });
            });

            g.on("mouseout", function(obj) {
                svg.select("text.text-tooltip-percentage").text("");
                svg.select("text.text-tooltip-category").text("");
            });

        } else {
            g.data(pie(d3.entries(data))).exit().remove();

            g.select("path")
                .transition().duration(200)
                .attrTween("d", function(a) {
                    var i = d3.interpolate(this._current, a);
                    this._current = i(0);
                    return function(t) {
                        return arc(i(t));
                    };
                })

            g.select("text")
                .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; });

            svg.select("text.text-tooltip").datum(data);
        }
        return object;
    };

    // Getter and setter methods
    object.data = function(value) {
        if (!arguments.length) return data;
        data = value;
        return object;
    };

    object.$el = function(value) {
        if (!arguments.length) return $el;
        $el = value;
        return object;
    };

    object.width = function(value) {
        if (!arguments.length) return width;
        width = value;
        radius = Math.min(width, height) / 2;
        return object;
    };

    object.height = function(value) {
        if (!arguments.length) return height;
        height = value;
        radius = Math.min(width, height) / 2;
        return object;
    };

    return object;
};