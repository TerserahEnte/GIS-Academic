<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floor Plan Map</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
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
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">Gedung E11</h1>
                        <p>Pilih menu apa yang akan ditampilkan.</p>
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                <!-- Button Menu -->
                <div id="menu-card" class="w-full max-w-md mx-auto rounded-xl py-3">
                    <div id="menu-btn" class="grid grid-cols-2 gap-3">
                        <button id="denah-btn" class="rounded-4xl bg-stone-700 text-white py-2 font-bold">Denah</button>
                        <button id="jadwal-btn"
                            class="rounded-4xl bg-white py-2 border-2 border-stone-700">Jadwal</button>
                    </div>
                </div>

                <!-- Denah Menu -->
                <div id="denah-card" class="w-full max-w-md mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Denah</p>
                        <p class="text-justify leading-5 tracking-tight">
                            Scan QR Code untuk mengetahui titik awal atau bisa memilih titik awal dari posisi untuk
                            menampilkan posisi anda di denah.
                        </p>

                        <p class="text-center pt-2">Tentukan lokasi awal dan tujuan Anda</p>
                        <div class="px-4">
                            <label class="font-bold text-left" for="endNodeSearch">Lokasi Tujuan (Cari
                                Ruangan/Dosen):</label>
                            <input list="endNodeList"
                                class="bg-white rounded-4xl w-full mt-2 py-3 px-6 shadow-sm focus:outline-none focus:ring-2 focus:ring-stone-500"
                                type="text" name="endNodeSearch" id="endNodeSearch"
                                placeholder="Pilih lokasi tujuan di sini...">
                            <datalist id="endNodeList">
                                <!-- List data node akan dimuat melalui JavaScript -->
                            </datalist>
                        </div>

                        <!-- Scannner QR Code -->
                        <button id="openScannerBtn"
                            class="bg-white rounded-2xl w-max self-center mt-2 py-1.5 px-6 hover:border-2 hover:border-stone-700">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path
                                    d="M64 160l64 0 0-64-64 0 0 64zM0 80C0 53.5 21.5 32 48 32l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48L0 80zM64 416l64 0 0-64-64 0 0 64zM0 336c0-26.5 21.5-48 48-48l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48l0-96zM320 96l0 64 64 0 0-64-64 0zM304 32l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48l0-96c0-26.5 21.5-48 48-48zM288 352a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm96 32c0-17.7 14.3-32 32-32s32 14.3 32 32-14.3 32-32 32-32-14.3-32-32zm32-96a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm-32 32a32 32 0 1 1 -64 0 32 32 0 1 1 64 0z" />
                            </svg>
                            Scan QR
                        </button>
                        <div id="scannerContainer"
                            class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">

                            <div class="bg-white p-4 rounded-xl w-80">
                                <div id="reader"></div>

                                <button id="closeScannerBtn" class="mt-4 w-full bg-red-500 text-white py-2 rounded-xl">
                                    Tutup Scanner
                                </button>
                            </div>
                        </div>

                        <!-- Lokasi Awal -->
                        <div class="grid grid-cols-2 bg-white rounded-4xl px-4 py-2">
                            <label>Lokasi Awal:</label>
                            <select id="startNodeSelect" class="bg-transparent focus:outline-none">
                                <option value="" disabled selected>Pilih lokasi awal...</option>
                            </select>
                        </div>

                        <button id="submit-navigation"
                            class="w-full max-w-md mx-auto rounded-4xl bg-stone-700 text-white py-3">Lihat
                            Denah</button>

                    </div>
                </div>

                <!-- Jadwal Menu -->
                <div id="jadwal-card"
                    class="hidden w-full max-w-md mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Jadwal</p>
                        <p class="text-center leading-5 tracking-tight">
                            Lihat jadwal rungan, jadwal mengajar dosen, dan informasi ruangan di gedung.
                        </p>

                        <div class="px-4 py-4">
                            <label class="font-bold text-left" for="nodeSearch">Cari tempat atau Dosen:</label>
                            <input
                                class="bg-white rounded-4xl w-full mt-2 py-3 px-6 shadow-sm focus:outline-none focus:ring-2 focus:ring-stone-500"
                                type="text" name="nodeSearch" id="nodeSearch" placeholder="Ketik Disini...">
                        </div>

                        <button class="w-full max-w-md mx-auto rounded-4xl bg-stone-700 text-white py-3">Lihat
                            Jadwal</button>

                    </div>
                </div>

                <!-- Kelas Menu -->
                <div id="kelas-card"
                    class="hidden w-full max-w-md mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">

                        <p class="text-center text-2xl font-bold">Kelas yang Sedang Berlangsung</p>
                        <hr class="mx-6 rounded-4xl border-t-4 border-black">
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
                                    <tr>
                                        <td class="py-3 font-medium text-black border-r-4 border-black">R201
                                        </td>
                                        <td class="py-3 font-medium text-black">Pemrograman Web</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-medium text-black border-r-4 border-black">R211
                                        </td>
                                        <td class="py-3 font-medium text-black">Pemrograman Dasar</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-medium text-black border-r-4 border-black">R101
                                        </td>
                                        <td class="py-3 font-medium text-black">Matematika Diskrit</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-medium text-black border-r-4 border-black">R311
                                        </td>
                                        <td class="py-3 font-medium text-black">Micro Teaching</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-medium text-black border-r-4 border-black">R312
                                        </td>
                                        <td class="py-3 font-medium text-black">Pembelajaran Mikro</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

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
        let nodesData = []; // Variabel global untuk menyimpan data node

        document.addEventListener('DOMContentLoaded', () => {
            initMenuButtons();
            fetchNodes();
            initNavigationSubmit();
            initScanner();
        });

        // ======================================================
        // MENU SWITCHING
        // ======================================================
        function initMenuButtons() {
            document.querySelectorAll('#menu-btn button').forEach(button => {
                button.addEventListener('click', function() {
                    const menuType = this.id.replace('-btn', '');
                    switchMenu(menuType);
                });
            });
        }

        function switchMenu(menu) {
            const denahCard = document.getElementById('denah-card');
            const jadwalCard = document.getElementById('jadwal-card');
            const kelasCard = document.getElementById('kelas-card');

            document.querySelectorAll('#menu-btn button').forEach(btn => {
                btn.classList.remove('bg-stone-700', 'text-white', 'font-bold');
                btn.classList.add('bg-white', 'border-2', 'border-stone-700');
                if (btn.id === `${menu}-btn`) {
                    btn.classList.remove('bg-white', 'border-2', 'border-stone-700');
                    btn.classList.add('bg-stone-700', 'text-white', 'font-bold');
                }
            });

            if (menu === 'denah') {
                denahCard.classList.remove('hidden');
                jadwalCard.classList.add('hidden');
                kelasCard.classList.add('hidden');
            } else {
                denahCard.classList.add('hidden');
                jadwalCard.classList.remove('hidden');
                kelasCard.classList.remove('hidden');
            }
        }

        // ======================================================
        // FETCH NODES DATA
        // ======================================================
        function fetchNodes() {
            // Panggil API dari NavigationController (pastikan route-nya di set di routes/api.php ke /api/nodes)
            fetch('/api/nodes')
                .then(response => response.json())
                .then(nodes => {
                    nodesData = nodes; // Simpan data node untuk referensi ID pencarian
                    const endNodeList = document.getElementById('endNodeList');
                    const startNodeSelect = document.getElementById('startNodeSelect');

                    // Kelompokkan data node berdasarkan properti 'floor'
                    const groupedNodes = nodes.reduce((groups, node) => {
                        const floor = node.floor;
                        if (!groups[floor]) groups[floor] = [];
                        groups[floor].push(node);
                        return groups;
                    }, {});

                    // Ambil daftar lantai dan urutkan secara numerik (Lantai 1, 2, dst)
                    const sortedFloors = Object.keys(groupedNodes).sort((a, b) => a - b);

                    sortedFloors.forEach(floor => {
                        // Buat elemen <optgroup> untuk dropdown select (judul lantai otomatis tercetak tebal)
                        const optGroup = document.createElement('optgroup');
                        optGroup.label = `Lantai ${floor}`;

                        groupedNodes[floor].forEach(node => {
                            const roomName = node.name || `Ruangan ${node.id}`;
                            const fullDisplayName = `${roomName} (Lantai ${node.floor})`;

                            // Masukkan ke datalist pencarian (tetap simpan nama lengkap agar filter pencarian akurat)
                            const optionList = document.createElement('option');
                            optionList.value = fullDisplayName;
                            endNodeList.appendChild(optionList);

                            // Masukkan ke dropdown select (di bawah grup lantai)
                            const optionSelect = document.createElement('option');
                            optionSelect.value = node.id;
                            optionSelect.textContent =
                                roomName; // Cukup nama ruangan karena sudah ada di bawah grup lantai
                            optGroup.appendChild(optionSelect);
                        });
                        startNodeSelect.appendChild(optGroup);
                    });
                })
                .catch(error => console.error('Gagal mengambil data node:', error));
        }

        // ======================================================
        // SUBMIT NAVIGATION (REDIRECT KE DENAH)
        // ======================================================
        function initNavigationSubmit() {
            const submitBtn = document.getElementById('submit-navigation');

            if (submitBtn) {
                submitBtn.addEventListener('click', () => {
                    const startId = document.getElementById('startNodeSelect').value;
                    const endName = document.getElementById('endNodeSearch').value;

                    if (!startId || !endName) {
                        alert('Silakan tentukan Lokasi Awal dan Lokasi Tujuan terlebih dahulu.');
                        return;
                    }

                    // Cari object node tujuan berdasarkan teks yang diketik pengguna
                    const endNode = nodesData.find(node => {
                        const displayName = `${node.name || `Ruangan ${node.id}`} (Lantai ${node.floor})`;
                        return displayName === endName;
                    });

                    if (!endNode) {
                        alert('Lokasi Tujuan tidak valid. Silakan pilih dari daftar yang tersedia.');
                        return;
                    }

                    // Redirect ke route denah dengan URL parameters (start & end)
                    window.location.href = `{{ route('denah') }}?start=${startId}&end=${endNode.id}`;
                });
            }
        }

        function initScanner() {
            const openScannerBtn = document.getElementById('openScannerBtn');
            const closeScannerBtn = document.getElementById('closeScannerBtn');
            const scannerContainer = document.getElementById('scannerContainer');
            const startNodeSelect = document.getElementById('startNodeSelect');

            let html5QrCode;

            // OPEN SCANNER
            openScannerBtn.addEventListener('click', () => {

                scannerContainer.classList.remove('hidden');

                html5QrCode = new Html5Qrcode("reader");

                Html5Qrcode.getCameras().then(devices => {

                    if (devices && devices.length) {

                        html5QrCode.start({
                                facingMode: "environment"
                            }, // back camera
                            {
                                fps: 10,
                                qrbox: 250
                            },

                            // SUCCESS SCAN
                            (decodedText) => {

                                console.log("QR:", decodedText);

                                // check option exists
                                const optionExists = [...startNodeSelect.options]
                                    .some(option => option.value === decodedText);

                                if (optionExists) {

                                    startNodeSelect.value = decodedText;

                                    // trigger route recalculation
                                    startNodeSelect.dispatchEvent(
                                        new Event('change')
                                    );

                                    alert("Lokasi berhasil dipilih");

                                    stopScanner();

                                } else {
                                    alert("Node tidak ditemukan");
                                }
                            },

                            // ERROR
                            (errorMessage) => {
                                // optional
                            }
                        );

                    }

                }).catch(err => {
                    console.error(err);
                });

            });

            // CLOSE BUTTON
            closeScannerBtn.addEventListener('click', () => {
                stopScanner();
            });

            // STOP SCANNER CLEANLY
            function stopScanner() {

                if (html5QrCode) {

                    html5QrCode.stop()
                        .then(() => {

                            html5QrCode.clear();

                            scannerContainer.classList.add('hidden');

                        })
                        .catch(err => {
                            console.error(err);
                        });
                }
            }
        }
    </script>
</body>

</html>
