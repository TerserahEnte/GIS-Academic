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
                <div id="map" style="height: 1000px;" class="w-full h-64 rounded-lg"></div>

                <!-- Layer Toggles -->
                <div class="mt-4 p-4 bg-stone-100 rounded-2xl shadow-sm border border-stone-200 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-2 font-bold text-stone-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Tampilan Graph:</span>
                    </div>
                    <div class="flex items-center gap-6">
                        <!-- Toggle ID Node -->
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" id="toggle-node-id" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-stone-700"></div>
                            <span class="ml-3 text-sm font-bold text-stone-700">ID Node</span>
                        </label>

                        <!-- Toggle Bobot Edge -->
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" id="toggle-edge-weight" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-stone-700"></div>
                            <span class="ml-3 text-sm font-bold text-stone-700">Bobot Edge</span>
                        </label>
                    </div>
                </div>

                <div class="mt-4 p-2 bg-stone-300">
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
        let nodeLayer, nodeIdLayer, edgeLayer, weightLayer;
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
            nodeIdLayer = L.layerGroup().addTo(map);
            edgeLayer = L.layerGroup().addTo(map);
            weightLayer = L.layerGroup().addTo(map);

            // Call Everyone
            initCoordinatesShow();
            visualizeGraph(1);
            initFloorButtons();
            initLayerToggles();
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
                info._div.innerHTML = `Y (lat): ${lat} | X (lng): ${lng}`;
            });

            map.on('click', function(e) {
                const coords = `${Math.round(e.latlng.lat)}, ${Math.round(e.latlng.lng)}`;

                navigator.clipboard.writeText(coords).then(() => {
                    console.log('Copied:', coords);
                });
            });
        }


        // Layer Toggles
        function initLayerToggles() {
            const toggleNodeId = document.getElementById('toggle-node-id');
            const toggleEdgeWeight = document.getElementById('toggle-edge-weight');

            if (toggleNodeId) {
                toggleNodeId.addEventListener('change', function() {
                    if (this.checked) {
                        map.addLayer(nodeIdLayer);
                    } else {
                        map.removeLayer(nodeIdLayer);
                    }
                });
            }

            if (toggleEdgeWeight) {
                toggleEdgeWeight.addEventListener('change', function() {
                    if (this.checked) {
                        map.addLayer(weightLayer);
                    } else {
                        map.removeLayer(weightLayer);
                    }
                });
            }
        }


        // Graph Visual
        async function visualizeGraph(floor) {

            const response = await fetch(`/api/graph-data?floor=${floor}`);
            const data = await response.json();

            nodeLayer.clearLayers();
            nodeIdLayer.clearLayers();
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
                        html: `<span class="opacity-70" style="background:white;padding:2px;border:1px solid #ccc;font-size:16px;">
                    ${Math.round(edge.weight)}
                </span>`,
                        iconSize: [30, 20]
                    }),
                    interactive: false
                }).addTo(weightLayer);
            });

            // NODES
            data.nodes.forEach(node => {
                // Node ID label
                L.marker([node.lat + 10, node.lng], { // Adjust lat to position below the node
                    icon: L.divIcon({
                        className: 'node-id-label', // Custom class for styling
                        html: `<span style="background:#ffffff50;color:blue;padding:2px;padding-left:30px;padding-top:30px;border:1px solid #ccc;font-size:18px;">${node.id}</span>`,
                        iconSize: [30, 20], // Approximate size for the label
                        iconAnchor: [15,
                            0] // Anchor the top-center of the label to the marker's position
                    }),
                    interactive: false
                }).addTo(nodeIdLayer);

                L.circleMarker([node.lat, node.lng], {
                        radius: 15,
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
