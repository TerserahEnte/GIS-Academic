<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floor Plan Map</title>

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
                <div id="map" style="height: 700px;" class="w-full h-64 rounded-lg"></div>
                <div class="mt-5 p-2 bg-stone-300">
                    <div id="floor-btn" class="grid grid-cols-5 gap-3 w-full">
                        <button class="rounded-4xl bg-stone-700 text-white py-2 font-bold">L1</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L2</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L3</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L4</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L5</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L6</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L7</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L8</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L9</button>
                        <button class="rounded-4xl bg-white py-2 font-bold">L10</button>
                    </div>
                </div>
            </content>
        </main>

        <footer class="shadow-lg">
            <div class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-zinc-700 shadow-sm top-0 z-10 ">
                <p class="text text-white">Copyright © 2025</p>
            </div>
        </footer>
    </div>



    <script>
        let map;
        let nodeLayer, edgeLayer, weightLayer;
        let image;
        let imageUrls = {};
        let bounds;

        document.addEventListener('DOMContentLoaded', () => {
            map = L.map('map', {
                crs: L.CRS.Simple,
                minZoom: -2,
                scrollWheelZoom: false,
                smoothWheelZoom: true,
                smoothSensitivity: 1,
            });

            bounds = [
                [0, 0],
                [1080, 1920]
            ];

            imageUrls = {
                1: '{{ asset('images/L1.png') }}',
                2: '{{ asset('images/L2-L4.png') }}',
                3: '{{ asset('images/L2-L4.png') }}',
                4: '{{ asset('images/L2-L4.png') }}',
                5: '{{ asset('images/L5.png') }}',
                6: '{{ asset('images/L6-L9.png') }}',
                7: '{{ asset('images/L6-L9.png') }}',
                8: '{{ asset('images/L6-L9.png') }}',
                9: '{{ asset('images/L6-L9.png') }}',
                10: '{{ asset('images/L10.png') }}'
            };

            image = L.imageOverlay(imageUrls[1], bounds).addTo(map);
            map.fitBounds(bounds);

            // Init Layers
            nodeLayer = L.layerGroup().addTo(map);
            edgeLayer = L.layerGroup().addTo(map);
            weightLayer = L.layerGroup().addTo(map);

            // Call Everyone
            initCoordinatesShow();
            visualizeGraph(1);
            initFloorButtons();
            drawGrid(10);
        });


        // Coordinates Show
        function initCoordinatesShow() {

            // show coordinates
            const info = L.control({
                position: 'bottomright'
            });

            info.onAdd = function() {
                this._div = L.DomUtil.create('div', 'coords-display');
                this._div.style.padding = '4px';
                this._div.innerHTML = 'Hover over map';
                return this._div;
            };

            info.addTo(map);

            map.on('mousemove', function(e) {
                const lat = e.latlng.lat.toFixed(2);
                const lng = e.latlng.lng.toFixed(2);
                info._div.innerHTML = `Y: ${lat} | X: ${lng}`;
            });

            map.on('click', function(e) {
            const coords = `${Math.round(e.latlng.lat)}, ${Math.round(e.latlng.lng)}`;

                navigator.clipboard.writeText(coords).then(() => {
                    console.log('Copied:', coords);
                });
            });
        }



        // Graph Visual
        async function visualizeGraph(floor) {

            const response = await fetch(`/api/graph-data?floor=${floor}`);
            const data = await response.json();

            nodeLayer.clearLayers();
            edgeLayer.clearLayers();
            weightLayer.clearLayers();

            // EDGES
            data.edges.forEach(edge => {

                const from = [edge.from_node.lat, edge.from_node.lng];
                const to = [edge.to_node.lat, edge.to_node.lng];

                L.polyline([from, to], {
                    color: 'gray',
                    weight: 2,
                    dashArray: '5, 5'
                }).addTo(edgeLayer);

                // midpoint label
                const midpoint = [
                    (from[0] + to[0]) / 2,
                    (from[1] + to[1]) / 2
                ];

                L.marker(midpoint, {
                    icon: L.divIcon({
                        className: 'edge-weight-label',
                        html: `<span style="background:white;padding:2px;border:1px solid #ccc;font-size:10px;">
                    ${Math.round(edge.weight)}
                </span>`,
                        iconSize: [30, 20]
                    }),
                    interactive: false
                }).addTo(weightLayer);
            });

            // NODES
            data.nodes.forEach(node => {
                L.circleMarker([node.lat, node.lng], {
                        radius: 5,
                        color: 'black',
                        fillColor: 'yellow',
                        fillOpacity: 1
                    })
                    .bindTooltip(`ID: ${node.id} - ${node.name}`)
                    .addTo(nodeLayer);
            });
        }


        // ======================================================
        // FLOOR SWITCH
        // ======================================================
        function initFloorButtons() {
            document.querySelectorAll('#floor-btn button').forEach(button => {
                button.addEventListener('click', function() {

                    let floor = this.innerText.replace('L', '');

                    if (imageUrls[floor]) {
                        image.setUrl(imageUrls[floor]);
                        visualizeGraph(floor);
                    }

                    document.querySelectorAll('#floor-btn button').forEach(btn => {
                        btn.classList.remove('bg-stone-700', 'text-white');
                        btn.classList.add('bg-white');
                    });

                    this.classList.remove('bg-white');
                    this.classList.add('bg-stone-700', 'text-white');
                });
            });
        }


        // ======================================================
        // GRID (DEV ONLY)
        // ======================================================
        function drawGrid(step) {

            const gridStyle = {
                color: '#000',
                weight: 1,
                opacity: 0.2,
                interactive: false
            };

            for (let y = 0; y <= bounds[1][0]; y += step) {
                L.polyline([
                    [y, 0],
                    [y, bounds[1][1]]
                ], gridStyle).addTo(map);
            }

            for (let x = 0; x <= bounds[1][1]; x += step) {
                L.polyline([
                    [0, x],
                    [bounds[1][0], x]
                ], gridStyle).addTo(map);
            }
        }
    </script>

</body>

</html>
