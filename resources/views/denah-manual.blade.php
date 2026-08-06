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
                        <p>Titik Awal ,Titik Akhir</p>
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                <div id="runganFoto-card"
                    class="w-full max-w-3xl mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Peta</p>

                        <!-- Map should fill container -->
                        <div id="map" style="height: 500px;" class="w-full h-64 rounded-lg"></div>

                        <button id="nextFloor-btn"
                            class="w-full rounded-4xl bg-white py-2 font-bold transition-all duration-300 ease-in-out hover:bg-stone-400 active:bg-stone-700 active:text-white">
                            Lantai Berikutnya
                        </button>

                        <div id="nextFloor-wrn-msg" class="flex items-center justify-center gap-2 hidden">
                            <svg class="w-4 h-4 fill-red-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path
                                    d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z" />
                            </svg>
                            <p class="font-bold text-red-600">Kamu sudah di lantai terakhir.</p>
                        </div>

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
        let pathSegmentsByFloor = {};
        let activeFloor = 1;
        let pathSegments = [];
        let currentSegmentIndex = 0;
        let manualRoutes = [];



        document.addEventListener('DOMContentLoaded', async () => {

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
            initNextFloorButton();
            //drawGrid(10);

            // =========================
            // 5. INITIAL PATH
            // =========================
            const urlParams = new URLSearchParams(window.location.search);
            const start = urlParams.get('start');
            const end = urlParams.get('end');
            if (start && end) {
                getPath(start, end);
            };


            // =========================
            // 6. MANUAL PATH
            // =========================
            // Case 1 Path unik
            await addManualRoute(
                [339 ,340 ,343 ,242 ,239 ,240 ,254 ,253 ,235 ,236 ,237 ,238 ,252 ,251 ,241 ,341 ,351 ,350 ,330 ,332 ,321],
                "#ff0000"
            );

            await addManualRoute(
                [339 ,340 ,343 ,242 ,239 ,240 ,254 ,255 ,233 ,234 ,257 ,256 ,250 ,251 ,241 ,341 ,351 ,350 ,330 ,332 ,321],
                "#00ff00"
            );

            await addManualRoute(
                [339 ,342 ,443 ,440 ,454 ,453 ,435 ,436 ,437 ,438 ,452 ,451 ,441 ,341 ,351 ,350 ,330 ,332 ,321],
                "#0000ff"
            );
            await addManualRoute(
                [339 ,342 ,443 ,440 ,454 ,455 ,433 ,434 ,457 ,456 ,450 ,451 ,441 ,341 ,351 ,350 ,330 ,332 ,321],
                "#ffff00"
            );

            // Case 2 Single Floor
            // await addManualRoute(
            //     [101 , 153 , 152 , 133 , 151 , 150 , 130 , 131 , 120],
            //     "#ff0000"
            // );

            // await addManualRoute(
            //     [101 , 153 , 154 , 135 , 134 , 155 , 157 , 156 , 150 , 130 , 131 , 120],
            //     "#00ff00"
            // );

            // // Case 3 Multi Floor
            // await addManualRoute(
            //     [110 ,133 ,152 ,153 ,154 ,140 ,243  ,240 ,239 ,242 ,343 ,340 ,339 ,342 ,443 ,440 ,454 ,455 ,433 ,434 ,411],
            //     "#ff0000"
            // );

            // await addManualRoute(
            //     [110 ,133 ,151 ,150 ,156 ,157 ,155 ,134 ,135 ,154 ,140 ,243  ,240 ,239 ,242 ,343 ,340 ,339 ,342 ,443 ,440 ,454 ,455 ,433 ,434 ,411],
            //     "#00ff00"
            // );
            // await addManualRoute(
            //     [110 , 133 , 151 , 141 , 241 , 341 , 441 , 451 , 450 , 456 , 457 , 434 , 411],
            //     "#0000ff"
            // );
            
        });


        // ======================================================
        // PATHFINDING
        // ======================================================
        async function getPath(startId, endId) {

            const response = await fetch(`/api/navigation?start=${startId}&end=${endId}`);

            currentPathNodes = await response.json();

            buildPath();

        }

        function buildPath() {

            pathSegmentsByFloor = {};
            pathSegments = [];
            currentSegmentIndex = 0;

            let currentSegment = [];
            let currentFloor = null;

            currentPathNodes.forEach(node => {

                node.floor = Number(node.floor);

                if (currentFloor === null)
                    currentFloor = node.floor;

                if (node.floor === currentFloor) {

                    currentSegment.push(node);

                } else {

                    pathSegments.push({
                        floor: currentFloor,
                        nodes: [...currentSegment]
                    });

                    if (!pathSegmentsByFloor[currentFloor])
                        pathSegmentsByFloor[currentFloor] = [];

                    pathSegmentsByFloor[currentFloor].push([...currentSegment]);

                    currentSegment = [node];
                    currentFloor = node.floor;

                }

            });

            if (currentSegment.length) {

                pathSegments.push({
                    floor: currentFloor,
                    nodes: [...currentSegment]
                });

                if (!pathSegmentsByFloor[currentFloor])
                    pathSegmentsByFloor[currentFloor] = [];

                pathSegmentsByFloor[currentFloor].push([...currentSegment]);

            }

            if (pathSegments.length) {
                switchFloor(pathSegments[0].floor);
            }

        }

        function loadManualPath(nodeIds) {

            currentPathNodes = [];

            nodeIds.forEach(id => {

                const node = allNodes.find(n => Number(n.id) === Number(id));

                if (node) {

                    currentPathNodes.push({
                        ...node
                    });

                } else {

                    console.warn("Node not found:", id);

                }

            });

            buildPath();

        }

        async function getManualPath(nodeIds) {

            const response = await fetch("/api/nodes");
            const allNodes = await response.json();

            currentPathNodes = nodeIds.map(id =>
                allNodes.find(node => node.id == id)
            );

            buildPath();
        }

        async function addManualRoute(nodeIds, color = '#3b82f6') {

            const response = await fetch("/api/nodes");
            const allNodes = await response.json();

            const nodes = nodeIds
                .map(id => allNodes.find(n => Number(n.id) === Number(id)))
                .filter(Boolean);

            manualRoutes.push({
                color,
                nodes
            });

            redrawManualRoutes();

        }

        function redrawManualRoutes() {

            if (!pathLayer) return;

            pathLayer.clearLayers();

            manualRoutes.forEach(route => {

                let segment = [];

                route.nodes.forEach(node => {

                    if (Number(node.floor) === Number(activeFloor)) {

                        segment.push([node.lat, node.lng]);

                    } else {

                        if (segment.length >= 2) {

                            L.polyline(segment, {
                                color: route.color,
                                weight: 5,
                                opacity: 0.5
                            }).addTo(pathLayer);

                        }

                        segment = [];

                    }

                });

                if (segment.length >= 2) {

                    L.polyline(segment, {
                        color: route.color,
                        weight: 5,
                        opacity: 0.5
                    }).addTo(pathLayer);

                }

            });

        }

        function drawPathForCurrentFloor() {

            if (!pathLayer) return;

            pathLayer.clearLayers();

            const segments = pathSegmentsByFloor[Number(activeFloor)] || [];

            segments.forEach(segment => {

                if (segment.length >= 2) {

                    L.polyline(
                        segment.map(node => [node.lat, node.lng]), {
                            color: '#3b82f6',
                            weight: 6,
                            opacity: 0.7,
                            lineJoin: 'round'
                        }
                    ).addTo(pathLayer);

                }

            });

            // Start Marker
            if (
                currentPathNodes.length &&
                Number(currentPathNodes[0].floor) === Number(activeFloor)
            ) {

                const start = currentPathNodes[0];

                L.circleMarker([start.lat, start.lng], {
                    radius: 8,
                    color: '#16a34a',
                    fillColor: 'white',
                    fillOpacity: 1,
                    weight: 3
                }).addTo(pathLayer).bindTooltip("Mulai");
            }

            // End Marker
            if (
                currentPathNodes.length &&
                Number(currentPathNodes[currentPathNodes.length - 1].floor) === Number(activeFloor)
            ) {

                const end = currentPathNodes[currentPathNodes.length - 1];

                L.circleMarker([end.lat, end.lng], {
                    radius: 8,
                    color: '#dc2626',
                    fillColor: 'white',
                    fillOpacity: 1,
                    weight: 3
                }).addTo(pathLayer).bindTooltip("Tujuan");
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

        // ======================================================
        // NEXT FLOOR LOGIC
        // ======================================================
        function initNextFloorButton() {
            const nextBtn = document.getElementById('nextFloor-btn');
            const warningMsg = document.getElementById('nextFloor-wrn-msg');
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    if (currentPathNodes.length === 0) {
                        alert('Belum ada rute navigasi yang aktif.');
                        return;
                    }

                    // Ambil daftar lantai unik yang ada di sepanjang rute secara berurutan
                    // const pathFloors = [...new Set(currentPathNodes.map(node => parseInt(node.floor)))];
                    // const pathFloors = [];
                    // let lastFloor = null;
                    // currentPathNodes.forEach(node => {

                    //     const floor = parseInt(node.floor);

                    //     if (floor !== lastFloor) {
                    //         pathFloors.push(floor);
                    //         lastFloor = floor;
                    //     }

                    // });

                    // currentSegmentIndex = 0;
                    // switchFloor(pathSegments[currentSegmentIndex].floor);

                    // Cari posisi lantai saat ini di dalam daftar lantai rute
                    // const currentIndex = pathFloors.indexOf(parseInt(activeFloor));

                    // if (currentIndex !== -1 && currentIndex < pathFloors.length - 1) {
                    //     switchFloor(pathFloors[currentIndex + 1]);
                    // } else {
                    //     // alert('Anda sudah berada di lantai terakhir dari rute navigasi ini.');
                    //     warningMsg.classList.remove('hidden');
                    // }
                    if (currentSegmentIndex < pathSegments.length - 1) {
                        currentSegmentIndex++;
                        switchFloor(pathSegments[currentSegmentIndex].floor);
                    } else {
                        warningMsg.classList.remove("hidden");
                    }


                });
            }
        }

        function switchFloor(floor) {
            activeFloor = floor;

            if (imageUrls[activeFloor]) {
                image.setUrl(imageUrls[activeFloor]);
            }

            if (manualRoutes.length > 0) {
                redrawManualRoutes();
            } else {
                drawPathForCurrentFloor();
            }

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
