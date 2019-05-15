
    // App sales lines chart
    // ------------------------------
    if ($('#app_sales').length) {
        appSalesLines('#app_sales', 255); // initialize chart
    }

    // Chart setup
    function appSalesLines(element, height) {


        // Basic setup
        // ------------------------------

        // Define main variables
        var d3Container = d3.select(element),
            margin = {top: 5, right: 30, bottom: 30, left: 50},
            width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
            height = height - margin.top - margin.bottom;

        // Tooltip
        var tooltip = d3.tip()
            .attr('class', 'd3-tip')
            .html(function (d) {
                return "<ul class='list-unstyled mb-5'>" +
                    "<li>" + "<div class='text-size-base mt-5 mb-5'>" + 
                    d.name.toUpperCase().replace('_', ' ') + " : &#8377; " + formateAmount(d.value) 
                    +"</div>" + "</li>" +
                "</ul>";
            });

        // Format date
        var parseDate = d3.timeParse("%Y/%m/%d"),
            formatDate = d3.timeFormat("%b %d, '%y")
            displayMonth = d3.timeFormat("%B");

        // Line colors
        var scale = ["#4CAF50", "#000000", "#FF5722", "#5C6BC0", "#b07027"],
            color = d3.scaleOrdinal().range(scale);



        // Create chart
        // ------------------------------

        // Container
        var container = d3Container.append('svg');

        // SVG element
        var svg = container
            .attr('width', width + margin.left + margin.right)
            .attr('height', height + margin.top + margin.bottom)
            .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
                .call(tooltip);



        // Add date range switcher
        // ------------------------------

        // Menu
        var menu = $("#select_date").multiselect({
            buttonClass: 'btn btn-link text-semibold',
            enableHTML: true,
            dropRight: true,
            onChange: function() { updateStats(), $.uniform.update(); },
            buttonText: function (options, element) {
                var selected = '';
                options.each(function() {
                    selected += $(this).html() + ', ';
                });
                return '<span class="status-mark border-warning position-left"></span>' + selected.substr(0, selected.length -2);
            }
        });

        // Radios
        $(".multiselect-container input").uniform({ radioClass: 'choice' });



        // Load data
        // ------------------------------

        var formatted;
        function updateStats(){
            var year = menu.val();
            d3.json("admin/statistics-data/" + year, function(response) {
                formatted = response.data;
                updateOverall(response.overall);
                redraw();
                change();
            });
        }

        //onload Update Stats
        updateStats();

        function updateOverall(overall){
            $('#total-expense').text(formateAmount(overall.expense));
            $('#total-invoice').html(formateAmount(overall.invoice) + ' + ' + formateAmount(overall.tax) + " <sub>(Tax)</sub>");
            $('#total-payout').text(formateAmount(overall.payout));
            $('#total-other-expense').text(formateAmount(overall.other_expense));
        }

        function formateAmount(amount){
            return amount.toString().replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");
        }



        // Construct layout
        // ------------------------------

        // Add events
        var altKey;
        d3.select(window)
            .on("keydown", function() { altKey = d3.event.altKey; })
            .on("keyup", function() { altKey = false; });
    
        // Set terms of transition on date change   
        function change() {
          d3.transition()
              .duration(altKey ? 7500 : 500)
              .each(redraw);
        }



        // Main chart drawing function
        // ------------------------------

        function redraw() { 

            // Construct chart layout
            // ------------------------------

            // Create data nests
            var nested = d3.nest()
                .key(function(d) { return d.year; })
                .map(formatted)
            
            // Get value from menu selection
            // the option values correspond
            //to the [type] value we used to nest the data  
            var series = menu.val();
            
            // Only retrieve data from the selected series using nest
            var data = formatted;
            // var data = nested[series];

            // For object constancy we will need to set "keys", one for each type of data (column name) exclude all others.
            color.domain(d3.keys(data[0]).filter(function(key) { return (key !== "month" && key !== "year"); }));

            // Setting up color map
            var linedata = color.domain().map(function(name) {
                return {
                            name: name,
                            values: data.map(function(d) {
                                return {name: name, month: parseInt(d.month), year: parseInt(d.year), value: parseFloat(d[name], 10)};
                            })
                        };
                    });

            // Draw the line
            var line = d3.line()
                .x(function(d) { return x(d.month); })
                .y(function(d) { return y(d.value); })
                .curve(d3.curveLinear);



            // Construct scales
            // ------------------------------

            // Horizontal
            var x = d3.scaleTime()
                .domain([
                    d3.min(linedata, function(c) { return d3.min(c.values, function(v) { return v.month; }); }),
                    d3.max(linedata, function(c) { return d3.max(c.values, function(v) { return v.month; }); })
                ])
                .range([0, width]);

            // Vertical
            var y = d3.scaleLinear()
                .domain([
                    d3.min(linedata, function(c) { return d3.min(c.values, function(v) { return v.value; }); }),
                    d3.max(linedata, function(c) { return d3.max(c.values, function(v) { return v.value; }); })
                ])
                .range([height, 0]);

            // Create axes
            // ------------------------------

            // Horizontal
            var xAxis = d3.axisBottom()
                .scale(x)
                .tickPadding(8)
                // .ticks(1)
                .tickSizeInner(4)
                .tickFormat(function(d, i){
                    return displayMonth(new Date(2018, i));
                });

            // Vertical
            var yAxis = d3.axisLeft()
                .scale(y)
                .ticks(6)
                .tickSize(0 -width)
                .tickPadding(8)
                .tickFormat(function(tickVal) {
                    return tickVal >= 1000 ? (tickVal >= 100000 ? tickVal/100000 + " L" : tickVal/1000 + " T") : tickVal;
                });
            


            //
            // Append chart elements
            //

            // Append axes
            // ------------------------------

            // Horizontal
            svg.append("g")
                .attr("class", "d3-axis d3-axis-horizontal d3-axis-solid")
                .attr("transform", "translate(0," + height + ")");

            // Vertical
            svg.append("g")
                .attr("class", "d3-axis d3-axis-vertical d3-axis-transparent");



            // Append lines
            // ------------------------------

            // Bind the data
            var lines = svg.selectAll(".lines")
                .data(linedata);
         
            // Append a group tag for each line
            var lineGroup = lines
                .enter()
                .append("g")
                    .attr("class", "lines")
                    .attr('id', function(d){ return d.name + "-line"; });

            // Append the line to the graph
            lineGroup.append("path")
                .attr("class", "d3-line d3-line-medium")
                .style("stroke", function(d) { return color(d.name); })
                .style('opacity', 0)
                .attr("d", function(d) { return line(d.values[0]); })
                .transition()
                    .duration(500)
                    .delay(function(d, i) { return i * 200; })
                    .style('opacity', 1);
          


            // Append circles
            // ------------------------------

            var circles = lines.selectAll("circle")
                .data(function(d) { return d.values; })
                .enter()
                .append("circle")
                    .attr("class", "d3-line-circle d3-line-circle-medium")
                    .attr("cx", function(d,i){return x(d.month)})
                    .attr("cy",function(d,i){return y(d.value)})
                    .attr("r", 3)
                    .style('fill', '#fff')
                    .style("stroke", function(d) { return color(d.name); });

            // Add transition
            circles
                .style('opacity', 0)
                .transition()
                    .duration(500)
                    .delay(500)
                    .style('opacity', 1);



            // Append tooltip
            // ------------------------------

            // Add tooltip on circle hover
            circles
                .on("mouseover", function (d) {
                    tooltip.offset([-15, 0]).show(d);

                    // Animate circle radius
                    d3.select(this).transition().duration(250).attr('r', 4);
                })
                .on("mouseout", function (d) {
                    tooltip.hide(d);

                    // Animate circle radius
                    d3.select(this).transition().duration(250).attr('r', 3);
                });

            // Change tooltip direction of first point
            // to always keep it inside chart, useful on mobiles
            lines.each(function (d) {
                d3.select(d3.select(this).selectAll('circle')._groups[0][0])
                    .on("mouseover", function (d) {
                        tooltip.offset([0, 15]).direction('e').show(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 4);
                    })
                    .on("mouseout", function (d) {
                        tooltip.direction('n').hide(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 3);
                    });
            })

            // Change tooltip direction of last point
            // to always keep it inside chart, useful on mobiles
            lines.each(function (d) { 
                d3.select(d3.select(this).selectAll('circle')._groups[0][d3.select(this).selectAll('circle').size() - 1])
                    .on("mouseover", function (d) {
                        tooltip.offset([0, -15]).direction('w').show(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 4);
                    })
                    .on("mouseout", function (d) {
                        tooltip.direction('n').hide(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 3);
                    })
            })



            // Update chart on date change
            // ------------------------------

            // Set variable for updating visualization
            var lineUpdate = d3.transition(lines);
            
            // Update lines
            lineUpdate.selectAll(".lines path")
                .attr("d", function(d, i) { return line(d.values); });

            // Update line path on value change
            lines.each(function (ln) {
                lineUpdate.selectAll("#"+ ln.name +"-line path")
                    .attr("d", function(d, i) { return line(ln.values); });
            });

            // Update circles
            lineUpdate.selectAll("circle")
                .attr("cy",function(d,i){return y(d.value)})
                .attr("cx", function(d,i){return x(d.month)});

            // Update vertical axes
            d3.transition(svg)
                .select(".d3-axis-vertical")
                .call(yAxis);   

            // Update horizontal axes
            d3.transition(svg)
                .select(".d3-axis-horizontal")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis);



            // Resize chart
            // ------------------------------

            // Call function on window resize
            $(window).on('resize', appSalesResize);

            // Call function on sidebar width change
            $(document).on('click', '.sidebar-control', appSalesResize);

            // Resize function
            // 
            // Since D3 doesn't support SVG resize by default,
            // we need to manually specify parts of the graph that need to 
            // be updated on window resize
            function appSalesResize() {

                // Layout
                // -------------------------

                // Define width
                width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;

                // Main svg width
                container.attr("width", width + margin.left + margin.right);

                // Width of appended group
                svg.attr("width", width + margin.left + margin.right);

                // Horizontal range
                x.range([0, width]);

                // Vertical range
                y.range([height, 0]);


                // Chart elements
                // -------------------------

                // Horizontal axis
                svg.select('.d3-axis-horizontal').call(xAxis);

                // Vertical axis
                svg.select('.d3-axis-vertical').call(yAxis.tickSize(0-width));

                // Lines
                svg.selectAll('.d3-line').attr("d", function(d, i) { return line(d.values); });

                // Circles
                svg.selectAll('.d3-line-circle').attr("cx", function(d,i){return x(d.month)})
            }
        }
    }
