<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floor Plan Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col min-h-screen">
        <header class="shadow-lg">
            <div
                class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <img src="https://placehold.co/200x50">
            </div>
        </header>
        <main class="py-10 flex-grow">
            <hero>
                <div class="flex items-center text-center justify-center mx-auto px-4 ">
                    <div class="grid grid-cols-1 gap-2">
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">Navigasi Ruangan</h1>
                        <p>Titik Awal -> Titik Akhir</p>
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                <div id="map" style="height: 1000px;" class="w-full h-64 rounded-lg"></div>
            </content>
        </main>

        <footer class="shadow-lg">
            <div class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-zinc-700 shadow-sm top-0 z-10 ">
                <p class="text text-white">Copyright © 2025</p>
            </div>
        </footer>
    </div>


    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-polylinedecorator/1.6.0/leaflet.polylineDecorator.min.js">
    </script>
    <script>
        var map = L.map('map', {
            crs: L.CRS.Simple,
            minZoom: -2
        });

        // So 0,0 was the left bottom and the 1221, 1441 was the height x width image
        var bounds = [
            [0, 0],
            [1221, 1441]
        ];

        var image = L.imageOverlay('{{ asset('images/Denah E11-Lantai-1.png') }}', bounds).addTo(map);
        map.fitBounds(bounds);

        // --- DUMMY DATA TEST ---

        // 1. Pretend these are nodes from your future Graph
        const nodeLocations = {
            "start": [515, 1101],
            "hallway_1": [519, 320],
            "corner_A": [789, 313],
            "target": [858, 305]
        };

        // 2. Pretend this is the result of your Dijkstra's algorithm
        // It returns a sequence of node IDs
        const pathResult = ["start", "hallway_1", "corner_A", "target"];

        // 3. Convert those IDs into the [y, x] coordinates Leaflet needs
        const pathCoordinates = pathResult.map(id => nodeLocations[id]);



        // // 1. Create your base path as before
        // var pathLine = L.polyline(pathCoordinates, {
        //     color: 'red',
        //     weight: 4
        // }).addTo(map);

        // // 2. Add the Arrow Decorator
        // var decorator = L.polylineDecorator(pathLine, {
        //     patterns: [{
        //         offset: '10%', // Start 10% into the line
        //         repeat: '20%', // Repeat every 20% of the line length
        //         symbol: L.Symbol.arrowHead({
        //             pixelSize: 15,
        //             polygon: false, // Set to true for a solid triangle head
        //             pathOptions: {
        //                 stroke: true,
        //                 color: 'red',
        //                 weight: 2
        //             }
        //         })
        //     }]
        // }).addTo(map);



        // 4. Draw the line
        // var pathLine = L.polyline(pathCoordinates, {
        //     color: 'red',
        //     weight: 4,
        //     opacity: 0.8,
        //     dashArray: '10, 10', // Optional: makes it a dashed line
        //     lineJoin: 'round'
        // }).addTo(map);

        // Optional: Add markers at start and end
        // L.marker(nodeLocations["start"]).addTo(map).bindPopup("Start");
        // L.marker(nodeLocations["target"]).addTo(map).bindPopup("Destination");

        const nodeLayer = L.layerGroup().addTo(map);
        const edgeLayer = L.layerGroup().addTo(map);

        async function visualizeGraph(floor) {
            const response = await fetch(`/api/graph-data?floor=${floor}`);
            const data = await response.json();

            nodeLayer.clearLayers();
            edgeLayer.clearLayers();

            // 1. Draw Edges (Lines between nodes)
            data.edges.forEach(edge => {
                const coords = [
                    [edge.from_node.lat, edge.from_node.lng],
                    [edge.to_node.lat, edge.to_node.lng]
                ];
                L.polyline(coords, {
                    color: 'gray',
                    weight: 2,
                    dashArray: '5, 5'
                }).addTo(edgeLayer);
            });

            // 2. Draw Nodes (Small circles)
            data.nodes.forEach(node => {
                L.circleMarker([node.lat, node.lng], {
                        radius: 5,
                        color: 'black',
                        fillColor: 'yellow',
                        fillOpacity: 1
                    })
                    .bindTooltip(`ID: ${node.id} - ${node.name}`) // Show ID on hover
                    .addTo(nodeLayer);
            });
        }

        visualizeGraph(1);

        // Add a small box to the UI
        var info = L.control({
            position: 'bottomright'
        });
        info.onAdd = function() {
            this._div = L.DomUtil.create('div', 'coords-display');
            // this._div.style.background = 'white';
            this._div.style.padding = '2px';
            // this._div.style.border = '1px solid black';
            this._div.innerHTML = 'Hover over map';
            return this._div;
        };
        info.addTo(map);

        // Update the box on mousemove
        map.on('mousemove', function(e) {
            var lat = e.latlng.lat.toFixed(2);
            var lng = e.latlng.lng.toFixed(2);
            info._div.innerHTML = "Y: " + lat + " | X: " + lng;
        });

        // It was for Grid Display (Dev Only)
        function drawGrid(step) {
            const gridStyle = {
                color: '#000',
                weight: 1,
                opacity: 0.2, // 40% transparency
                interactive: false // Mouse clicks pass through to the map
            };

            // Draw Horizontal lines (Y-axis)
            for (let y = 0; y <= bounds[1][0]; y += step) {
                L.polyline([
                    [y, 0],
                    [y, bounds[1][1]]
                ], gridStyle).addTo(map);
            }

            // Draw Vertical lines (X-axis)
            for (let x = 0; x <= bounds[1][1]; x += step) {
                L.polyline([
                    [0, x],
                    [bounds[1][0], x]
                ], gridStyle).addTo(map);
            }
        }

        // Call it with a step of 10 units
        drawGrid(30);
    </script>

</body>

</html>
