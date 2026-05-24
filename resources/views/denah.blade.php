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
        <main class="py-10 grow">
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
                <div id="runganFoto-card"
                    class="w-full max-w-md mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Peta</p>

                        <!-- Map should fill container -->
                        <div id="map" style="height: 300px;" class="w-full h-64 rounded-lg"></div>

                        <button id="nextFloor-btn" class="w-full rounded-4xl bg-white py-2 font-bold">
                            Lantai Berikutnya
                        </button>

                        <div id="floor-btn" class="grid grid-cols-3 gap-3 w-full">
                            <button class="rounded-4xl bg-stone-700 text-white py-2 font-bold">L1</button>
                            <button class="rounded-4xl bg-white py-2 font-bold">L2</button>
                            <button class="rounded-4xl bg-white py-2 font-bold">L3</button>
                        </div>

                        <button id="jadwal-btn" class="w-full rounded-4xl bg-stone-700 text-white py-2 mt-4 font-bold">
                            Lihat Informasi Ruangan
                        </button>
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
        let nodeLayer, edgeLayer, weightLayer, pathLayer;
        let image;
        let imageUrls = {};
        let bounds;

        let currentPathNodes = [];
        let activeFloor = 1;

        document.addEventListener('DOMContentLoaded', () => {

            // =========================
            // 1. INIT MAP
            // =========================
            map = L.map('map', {
                crs: L.CRS.Simple,
                minZoom: -2,
                scrollWheelZoom: false,
                smoothWheelZoom: true,
                smoothSensitivity: 1,
            });

            // =========================
            // 2. BOUNDS + IMAGE
            // =========================
            bounds = [
                [0, 0],
                [1221, 1441]
            ];

            imageUrls = {
                1: '{{ asset('images/Denah E11-Lantai-1.png') }}',
                2: '{{ asset('images/Denah E11-Lantai-2.png') }}',
                3: '{{ asset('images/Denah E11-Lantai-3.png') }}'
            };

            image = L.imageOverlay(imageUrls[1], bounds).addTo(map);
            map.fitBounds(bounds);

            // =========================
            // 3. LAYERS (IMPORTANT FIX)
            // =========================
            nodeLayer = L.layerGroup().addTo(map);
            edgeLayer = L.layerGroup().addTo(map);
            weightLayer = L.layerGroup().addTo(map);
            pathLayer = L.layerGroup().addTo(map); // ❗ FIXED (was outside before)

            // =========================
            // 4. INIT FEATURES
            // =========================
            initCoordinatesShow();
            initFloorButtons();
            //drawGrid(10);

            // =========================
            // 5. INITIAL PATH
            // =========================
            const urlParams = new URLSearchParams(window.location.search);
            const start = urlParams.get('start');
            const end = urlParams.get('end');
            if (start && end) {
                getPath(start, end);
            }
        });


        // ======================================================
        // PATHFINDING
        // ======================================================
        async function getPath(startId, endId) {

            const response = await fetch(`/api/navigation?start=${startId}&end=${endId}`);
            currentPathNodes = await response.json();

            if (currentPathNodes.length > 0) {
                switchFloor(currentPathNodes[0].floor);
            } else {
                drawPathForCurrentFloor();
            }
        }

        function drawPathForCurrentFloor() {

            if (!pathLayer) return; // safety check

            pathLayer.clearLayers();

            const floorNodes = currentPathNodes.filter(
                node => node.floor == activeFloor
            );

            if (floorNodes.length > 1) {
                const latlngs = floorNodes.map(n => [n.lat, n.lng]);

                L.polyline(latlngs, {
                    color: 'blue',
                    weight: 5,
                    opacity: 0.8
                }).addTo(pathLayer);
            }
        }


        // ======================================================
        // FLOOR BUTTONS
        // ======================================================
        function initFloorButtons() {

            document.querySelectorAll('#floor-btn button').forEach(button => {

                button.addEventListener('click', function() {
                    switchFloor(this.innerText.replace('L', ''));
                });
            });
        }

        function switchFloor(floor) {
            activeFloor = floor;

            if (imageUrls[activeFloor]) {
                image.setUrl(imageUrls[activeFloor]);
            }

            drawPathForCurrentFloor();

            document.querySelectorAll('#floor-btn button').forEach(btn => {
                btn.classList.remove('bg-stone-700', 'text-white');
                btn.classList.add('bg-white');
                if (btn.innerText.replace('L', '') == floor) {
                    btn.classList.remove('bg-white');
                    btn.classList.add('bg-stone-700', 'text-white');
                }
            });
        }


        // ======================================================
        // COORDINATES DISPLAY
        // ======================================================
        function initCoordinatesShow() {

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
                info._div.innerHTML =
                    `Y: ${e.latlng.lat.toFixed(2)} | X: ${e.latlng.lng.toFixed(2)}`;
            });

            map.on('click', function(e) {
                const coords = `${e.latlng.lat.toFixed(2)}, ${e.latlng.lng.toFixed(2)}`;

                navigator.clipboard.writeText(coords)
                    .then(() => console.log('Copied:', coords));
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
