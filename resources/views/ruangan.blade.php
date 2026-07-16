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
                        @if(isset($dosen) && $dosen)
                            <h1 class="col-span-1 col-start-1 text text-4xl font-bold">{{ $dosen->nama_dosen }}</h1>
                            <p>Dosen Pengajar</p>
                        @else
                            <h1 class="col-span-1 col-start-1 text text-4xl font-bold">{{ $ruangan ? $ruangan->nama_ruangan : 'Detail Ruangan' }}</h1>
                            <p>{{ $ruangan ? $ruangan->deskripsi : '' }}</p>
                        @endif
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                @if(!isset($dosen) || !$dosen)
                <!-- Foto card -->
                <div id="ruanganFoto-card"
                    class="w-full max-w-lg mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Foto</p>

                        <!-- Map should fill container -->
                        <div id="fotoRuangan-container" style="height: 300px;" class="w-full h-64 rounded-lg">
                            <img class="rounded-lg" id="fotoRuangan" src="https://placehold.co/1920x1080">
                        </div>

                        <div class="grid grid-cols-2 gap-2 justify-between">
                            <button id="jadwal-btn"
                                class="w-full rounded-4xl bg-white text-black py-2 mt-4 font-bold">
                                &lt;
                            </button>
                            <button id="jadwal-btn"
                                class="w-full rounded-4xl bg-white text-black py-2 mt-4 font-bold">
                                &gt;
                            </button>
                        </div>

                    </div>
                </div>
                @endif

                <!-- Jadwal card -->
                <div id="ruanganJadwal-card"
                    class="w-full max-w-lg mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Jadwal</p>
                        <hr>
                        <div id="jadwalHari-btn" class="grid grid-cols-4 gap-3 w-full px-6 py-2">
                            <button class="col-span-1 rounded-4xl bg-stone-700 text-white py-2 font-bold">Senin</button>
                            <button class="col-span-2 rounded-4xl bg-white py-2 font-bold">Selasa</button>
                            <button class="col-span-1 rounded-4xl bg-white py-2 font-bold">Rabu</button>
                            <button class="col-span-2 rounded-4xl bg-white py-2 font-bold">Kamis</button>
                            <button class="col-span-2 rounded-4xl bg-white py-2 font-bold">Jumat</button>
                        </div>
                    

                        <!-- Jadwal Table per ruangan -->
                        <div class="bg-gray-50 rounded-2xl mt-6">
                            <table class="w-full text-center border-collapse">
                                <thead>
                                    <tr>
                                        <th class="text-xl font-bold text-black p-4 border-r-4 border-b-4 border-black">
                                            Waktu</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-black">Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($schedules->isEmpty())
                                        <tr>
                                            <td colspan="2" class="py-8 px-4 text-center text-zinc-500 italic">
                                                Tidak ada jadwal kelas {{ isset($dosen) && $dosen ? 'untuk dosen ini' : 'untuk ruangan ini' }}.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($schedules as $class)
                                            <tr class="schedule-row border-b border-zinc-200 last:border-0" data-hari="{{ $class->hari }}">
                                                <td class="py-4 px-2 font-semibold text-black border-r-4 border-black text-center whitespace-normal break-words">
                                                    {{ $class->jam_mulai }} - {{ $class->jam_selesai }}
                                                </td>
                                                <td class="py-3 px-4 text-left text-black whitespace-normal break-words">
                                                    <div class="font-bold text-base leading-tight">{{ $class->nama_matkul }}</div>
                                                    <div class="text-xs text-zinc-600 mt-1 flex flex-col gap-0.5">
                                                        @if(isset($dosen) && $dosen)
                                                            <span>📍 Ruangan: {{ $class->nama_ruangan }}</span>
                                                        @else
                                                            <span>👤 Dosen: {{ $class->nama_dosen }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- Fallback row when filtering leaves zero matches -->
                                        <tr id="empty-schedule-row" class="hidden">
                                            <td colspan="2" class="py-8 px-4 text-center text-zinc-500 italic">
                                                Tidak ada kelas terjadwal pada hari ini.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @if(!isset($dosen) || !$dosen)
                <!-- Peta Card -->
                <div id="ruanganPeta-card"
                    class="w-full max-w-lg mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Peta</p>

                        <!-- Map should fill container -->
                        <div id="map" style="height: 300px;" class="w-full h-64 rounded-lg"></div>

                        <button id="nextFloor-btn"
                            class="w-full rounded-4xl bg-white py-2 font-bold transition-all duration-300 ease-in-out hover:bg-stone-400 active:bg-stone-700 active:text-white hidden">
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

                        <button id="navigation-btn" class="w-full rounded-4xl bg-stone-700 text-white py-2 mt-4 font-bold">
                            Pergi Ke Menu Navigasi
                        </button>
                    </div>
                </div>
                @endif
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

        const roomNode = @json($roomNode);
        let roomMarker = null;


        document.addEventListener('DOMContentLoaded', () => {

            const mapContainer = document.getElementById('map');
            if (mapContainer) {
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
                // 5. INITIAL PATH & FLOOR
                // =========================
                if (roomNode && roomNode.floor) {
                    switchFloor(roomNode.floor);
                } else {
                    switchFloor(1);
                }

                const urlParams = new URLSearchParams(window.location.search);
                const start = urlParams.get('start');
                const end = urlParams.get('end');
                if (start && end) {
                    getPath(start, end);
                };
            }

            initNavigationButton();
            initJadwalDayFiltering();
        });


        // ======================================================
        // PATHFINDING
        // ======================================================
        async function getPath(startId, endId) {

            const response = await fetch(`/api/navigation?start=${startId}&end=${endId}`);
            currentPathNodes = await response.json();

            pathSegmentsByFloor = {};
            pathSegments = [];
            currentSegmentIndex = 0;

            let currentSegment = [];
            let currentFloor = null;

            for (const node of currentPathNodes) {

                if (currentFloor === null) {
                    currentFloor = Number(node.floor);
                }

                if (Number(node.floor) === currentFloor) {

                    currentSegment.push(node);

                } else {

                    // Save ordered segment
                    pathSegments.push({
                        floor: currentFloor,
                        nodes: [...currentSegment]
                    });

                    // Save grouped by floor
                    if (!pathSegmentsByFloor[currentFloor]) {
                        pathSegmentsByFloor[currentFloor] = [];
                    }

                    pathSegmentsByFloor[currentFloor].push([...currentSegment]);

                    currentSegment = [node];
                    currentFloor = Number(node.floor);
                }
            }

            // Save last segment
            if (currentSegment.length) {

                pathSegments.push({
                    floor: currentFloor,
                    nodes: [...currentSegment]
                });

                if (!pathSegmentsByFloor[currentFloor]) {
                    pathSegmentsByFloor[currentFloor] = [];
                }

                pathSegmentsByFloor[currentFloor].push([...currentSegment]);
            }

            if (pathSegments.length) {
                switchFloor(pathSegments[0].floor);
            }
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

            drawPathForCurrentFloor();
            drawRoomMarkerForCurrentFloor();

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

        // ======================================================
        // JADWAL DAY FILTERING
        // ======================================================
        function initJadwalDayFiltering() {
            const dayButtons = document.querySelectorAll('#jadwalHari-btn button');
            const rows = document.querySelectorAll('.schedule-row');
            const emptyRow = document.getElementById('empty-schedule-row');

            dayButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button styling
                    dayButtons.forEach(btn => {
                        btn.classList.remove('bg-stone-700', 'text-white');
                        btn.classList.add('bg-white', 'text-black');
                    });
                    this.classList.remove('bg-white', 'text-black');
                    this.classList.add('bg-stone-700', 'text-white');

                    const selectedDay = this.textContent.trim();
                    filterSchedules(selectedDay);
                });
            });

            function filterSchedules(day) {
                let visibleCount = 0;
                rows.forEach(row => {
                    if (row.getAttribute('data-hari') === day) {
                        row.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                });

                if (visibleCount === 0) {
                    if (emptyRow) emptyRow.classList.remove('hidden');
                } else {
                    if (emptyRow) emptyRow.classList.add('hidden');
                }
            }

            // Trigger click on the first button (Senin) by default to initialize the view
            if (dayButtons.length > 0) {
                dayButtons[0].click();
            }
        }

        function drawRoomMarkerForCurrentFloor() {
            if (!roomNode || !map) return;

            // Remove existing marker if any
            if (roomMarker) {
                map.removeLayer(roomMarker);
                roomMarker = null;
            }

            // Draw only if the room's node is on the active floor
            if (Number(roomNode.floor) === Number(activeFloor)) {
                // Draw a marker at the room node coordinate
                roomMarker = L.marker([roomNode.lat, roomNode.lng])
                    .addTo(map)
                    .bindPopup(`<b>${roomNode.name || 'Ruangan'}</b>`)
                    .openPopup();
                
                // Pan map to the room coordinate
                map.panTo([roomNode.lat, roomNode.lng]);
            }
        }

        function initNavigationButton() {
            const navBtn = document.getElementById('navigation-btn');
            if (navBtn) {
                navBtn.addEventListener('click', () => {
                    window.location.href = "{{ route('navigation') }}";
                });
            }
        }
    </script>
</body>

</html>
