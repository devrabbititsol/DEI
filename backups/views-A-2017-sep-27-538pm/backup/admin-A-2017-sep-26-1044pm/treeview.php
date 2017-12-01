<style>

    .node {
        cursor: pointer;
    }

    .node circle {
        fill: #fff;
        stroke: #f00;
        stroke-width: 1.5px;
    }

    .node text {
        font: 10px sans-serif;
    }

    .link {
        fill: none;
        stroke: #ccc;
        stroke-width: 1.5px;
    }

    #root svg g tspan tspan{
        fill: #ff0000;
    }

</style>
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tree View</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Tree View</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->

    <div class="row" style="background-color:#fff;">

        <div class="col-md-12 col-lg-12">

            <section id="cd-table">
                <div id="root" ></div>
                <em class="cd-scroll-right"></em>
            </section> <!-- cd-table -->
        </div>

    </div>

    <!-- end: page -->
</section>

<script src="//d3js.org/d3.v3.min.js"></script>
<script>

//var flares = "";

    var margin = {top: 20, right: 120, bottom: 20, left: 120},
            width = 1024 - margin.right - margin.left,
            height = 1600 - margin.top - margin.bottom;

    var i = 0,
            duration = 750,
            root;

    var tree = d3.layout.tree()
            .size([height, width]);

    var diagonal = d3.svg.diagonal()
            .projection(function (d) {
                return [d.y, d.x];
            });

    var svg = d3.select("#root").append("svg")
            .attr("width", width + margin.right + margin.left)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    $.ajax({
        url: "<?php echo Yii::$app->params['SITE_URL']; ?>admin/readtreeview",
        dataType: 'json',
        success: function (data) {
            //      flares = data;
            //    alert (data);
            root = data;
            root.x0 = height / 2;
            root.y0 = 0;

            function collapse(d) {
                if (d.children) {
                    d._children = d.children;
                    d._children.forEach(collapse);
                    d.children = null;
                }
            }

            root.children.forEach(collapse);
            update(root);
        }
    });

    d3.select(self.frameElement).style("height", "800px");

    function update(source) {

        // Compute the new tree layout.
        var nodes = tree.nodes(root).reverse(),
                links = tree.links(nodes);

        // Normalize for fixed-depth.
        nodes.forEach(function (d) {
            d.y = d.depth * 180;
        });

        // Update the nodes…
        var node = svg.selectAll("g.node")
                .data(nodes, function (d) {
                    return d.id || (d.id = ++i);
                });

        // Enter any new nodes at the parent's previous position.
        var nodeEnter = node.enter().append("g")
                .attr("class", "node")
                .attr("transform", function (d) {
                    return "translate(" + source.y0 + "," + source.x0 + ")";
                })
                .on("click", click);

        nodeEnter.append("circle")
                .attr("r", 1e-6)
                .style("fill", function (d) {
                    return d._children ? "#f00" : "#fff";
                });

        nodeEnter.append("text")
                .attr("x", function (d) {
                    return d.children || d._children ? -10 : 10;
                })
                .attr("dy", ".35em")
                .attr("text-anchor", function (d) {
                    return d.children || d._children ? "end" : "start";
                })
                .append('tspan')
                .attr('x', function (d) {
                    return d.children || d._children ? -10 : 10;
                })
                .attr('dy', ".35em")
                .style('font-weight', "bold")
                .text(function (d) {
                    return d.name;
                })
                .append('tspan')
                .attr('x', "0")
                .attr('dy', "1.25em")
                .style('font-weight', "normal")
                .text(function (d) {
                    return d.sname;
                })
                .style("fill-opacity", 1);

        // Transition nodes to their new position.
        var nodeUpdate = node.transition()
                .duration(duration)
                .attr("transform", function (d) {
                    return "translate(" + d.y + "," + d.x + ")";
                });

        nodeUpdate.select("circle")
                .attr("r", 4.5)
                .style("fill", function (d) {
                    return d._children ? "#f00" : "#fff";
                });

        nodeUpdate.select("text")
                .style("fill-opacity", 1);

        // Transition exiting nodes to the parent's new position.
        var nodeExit = node.exit().transition()
                .duration(duration)
                .attr("transform", function (d) {
                    return "translate(" + source.y + "," + source.x + ")";
                })
                .remove();

        nodeExit.select("circle")
                .attr("r", 1e-6);

        nodeExit.select("text")
                .style("fill-opacity", 1e-6);

        // Update the links…
        var link = svg.selectAll("path.link")
                .data(links, function (d) {
                    return d.target.id;
                });

        // Enter any new links at the parent's previous position.
        link.enter().insert("path", "g")
                .attr("class", "link")
                .attr("d", function (d) {
                    var o = {x: source.x0, y: source.y0};
                    return diagonal({source: o, target: o});
                });

        // Transition links to their new position.
        link.transition()
                .duration(duration)
                .attr("d", diagonal);

        // Transition exiting nodes to the parent's new position.
        link.exit().transition()
                .duration(duration)
                .attr("d", function (d) {
                    var o = {x: source.x, y: source.y};
                    return diagonal({source: o, target: o});
                })
                .remove();

        // Stash the old positions for transition.
        nodes.forEach(function (d) {
            d.x0 = d.x;
            d.y0 = d.y;
        });
    }

// Toggle children on click.
    function click(d) {
        if (d.children) {
            d._children = d.children;
            d.children = null;
        } else {
            d.children = d._children;
            d._children = null;
        }
        update(d);
    }
</script>
