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
            <div class="flex items-center justify-between px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <button id="sideBar-btn" class="w-8 col-span-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
                <div class="col-span-1 grid grid-cols-2 gap-4 text-xl font-black">
                    <a href="{{ route('navigation') }}" class="col-span-1 text-center hover:text-zinc-600 transition">Halaman Utama</a>
                    <form action="{{ route('logout') }}" method="POST" class="col-span-1 inline">
                        @csrf
                        <button type="submit" class="w-full text-center hover:text-zinc-600 transition cursor-pointer">Logout</button>
                    </form>
                </div>

            </div>
        </header>

        <!-- Sidebar -->
        <sidebar id="sidebar"
            class="fixed top-0 left-0 h-full w-64 bg-zinc-700 text-white transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="p-4">
                <img src="https://placehold.co/200x50/ffffff/000000?text=Admin+Logo" alt="Admin Logo" class="mb-8">
                <nav>
                    <ul>
                        <li class="mb-2">
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded-lg bg-white text-black">Jadwal</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.ruangan.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Ruangan</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.dosen.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Dosen</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.graph.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Node dan Edge</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </sidebar>
        <!-- Sidebar Backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 opacity-70 bg-black bg-opacity-50 z-40 hidden"></div>



        <main class="py-0 grow">
            {{-- <hero>
                <div class="flex items-center text-center justify-center mx-auto px-4 ">
                    <div class="grid grid-cols-1 gap-2">
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">LOGIN</h1>
                        <hr>
                    </div>
                </div>
            </hero> --}}

            <content>
                <!-- Jadwal Card -->
                <div id="jadwal-card"
                    class="grid grid-cols-1 items-center justify-center w-full rounded-xl px-15 py-15 my-0 ">
                    <div class="flex justify-between items-center mb-10 w-full">
                        <h1 class="text-4xl font-bold">Jadwal</h1>
                        <button onclick="openAddModal()" class="bg-zinc-700 hover:bg-zinc-800 text-white font-bold py-3 px-6 rounded-xl transition cursor-pointer shadow-md flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 448 512">
                                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                            </svg>
                            Tambah Jadwal
                        </button>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold mb-6 w-full">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold mb-6 w-full">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="w-full flex flex-col gap-3 bg-gray-200 shadow-lg rounded-xl p-6">
                        <div>
                            <table class="w-full text-center border-collapse bg-white rounded-4xl overflow-hidden">
                                <thead>
                                    <tr>
                                        <th class="text-xl font-bold text-black p-4 border-r-4 border-b-4 border-black">
                                            Kode Jadwal</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Kode Ruangan</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Kode Dosen</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Nama Matkul</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Hari</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Jam Mulai</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Jam Selesai</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-black">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($schedules as $schedule)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300 font-semibold">{{ $schedule->kode_jadwal }}</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $schedule->nama_ruangan }} ({{ $schedule->kode_ruangan }})</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $schedule->nama_dosen }} ({{ $schedule->kode_dosen }})</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $schedule->nama_matkul }}</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $schedule->hari }}</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $schedule->jam_mulai }}</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $schedule->jam_selesai }}</td>
                                            <td class="p-4 border-b-2 border-gray-300">
                                                <div class="flex gap-2 justify-center">
                                                    <button onclick="openEditModal({{ json_encode($schedule) }})" class="bg-zinc-600 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition cursor-pointer">Edit</button>
                                                    <button onclick="openDeleteModal('{{ $schedule->kode_jadwal }}')" class="bg-zinc-600 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition cursor-pointer">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="py-8 px-4 text-center text-zinc-500 italic">
                                                Tidak ada data jadwal.
                                            </td>
                                        </tr>
                                    @endforelse
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

        <!-- Add Schedule Modal -->
        <div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div class="relative bg-white rounded-2xl max-w-lg w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Tambah Jadwal</h3>
                    <button onclick="closeAddModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 text-sm font-semibold text-stone-700">
                        <div class="col-span-2 flex flex-col gap-2">
                            <label for="add_kode_jadwal">Kode Jadwal:</label>
                            <input type="text" id="add_kode_jadwal" name="kode_jadwal" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: J001">
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="add_kode_ruangan">Ruangan:</label>
                            <select id="add_kode_ruangan" name="kode_ruangan" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="">Pilih Ruangan</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->kode_ruangan }}">{{ $room->nama_ruangan }} ({{ $room->kode_ruangan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="add_kode_dosen">Dosen:</label>
                            <select id="add_kode_dosen" name="kode_dosen" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="">Pilih Dosen</option>
                                @foreach($lecturers as $lecturer)
                                    <option value="{{ $lecturer->kode_dosen }}">{{ $lecturer->nama_dosen }} ({{ $lecturer->kode_dosen }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 flex flex-col gap-2">
                            <label for="add_nama_matkul">Nama Mata Kuliah:</label>
                            <input type="text" id="add_nama_matkul" name="nama_matkul" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: Pemrograman Web">
                        </div>
                        <div class="col-span-2 flex flex-col gap-2">
                            <label for="add_hari">Hari:</label>
                            <select id="add_hari" name="hari" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="add_jam_mulai">Jam Mulai:</label>
                            <input type="text" id="add_jam_mulai" name="jam_mulai" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Format: HH:MM, Contoh: 08:00">
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="add_jam_selesai">Jam Selesai:</label>
                            <input type="text" id="add_jam_selesai" name="jam_selesai" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Format: HH:MM, Contoh: 09:40">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Schedule Modal -->
        <div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div class="relative bg-white rounded-2xl max-w-lg w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Edit Jadwal</h3>
                    <button onclick="closeEditModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4 text-sm font-semibold text-stone-700">
                        <div class="col-span-2 flex flex-col gap-2">
                            <label for="edit_kode_jadwal">Kode Jadwal:</label>
                            <input type="text" id="edit_kode_jadwal" disabled class="bg-gray-200 border border-gray-300 rounded-lg p-2.5 text-stone-500 cursor-not-allowed">
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="edit_kode_ruangan">Ruangan:</label>
                            <select id="edit_kode_ruangan" name="kode_ruangan" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="">Pilih Ruangan</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->kode_ruangan }}">{{ $room->nama_ruangan }} ({{ $room->kode_ruangan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="edit_kode_dosen">Dosen:</label>
                            <select id="edit_kode_dosen" name="kode_dosen" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="">Pilih Dosen</option>
                                @foreach($lecturers as $lecturer)
                                    <option value="{{ $lecturer->kode_dosen }}">{{ $lecturer->nama_dosen }} ({{ $lecturer->kode_dosen }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 flex flex-col gap-2">
                            <label for="edit_nama_matkul">Nama Mata Kuliah:</label>
                            <input type="text" id="edit_nama_matkul" name="nama_matkul" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                        </div>
                        <div class="col-span-2 flex flex-col gap-2">
                            <label for="edit_hari">Hari:</label>
                            <select id="edit_hari" name="hari" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="edit_jam_mulai">Jam Mulai:</label>
                            <input type="text" id="edit_jam_mulai" name="jam_mulai" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="HH:MM">
                        </div>
                        <div class="col-span-1 flex flex-col gap-2">
                            <label for="edit_jam_selesai">Jam Selesai:</label>
                            <input type="text" id="edit_jam_selesai" name="jam_selesai" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="HH:MM">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeEditModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Schedule Confirmation Modal -->
        <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div class="relative bg-white rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm128 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm128 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-stone-900 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-stone-600 leading-relaxed mb-6">Apakah Anda yakin ingin menghapus jadwal <strong id="delete-item-code"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form id="delete-form" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-3 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="w-1/2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition cursor-pointer">Hapus</button>
                    </div>
                </form>
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
            initSidebarToggle();
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

        // ======================================================
        // SIDEBAR TOGGLE
        // ======================================================
        function initSidebarToggle() {
            const sidebarBtn = document.getElementById('sideBar-btn');
            const sidebar = document.getElementById('sidebar');
            const sidebarBackdrop = document.getElementById('sidebar-backdrop');

            if (sidebarBtn && sidebar && sidebarBackdrop) {
                sidebarBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarBackdrop.classList.toggle('hidden');
                });

                sidebarBackdrop.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    sidebarBackdrop.classList.add('hidden');
                });
            }
        }

        // ======================================================
        // ADD MODAL ACTIONS
        // ======================================================
        function openAddModal() {
            const modal = document.getElementById('add-modal');
            const card = modal.querySelector('.relative');
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAddModal() {
            const modal = document.getElementById('add-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // ======================================================
        // EDIT MODAL ACTIONS
        // ======================================================
        function openEditModal(schedule) {
            const modal = document.getElementById('edit-modal');
            const card = modal.querySelector('.relative');
            
            // Populate fields
            document.getElementById('edit_kode_jadwal').value = schedule.kode_jadwal;
            document.getElementById('edit_kode_ruangan').value = schedule.kode_ruangan;
            document.getElementById('edit_kode_dosen').value = schedule.kode_dosen;
            document.getElementById('edit_nama_matkul').value = schedule.nama_matkul;
            document.getElementById('edit_hari').value = schedule.hari;
            document.getElementById('edit_jam_mulai').value = schedule.jam_mulai;
            document.getElementById('edit_jam_selesai').value = schedule.jam_selesai;

            // Set action URL dynamically
            document.getElementById('edit-form').action = `/admin/jadwal/${schedule.kode_jadwal}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // ======================================================
        // DELETE MODAL ACTIONS
        // ======================================================
        function openDeleteModal(kode_jadwal) {
            const modal = document.getElementById('delete-modal');
            const card = modal.querySelector('.relative');
            
            document.getElementById('delete-item-code').textContent = kode_jadwal;
            document.getElementById('delete-form').action = `/admin/jadwal/${kode_jadwal}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // Close modals on backdrop click
        document.addEventListener('DOMContentLoaded', () => {
            ['add-modal', 'edit-modal', 'delete-modal'].forEach(id => {
                const modal = document.getElementById(id);
                if (modal) {
                    const backdrop = modal.querySelector('.fixed.inset-0');
                    if (backdrop) {
                        backdrop.addEventListener('click', () => {
                            if (id === 'add-modal') closeAddModal();
                            else if (id === 'edit-modal') closeEditModal();
                            else if (id === 'delete-modal') closeDeleteModal();
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>
