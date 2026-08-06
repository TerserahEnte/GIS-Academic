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
            {{-- <div
                class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <img src="https://placehold.co/200x50">
            </div> --}}
        </header>
        <main class="py-10 grow">
            {{-- <hero>
                <div class="flex items-center text-center justify-center mx-auto px-4 ">
                    <div class="grid grid-cols-1 gap-2">
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">LOGIN</h1>
                        <hr>
                    </div>
                </div>
            </hero> --}}

            <content>
                <div id="login-card"
                    class="min-h-screen flex items-center justify-center w-full max-w-xl mx-auto rounded-xl px-4 py-6 my-10 ">
                    <div class="w-full flex flex-col gap-3 bg-gray-200 shadow-lg rounded-xl p-6">
                        <div class="grid grid-cols-1 justify-center items-center text-center gap-2">
                            <h1 class="col-span-1 col-start-1 text text-4xl font-bold">LOGIN</h1>
                            <hr>
                        </div>

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold mb-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="w-full grid grid-cols-1 font-bold p-2 gap-3">
                                <div class="grid grid-cols-1 gap-3">
                                    <label for="username">Username / Email:</label>
                                    <input type="text" placeholder="Ketik Disini..." name="username" value="{{ old('username') }}" required
                                        class="bg-white rounded-4xl p-3">
                                </div>

                                <div class="grid grid-cols-1 gap-3">
                                    <label for="password">Password:</label>
                                    <input type="password" placeholder="Ketik Disini..." name="password" required
                                        class="bg-white rounded-4xl p-3">
                                </div>


                                <button type="submit"
                                    class="bg-zinc-700 text-white py-4 mt-4 rounded-4xl cursor-pointer hover:bg-zinc-800 transition duration-200">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

            </content>
        </main>

        <footer class="shadow-lg">
            <div class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-zinc-700 shadow-sm top-0 z-10 ">
                <p class="text text-white">Copyright © 2025</p>
            </div>
        </footer>

        <!-- Fancy Warning Modal -->
        <div id="warning-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div
                class="relative bg-white rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out select-none flex flex-col items-center text-center">
                <!-- Icon -->
                <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z" />
                    </svg>
                </div>

                <!-- Message -->
                <h3 class="text-xl font-extrabold text-stone-900 mb-2">Informasi Tidak Tersedia</h3>
                <p id="warning-modal-message" class="text-sm text-stone-600 leading-relaxed mb-6">
                    Ruangan tidak ditemukan atau tidak memiliki data jadwal.
                </p>

                <!-- Button -->
                <button id="close-warning-modal-btn"
                    class="w-full py-3 px-6 bg-stone-800 hover:bg-stone-700 active:bg-stone-900 text-white font-bold rounded-xl transition duration-200 shadow-md">
                    Mengerti
                </button>
            </div>
        </div>
    </div>


    <script>
        @if (session('warning'))
            document.addEventListener('DOMContentLoaded', () => {
                showWarningModal("{{ session('warning') }}");
            });
        @endif

        let nodesData = []; // Variabel global untuk menyimpan data node

        document.addEventListener('DOMContentLoaded', () => {
            initMenuButtons();
            fetchNodes();
            initNavigationSubmit();
            initScanner();
            fetchSearchOptions();
            initScheduleSearchSubmit();
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

        // ======================================================
        // SEARCH OPTIONS (ROOMS & LECTURERS)
        // ======================================================
        function fetchSearchOptions() {
            fetch('/api/search-options')
                .then(response => response.json())
                .then(data => {
                    const searchList = document.getElementById('nodeSearchList');
                    if (!searchList) return;

                    window.roomsList = data.rooms;
                    window.lecturersList = data.lecturers;

                    // Add rooms
                    data.rooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.nama_ruangan;
                        searchList.appendChild(option);
                    });

                    // Add lecturers
                    data.lecturers.forEach(lecturer => {
                        const option = document.createElement('option');
                        option.value = lecturer.nama_dosen;
                        searchList.appendChild(option);
                    });
                })
                .catch(error => console.error('Gagal mengambil opsi pencarian:', error));
        }

        function initScheduleSearchSubmit() {
            const submitBtn = document.getElementById('lihat-jadwal-btn');
            if (submitBtn) {
                submitBtn.addEventListener('click', () => {
                    const searchVal = document.getElementById('nodeSearch').value.trim();
                    if (!searchVal) {
                        alert('Silakan masukkan nama ruangan atau dosen terlebih dahulu.');
                        return;
                    }

                    // Look up in rooms first
                    const matchedRoom = window.roomsList ? window.roomsList.find(r => r.nama_ruangan ===
                        searchVal) : null;
                    if (matchedRoom) {
                        window.location.href = `/ruangan?kode_ruangan=${matchedRoom.kode_ruangan}`;
                        return;
                    }

                    // Look up in lecturers
                    const matchedLecturer = window.lecturersList ? window.lecturersList.find(l => l.nama_dosen ===
                        searchVal) : null;
                    if (matchedLecturer) {
                        window.location.href = `/ruangan?kode_dosen=${matchedLecturer.kode_dosen}`;
                        return;
                    }

                    showWarningModal('Ruangan atau Dosen tidak ditemukan. Silakan pilih dari daftar.');
                });
            }
        }

        // ======================================================
        // WARNING MODAL SYSTEM
        // ======================================================
        function showWarningModal(message) {
            const modal = document.getElementById('warning-modal');
            const msgEl = document.getElementById('warning-modal-message');
            const card = modal.querySelector('.relative');

            if (message) {
                msgEl.textContent = message;
            }

            modal.classList.remove('hidden');

            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeWarningModal() {
            const modal = document.getElementById('warning-modal');
            const card = modal.querySelector('.relative');

            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const closeBtn = document.getElementById('close-warning-modal-btn');
            if (closeBtn) {
                closeBtn.addEventListener('click', closeWarningModal);
            }

            // Close modal when clicking on background backdrop
            const modal = document.getElementById('warning-modal');
            if (modal) {
                const backdrop = modal.querySelector('.fixed.inset-0');
                if (backdrop) {
                    backdrop.addEventListener('click', closeWarningModal);
                }
            }
        });
    </script>
</body>

</html>
